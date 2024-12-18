<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

/**
 * LoginController
 */
class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/admin';

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }
    /**
     * ShowLoginForm
     *
     * @return void
     * @author Anand parikh
     */
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    /**
     * login
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

        if (Auth::guard('admin')->attempt(
            [
                'email' => $request->email,
                'password' => $request->password
            ],
            $request->get('remember')
        )) {
            return redirect()->route('admin.dashboard')->withInput()
                ->with('success', trans('message.Logged_in_successfully'));;
        } else {
            return redirect()->route('admin.login')->withInput()
                ->with('error', trans('auth.failed'));
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Logout
     *
     * @param  mixed $request
     * @return void
     * @author Anand Parikh
     */
    public function logout(Request $request)
    {
        if (Auth::guard('admin')->check()) {
            $this->redirectTo = "/admin/login";
        }
        // $this->guard()->logout();
        auth()->guard('admin')->logout();
        // $request->session()->invalidate();
        $request->session()->regenerate();

        return $this->loggedOut($request) ?: redirect($this->redirectTo);
    }
}
