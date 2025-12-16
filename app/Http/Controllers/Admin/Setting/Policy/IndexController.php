<?php

namespace App\Http\Controllers\Admin\Setting\Policy;

use App\Http\Controllers\Controller;
use App\Models\Policy;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke(Request $request)
    {
        $sortField = $request->get('sort_field', 'id');
        $sortDirection = $request->get('sort_direction', 'asc');
        $search = $request->get('search', null);

        $query = Policy::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('key', 'like', "%{$search}%")
                    ->orWhere('version', 'like', "%{$search}%");
            });
        }

        $allowedSorts = ['id', 'key', 'version', 'is_active', 'created_at'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'id';
        }

        $policies = $query->orderBy($sortField, $sortDirection)
            ->paginate(10)
            ->appends($request->query());

        $columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'key', 'label' => __('admin/common.fields.key')],
            ['key' => 'version', 'label' => __('admin/common.fields.version')],
            ['key' => 'is_active', 'label' => __('admin/common.fields.is_active')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        return view('admin.setting.policy.index', compact('policies', 'columns', 'sortField', 'sortDirection'));
    }
}
