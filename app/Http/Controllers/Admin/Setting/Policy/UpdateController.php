<?php

namespace App\Http\Controllers\Admin\Setting\Policy;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Setting\Policy\UpdateRequest;
use App\Models\Policy;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */

    public function __invoke(UpdateRequest $request, Policy $policy)
    {
        try {
            DB::transaction(function () use ($request, $policy) {
                $policy->update([
                    'is_active' => $request->has('is_active'),
                    'version' => $policy->version + 1, // автоувеличение версии
                ]);
                foreach ($request->translations as $translation) {
                    $t = $policy->translations()->firstOrNew(['locale' => $translation['locale']]);
                    $t->title = $translation['title'];
                    $t->content = $translation['content'];
                    $t->update();
                }
            });

            return redirect()->route('admin.setting.policy.index')
                ->with('success',  __('admin/settings/policy.messages.updated', ['title' => $request->key]));
        } catch (Exception $ex) {
            
            logger()->error('Policy update failed', ['exception' => $ex]);
            return redirect()->back()->with('error', __('errors/setting.update.failed'));
        }
    }
}
