<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->string('model_type'); // тип модели (App\Models\Post)
            $table->unsignedBigInteger('model_id'); // ID модели
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null'); // кто выполнил действие
            $table->string('action'); // created, updated, deleted
            $table->text('description')->nullable(); // описание действия
            $table->json('old_values')->nullable(); // старые значения (для update/delete)
            $table->json('new_values')->nullable(); // новые значения (для create/update)
            $table->string('ip_address', 45)->nullable(); // IP адрес
            $table->text('user_agent')->nullable(); // User Agent
            $table->timestamps();
            
            // Индексы для быстрого поиска
            $table->index(['model_type', 'model_id']);
            $table->index('user_id');
            $table->index('action');
            $table->index('created_at');
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
