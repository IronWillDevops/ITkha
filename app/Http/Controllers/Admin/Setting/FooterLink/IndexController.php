<?php

namespace App\Http\Controllers\Admin\Setting\FooterLink;

use App\Http\Controllers\Controller;
use App\Models\FooterLink;
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

        $query = FooterLink::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('url', 'like', "%{$search}%")
                  ->orWhere('icon', 'like', "%{$search}%");
            });
        }

        $allowedSorts = ['id', 'title', 'url', 'icon', 'created_at'];
        if (!in_array($sortField, $allowedSorts)) {
            $sortField = 'id';
        }

        $footerlinks = $query->orderBy($sortField, $sortDirection)
                             ->paginate(10)
                             ->appends($request->query());

        $columns = [
            ['key' => 'id', 'label' => __('admin/common.fields.id')],
            ['key' => 'icon', 'label' => __('admin/common.fields.icon')],
            ['key' => 'title', 'label' => __('admin/common.fields.title')],
            ['key' => 'url', 'label' => __('admin/common.fields.url')],
            ['key' => 'created_at', 'label' => __('admin/common.fields.created_at')],
        ];

        return view('admin.setting.footerlink.index', compact('footerlinks', 'columns', 'sortField', 'sortDirection'));
    }
}
