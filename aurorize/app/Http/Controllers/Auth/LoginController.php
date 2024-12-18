<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:web')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('web');
    }

    /**
     * Login
     *
     * @param  mixed $request
     * @return void
     * @author Anand parikh
     */
    public function login(Request $request)
    {
        $this->validate(
            $request,
            [
                'email'   => 'required|email',
                'password' => 'required|min:6'
            ]
        );

        if (Auth::guard('web')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            $user = Auth::guard('web')->user();
            if ($user->role_id != 2) {
                Auth::logout();
                return redirect()->back()->with('warning', trans('auth.sufficient_permissions'));
            } else if ($user->role_id == 2) {
                if ($user->is_active == 2) {
                    Auth::logout();
                    return redirect()->back()->with('warning', trans('auth.account_deactivate'));
                }
            }
            return redirect()->route('home')->with('success', trans('auth.Logged_in_successfully'));
        } else {
            return redirect()->route('login')->withInput()->with('error', trans('auth.failed'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * SendFailedLoginResponse
     *
     * @return void
     */
    public function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput()
            ->with('warning', trans('auth.failed'));
    }

    /**
     * RedirectTo
     *
     * @return void
     */
    public function redirectTo()
    {
        return $this->redirectTo;
    }

    /**
     * Logout
     *
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request)
    {
        auth()->guard('web')->logout();
        $request->session()->regenerate();

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }
}
