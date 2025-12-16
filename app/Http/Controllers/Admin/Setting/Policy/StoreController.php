<?php

namespace App\Http\Controllers\Admin\Setting\Policy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Policy\StoreRequest;
use App\Models\Policy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
       
        DB::transaction(function () use ($request) {
            $policy = Policy::create([
                'key' => $request->key,
                'version' => 1,
                'is_active' => $request->has('is_active'),
            ]);

            foreach ($request->translations as $translation) {
                $policy->translations()->create($translation);
            }
        });

        return redirect()->route('admin.setting.policy.index')
            ->with('success', __('admin/settings/policy.messages.created', ['title' => $request->key]));
    }
}
