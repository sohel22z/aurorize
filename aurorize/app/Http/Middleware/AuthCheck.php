<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AuthCheck
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
        // This middleware used for API
        $user = Auth::user();
        if (!empty($user)) {
            if ($user->is_active == 2) {
                return response()->json(['status' => 401, 'message' => trans('auth.Your_account_is_not_deactivated'), 'result' => null], 401);
            }
        }
        if (empty($user)) {
            return response()->json(['status' => 403, 'message' => trans('auth.User_Deleted'), 'result' => null], 200);
        }

        return $next($request);
    }
}
