<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class User
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::guard('web')->user();
        if ($user) {
            if (in_array($user->role_id, [2])) {
                if ($user->is_active == 2) {
                    Auth::logout();
                    if ($request->ajax()) {
                        return response()->json(
                            [
                                'status' => false,
                                'message' => trans('auth.account_deactivate')
                            ],
                            401
                        );
                    }
                    return redirect()->route('login')->with('warning', trans('auth.account_deactivate'));
                } else if ($user->is_complete_profile == 0 && !in_array(Route::currentRouteName(), ['user.complete.profile', 'user.complete.profile.save'])) {
                    return redirect()->route('user.complete.profile');
                }
                return $next($request);
            }
            return redirect('/home')->with('warning', trans('auth.sufficient_permissions'));
        }
        return redirect('/')->with('warning', trans('auth.account_deleted'));
    }
}
