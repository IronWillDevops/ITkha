<?php

namespace App\Http\Controllers\Public\User\Settings\Session;

use App\Http\Controllers\Controller;
use App\Models\Session;
use App\Models\User;
use App\Services\Public\DeviceDetector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(User $user, DeviceDetector $detector)
    {
        $currentSessionId = session()->getId();
        $sessions = DB::table('sessions')
            ->where('user_id', Auth::id())
            ->orderByRaw('id = ? DESC', [$currentSessionId]) 
            ->orderByDesc('last_activity')
            ->get()
            ->map(function ($session) use ($detector) {

                $info = $detector->parse($session->user_agent);

                return (object)[
                    'id' => $session->id,
                    'ip_address' => $session->ip_address,
                    'device' => $info['device'],
                    'platform' => $info['platform'],
                    'browser' => $info['browser'],
                    'icon' => $info['icon'],
                    'last_activity' => now()
                        ->setTimestamp($session->last_activity)
                        ->diffForHumans(),
                    'is_current' => $session->id === session()->getId(),
                ];
            });
        return view('public.user.settings.session.index', compact('user', 'sessions'));
    }
}
