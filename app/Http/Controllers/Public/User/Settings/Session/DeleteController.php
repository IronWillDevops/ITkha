<?php

namespace App\Http\Controllers\Public\User\Settings\Session;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user,Session $session)
    {

        DB::table('sessions')
        ->where('id', $session->id)
            ->where('user_id', auth()->id())
            ->delete();

        return back()->with(
            'success',
            __('public/user.messages.session_terminated')
        );
    }
}
