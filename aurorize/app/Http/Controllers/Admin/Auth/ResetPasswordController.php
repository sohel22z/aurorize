<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }

    /**
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    public function broker()
    {
        return Password::broker('admins');
    }

    /**
     * showResetForm
     *
     * @param  mixed $request
     * @param  mixed $token
     * @return void
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    public function updatePassword(Request $request)
    {
        $this->validate(
            $request, [
                'email' => 'required',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password'
            ]
        );

        $user = Admin::where('email', $request->email)->first();

        if ($user) {
            $user['password'] = Hash::make($request->password);
            $user->save();
            if (Auth::guard('admin')->attempt(
                [
                    'email' => $request->email,
                    'password' => $request->password
                ],
                $request->get('remember')
            )
            ) {
                return redirect()->route('admin.dashboard')->withInput()
                    ->with('success', trans('message.Logged_in_successfully'));
            } else {
                return redirect()->route('login')->with('success', 'Success! password has been changed');
            }
        }
        return redirect()->route('forgot-password')->with('failed', 'Failed! something went wrong');
    }

    /**
     * SendResetResponse
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    protected function sendResetResponse(Request $request, $response)
    {
        return redirect($this->redirectPath())->with('success', trans($response));
    }

    /**
     * SendResetFailedResponse
     *
     * @param  mixed $request
     * @param  mixed $response
     * @return void
     */
    protected function sendResetFailedResponse(Request $request, $response)
    {
        return redirect()->back()->withInput($request->only('email'))
            ->withErrors(['email' => trans($response)])
            ->with('error', trans($response));
    }

    /**
     * RedirectTo
     *
     * @return void
     */
    public function redirectTo()
    {
        Auth::logout();
        return $this->redirectTo;
    }
}
