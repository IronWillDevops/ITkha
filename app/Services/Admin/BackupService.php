<?php

namespace App\Services\Admin;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use ZipArchive;
use PDO;

class BackupService
{
    protected string $backupDisk = 'local';
    protected string $backupPath = 'backups';

    public function createBackup(): array
    {
        $timestamp = now()->format('Y-m-d_H-i-s');
        $backupName = "backup_{$timestamp}";
        $tempPath = storage_path("app/temp/{$backupName}");

        // Создаем временную директорию
        File::ensureDirectoryExists($tempPath);

        try {
            // Бекап базы данных
            $this->backupDatabase($tempPath);

            // Бекап файлов storage
            $this->backupStorage($tempPath);

            // Бекап .env файла
            $this->backupEnvFile($tempPath);

            // Создаем ZIP архив
            $zipPath = storage_path("app/{$this->backupPath}/{$backupName}.zip");
            File::ensureDirectoryExists(dirname($zipPath));
            
            $this->createZipArchive($tempPath, $zipPath);

            // Удаляем временную директорию
            File::deleteDirectory($tempPath);

            return [
                'success' => true,
                'filename' => "{$backupName}.zip",
                'path' => $zipPath,
                'size' => File::size($zipPath),
                'created_at' => now(),
            ];
        } catch (\Exception $e) {
            // Очищаем временные файлы в случае ошибки
            if (File::exists($tempPath)) {
                File::deleteDirectory($tempPath);
            }

            throw $e;
        }
    }

    public function restoreBackup(string $filename): bool
    {
        $backupPath = storage_path("app/{$this->backupPath}/{$filename}");

        if (!File::exists($backupPath)) {
            throw new \Exception('Backup file not found');
        }

        $tempPath = storage_path('app/temp/restore_' . Str::random(10));
        File::ensureDirectoryExists($tempPath);

        try {
            // Распаковываем архив
            $this->extractZipArchive($backupPath, $tempPath);

            // Восстанавливаем базу данных
            $this->restoreDatabase($tempPath);

            // Восстанавливаем файлы storage
            $this->restoreStorage($tempPath);

            // Восстанавливаем .env файл
            $this->restoreEnvFile($tempPath);

            // Удаляем временную директорию
            File::deleteDirectory($tempPath);

            return true;
        } catch (\Exception $e) {
            // Очищаем временные файлы
            if (File::exists($tempPath)) {
                File::deleteDirectory($tempPath);
            }

            throw $e;
        }
    }

    public function listBackups(): array
    {
        $backupDir = storage_path("app/{$this->backupPath}");
        
        if (!File::exists($backupDir)) {
            return [];
        }

        $files = File::files($backupDir);
        $backups = [];

        foreach ($files as $file) {
            if ($file->getExtension() === 'zip') {
                $backups[] = [
                    'filename' => $file->getFilename(),
                    'size' => $file->getSize(),
                    'created_at' => $file->getMTime(),
                ];
            }
        }

        // Сортируем по дате создания (новые сначала)
        usort($backups, fn($a, $b) => $b['created_at'] <=> $a['created_at']);

        return $backups;
    }

    public function deleteBackup(string $filename): bool
    {
        $backupPath = storage_path("app/{$this->backupPath}/{$filename}");

        if (File::exists($backupPath)) {
            return File::delete($backupPath);
        }

        return false;
    }

    public function downloadBackup(string $filename): string
    {
        $backupPath = storage_path("app/{$this->backupPath}/{$filename}");

        if (!File::exists($backupPath)) {
            throw new \Exception('Backup file not found');
        }

        return $backupPath;
    }

    protected function backupDatabase(string $path): void
    {
        $database = config('database.default');
        $connection = config("database.connections.{$database}");

        $sqlFile = "{$path}/database.sql";

        try {
            match ($connection['driver']) {
                'mysql' => $this->backupMysqlPHP($connection, $sqlFile),
                'pgsql' => $this->backupPostgresPHP($connection, $sqlFile),
                'sqlite' => $this->backupSqlite($connection, $sqlFile),
                default => throw new \Exception("Unsupported database driver: {$connection['driver']}")
            };
        } catch (\Exception $e) {
            throw new \Exception("Database backup failed: " . $e->getMessage());
        }
    }

    protected function backupMysqlPHP(array $connection, string $outputFile): void
    {
        $sql = "-- MySQL Database Backup\n";
        $sql .= "-- Generated: " . now()->toDateTimeString() . "\n\n";
        $sql .= "SET FOREIGN_KEY_CHECKS=0;\n\n";

        // Получаем список всех таблиц
        $tables = DB::select('SHOW TABLES');
        $dbName = $connection['database'];
        $tableKey = "Tables_in_{$dbName}";

        foreach ($tables as $table) {
            $tableName = $table->$tableKey;
            
            // Структура таблицы
            $sql .= "-- Table structure for `{$tableName}`\n";
            $sql .= "DROP TABLE IF EXISTS `{$tableName}`;\n";
            
            $createTable = DB::select("SHOW CREATE TABLE `{$tableName}`")[0];
            $sql .= $createTable->{'Create Table'} . ";\n\n";
            
            // Данные таблицы
            $sql .= "-- Data for table `{$tableName}`\n";
            
            $rows = DB::table($tableName)->get();
            
            if ($rows->count() > 0) {
                foreach ($rows as $row) {
                    $values = array_map(function($value) {
                        if ($value === null) {
                            return 'NULL';
                        }
                        return "'" . addslashes($value) . "'";
                    }, (array) $row);
                    
                    $sql .= "INSERT INTO `{$tableName}` VALUES (" . implode(', ', $values) . ");\n";
                }
            }
            
            $sql .= "\n";
        }

        $sql .= "SET FOREIGN_KEY_CHECKS=1;\n";

        File::put($outputFile, $sql);
    }

    protected function backupPostgresPHP(array $connection, string $outputFile): void
    {
        $sql = "-- PostgreSQL Database Backup\n";
        $sql .= "-- Generated: " . now()->toDateTimeString() . "\n\n";

        // Получаем список всех таблиц
        $tables = DB::select("
            SELECT table_name 
            FROM information_schema.tables 
            WHERE table_schema = 'public' 
            AND table_type = 'BASE TABLE'
        ");

        foreach ($tables as $table) {
            $tableName = $table->table_name;
            
            // Структура таблицы
            $sql .= "-- Table structure for \"{$tableName}\"\n";
            $sql .= "DROP TABLE IF EXISTS \"{$tableName}\" CASCADE;\n";
            
            // Получаем CREATE TABLE statement
            $columns = DB::select("
                SELECT column_name, data_type, character_maximum_length, is_nullable, column_default
                FROM information_schema.columns
                WHERE table_name = ?
                ORDER BY ordinal_position
            ", [$tableName]);
            
            $sql .= "CREATE TABLE \"{$tableName}\" (\n";
            $columnDefinitions = [];
            
            foreach ($columns as $column) {
                $def = "  \"{$column->column_name}\" {$column->data_type}";
                
                if ($column->character_maximum_length) {
                    $def .= "({$column->character_maximum_length})";
                }
                
                if ($column->is_nullable === 'NO') {
                    $def .= " NOT NULL";
                }
                
                if ($column->column_default) {
                    $def .= " DEFAULT {$column->column_default}";
                }
                
                $columnDefinitions[] = $def;
            }
            
            $sql .= implode(",\n", $columnDefinitions);
            $sql .= "\n);\n\n";
            
            // Данные таблицы
            $sql .= "-- Data for table \"{$tableName}\"\n";
            
            $rows = DB::table($tableName)->get();
            
            if ($rows->count() > 0) {
                foreach ($rows as $row) {
                    $values = array_map(function($value) {
                        if ($value === null) {
                            return 'NULL';
                        }
                        return "'" . str_replace("'", "''", $value) . "'";
                    }, (array) $row);
                    
                    $sql .= "INSERT INTO \"{$tableName}\" VALUES (" . implode(', ', $values) . ");\n";
                }
            }
            
            $sql .= "\n";
        }

        File::put($outputFile, $sql);
    }

    protected function backupSqlite(array $connection, string $outputFile): void
    {
        if (!isset($connection['database']) || !File::exists($connection['database'])) {
            throw new \Exception('SQLite database file not found');
        }
        
        File::copy($connection['database'], $outputFile);
    }

    protected function backupStorage(string $path): void
    {
        $storagePath = storage_path('app');
        $backupStoragePath = "{$path}/storage";

        File::ensureDirectoryExists($backupStoragePath);

        // Копируем важные директории из storage
        $directories = ['public', 'private'];

        foreach ($directories as $directory) {
            $sourcePath = "{$storagePath}/{$directory}";
            $destPath = "{$backupStoragePath}/{$directory}";

            if (File::exists($sourcePath)) {
                File::copyDirectory($sourcePath, $destPath);
            }
        }
    }

    protected function backupEnvFile(string $path): void
    {
        $envFile = base_path('.env');

        if (File::exists($envFile)) {
            File::copy($envFile, "{$path}/.env");
        }
    }

    protected function restoreDatabase(string $path): void
    {
        $sqlFile = "{$path}/database.sql";

        if (!File::exists($sqlFile)) {
            throw new \Exception('Database backup file not found');
        }

        $database = config('database.default');
        $connection = config("database.connections.{$database}");

        try {
            match ($connection['driver']) {
                'mysql', 'pgsql' => $this->restoreDatabasePHP($sqlFile),
                'sqlite' => $this->restoreSqlite($connection, $sqlFile),
                default => throw new \Exception("Unsupported database driver: {$connection['driver']}")
            };
        } catch (\Exception $e) {
            throw new \Exception("Database restore failed: " . $e->getMessage());
        }
    }

    protected function restoreDatabasePHP(string $inputFile): void
    {
        $sql = File::get($inputFile);
        
        // Улучшенный парсинг SQL файла
        // Убираем комментарии
        $sql = preg_replace('/^--.*$/m', '', $sql);
        
        // Разбиваем на отдельные команды по точке с запятой с учетом переносов строк
        $statements = preg_split('/;\s*$/m', $sql, -1, PREG_SPLIT_NO_EMPTY);
        
        // Очищаем каждый statement от лишних пробелов
        $statements = array_map('trim', $statements);
        $statements = array_filter($statements, fn($statement) => !empty($statement));

        $driver = config('database.connections.' . config('database.default') . '.driver');
        
        try {
            // Отключаем проверку внешних ключей
            if ($driver === 'mysql') {
                DB::unprepared('SET FOREIGN_KEY_CHECKS=0');
                DB::unprepared('SET AUTOCOMMIT=0');
            } elseif ($driver === 'pgsql') {
                DB::unprepared('SET session_replication_role = replica');
            }
            
            // Выполняем каждый statement
            // DDL команды (CREATE, DROP) автоматически коммитят в MySQL, 
            // поэтому не используем DB::beginTransaction()
            foreach ($statements as $statement) {
                $trimmedStatement = trim($statement);
                if (!empty($trimmedStatement)) {
                    try {
                        DB::unprepared($trimmedStatement);
                    } catch (\Exception $e) {
                        // Логируем проблемный запрос для отладки
                        \Log::error('Failed SQL statement: ' . substr($trimmedStatement, 0, 200));
                        throw $e;
                    }
                }
            }
            
            // Коммитим оставшиеся INSERT команды
            if ($driver === 'mysql') {
                DB::unprepared('COMMIT');
            }
            
            // Включаем обратно проверку внешних ключей
            if ($driver === 'mysql') {
                DB::unprepared('SET FOREIGN_KEY_CHECKS=1');
                DB::unprepared('SET AUTOCOMMIT=1');
            } elseif ($driver === 'pgsql') {
                DB::unprepared('SET session_replication_role = DEFAULT');
            }
            
        } catch (\Exception $e) {
            // Откатываем изменения если возможно
            try {
                if ($driver === 'mysql') {
                    DB::unprepared('ROLLBACK');
                }
            } catch (\Exception $rollbackException) {
                // Игнорируем ошибки отката
            }
            
            // Восстанавливаем проверку ключей даже в случае ошибки
            try {
                if ($driver === 'mysql') {
                    DB::unprepared('SET FOREIGN_KEY_CHECKS=1');
                    DB::unprepared('SET AUTOCOMMIT=1');
                } elseif ($driver === 'pgsql') {
                    DB::unprepared('SET session_replication_role = DEFAULT');
                }
            } catch (\Exception $cleanupException) {
                // Игнорируем ошибки восстановления
            }
            
            throw $e;
        }
    }

    protected function restoreSqlite(array $connection, string $inputFile): void
    {
        if (!isset($connection['database'])) {
            throw new \Exception('SQLite database path not configured');
        }
        
        // Создаем бекап текущей БД
        if (File::exists($connection['database'])) {
            File::copy(
                $connection['database'], 
                $connection['database'] . '.backup.' . now()->timestamp
            );
        }
        
        File::copy($inputFile, $connection['database']);
    }

    protected function restoreStorage(string $path): void
    {
        $backupStoragePath = "{$path}/storage";

        if (!File::exists($backupStoragePath)) {
            return;
        }

        $storagePath = storage_path('app');

        // Восстанавливаем директории
        $directories = File::directories($backupStoragePath);

        foreach ($directories as $directory) {
            $directoryName = basename($directory);
            $destPath = "{$storagePath}/{$directoryName}";

            // Создаем бекап текущих файлов перед восстановлением
            if (File::exists($destPath)) {
                $backupDir = "{$storagePath}/{$directoryName}.backup." . now()->timestamp;
                File::moveDirectory($destPath, $backupDir);
            }

            File::copyDirectory($directory, $destPath);
        }
    }

    protected function restoreEnvFile(string $path): void
    {
        $envBackup = "{$path}/.env";

        if (File::exists($envBackup)) {
            // Создаем бекап текущего .env
            $currentEnv = base_path('.env');
            if (File::exists($currentEnv)) {
                File::copy($currentEnv, base_path('.env.backup.' . now()->timestamp));
            }

            File::copy($envBackup, $currentEnv);
        }
    }

    protected function createZipArchive(string $sourcePath, string $zipPath): void
    {
        $zip = new ZipArchive();

        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            throw new \Exception('Failed to create zip archive');
        }

        $files = File::allFiles($sourcePath);

        foreach ($files as $file) {
            $relativePath = str_replace($sourcePath . '/', '', $file->getPathname());
            $zip->addFile($file->getPathname(), $relativePath);
        }

        $zip->close();
    }

    protected function extractZipArchive(string $zipPath, string $destPath): void
    {
        $zip = new ZipArchive();

        if ($zip->open($zipPath) !== true) {
            throw new \Exception('Failed to open zip archive');
        }

        $zip->extractTo($destPath);
        $zip->close();
    }
}