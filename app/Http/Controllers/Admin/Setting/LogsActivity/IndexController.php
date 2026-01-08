<?php

namespace App\Http\Controllers\Admin\Setting\LogsActivity;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // --- Параметры сортировки ---
        $sortField = $request->get('sort_field', 'id');
        $sortDirection = $request->get('sort_direction', 'desc');

        // --- Поисковый запрос ---
        $search = $request->get('search', null);

        // --- Базовый запрос с загрузкой пользователя ---
        $query = ActivityLog::query()->with('user');

        // --- Поиск по описанию, действию, IP и пользователю ---
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                    ->orWhere('action', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('email', 'like', "%{$search}%");
                    })
                    ->orWhere('model_type', 'like', "%{$search}%")
                    ->orWhere('model_id', 'like', "%{$search}%");
            });
        }

        // --- Разрешенные поля для сортировки ---
        $allowedSorts = [
            'id',
            'model_type',
            'model_id',
            'user_id',
            'action',
            'description',
            'ip_address',
            'user_agent',
            'created_at'
        ];

        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'id';
        }

        // --- Сортировка и пагинация ---
        $logsactivity = $query->orderBy($sortField, $sortDirection)
            ->paginate(25)
            ->appends($request->query());

        // --- Добавляем поле user_email для Blade ---
        $logsactivity->getCollection()->transform(function ($item) {
            $item->user_email = $item->user?->email ?? '-';
            return $item;
        });

        // --- Колонки для таблицы ---
        $columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'model_type', 'label' => __('admin/common.fields.model_type')],
            ['key' => 'model_id', 'label' => __('admin/common.fields.model_id')],
            ['key' => 'user_email', 'label' => __('admin/common.fields.user')],
            ['key' => 'action', 'label' => __('admin/settings/log.fields.event')],
            ['key' => 'description', 'label' => __('admin/common.fields.description')],
            ['key' => 'ip_address', 'label' => __('admin/common.fields.ip_address')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        return view('admin.setting.logsactivity.index', compact(
            'logsactivity',
            'columns',
            'sortField',
            'sortDirection'
        ));
    }
}
