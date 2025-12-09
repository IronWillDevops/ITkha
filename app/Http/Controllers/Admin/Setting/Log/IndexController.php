<?php

namespace App\Http\Controllers\Admin\Setting\Log;

use App\Models\Log;
use Illuminate\Http\Request;

class IndexController
{
    public function __invoke(Request $request)
    {
        $sortField = $request->get('sort_field', 'id');
        $sortDirection = $request->get('sort_direction', 'desc');
        $search = $request->get('search', null);

        $query = Log::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('description', 'like', "%{$search}%")
                    ->orWhere('event', 'like', "%{$search}%")
                    ->orWhere('user_email', 'like', "%{$search}%")
                    ->orWhere('ip_address', 'like', "%{$search}%");
            });
        }

        $allowedSorts = ['id', 'description', 'event', 'user_email', 'ip_address', 'created_at'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'id';
        }

        $logs = $query->orderBy($sortField, $sortDirection)
            ->paginate(35)
            ->appends($request->query());

        $columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'description', 'label' => __('admin/common.fields.description')],
            ['key' => 'event', 'label' => __('admin/settings/log.fields.event')],
            ['key' => 'user_email', 'label' => __('admin/common.fields.user')],
            ['key' => 'ip_address', 'label' => __('admin/common.fields.ip_address')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        return view('admin.setting.log.index', compact('logs', 'columns', 'sortField', 'sortDirection'));
    }
}
