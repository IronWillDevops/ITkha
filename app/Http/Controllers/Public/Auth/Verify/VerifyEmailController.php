<?php

namespace App\Http\Controllers\Public\Auth\Verify;

use Illuminate\Http\Request;

class VerifyEmailController extends BaseController
{
    public function __invoke(Request $request, $id, $hash)
    {
        $isVerified = $this->service->store($id, $hash);

        if ($isVerified) {
            return redirect()
                ->route('login')
                ->with('success', __('message.success.email_verified_success'));
        } else {
            return redirect()->route('login')->with('success', __('message.success.email_already_verified'));
        }
    }
}
