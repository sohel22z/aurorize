<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Log;
use Throwable;

/**
 * ForgotPasswordController
 */
class ForgotPasswordController extends Controller
{

    use SendsPasswordResetEmails;

    /**
     * __construct
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin');
    }
    /**
     * Broker
     *
     * @return \Illuminate\Contracts\Auth\PasswordBroker
     */
    protected function broker()
    {
        return Password::broker('admins');
    }
    /**
     * ShowLinkRequestForm
     *
     * @return void
     * @author Anand parikh
     */
    public function showLinkRequestForm()
    {
        return view('admin.auth.email');
    }

    /**
     * SendResetLinkEmail
     *
     * @param  mixed $request
     * @return void
     * @author Anand Parikh
     */
    public function sendResetLinkEmail(Request $request)
    {
        try{
            $this->validate($request, ['email' => 'required|email']);
            $admin = Admin::where('email', $request->email)->first();
            
            if ($admin) {
                $response = $this->broker()->sendResetLink(
                    $request->only('email')
                );

                if ($response === Password::RESET_LINK_SENT) {
                    return redirect()->route('admin.login')
                        ->with('success', trans($response));
                }

                return back()->withErrors(
                    ['email' => trans($response)]
                );

            } else {
                return redirect()->back()
                    ->withErrors(['email'=> trans('auth.email_not_found')]);
            }
        } catch(Throwable $e){
            report($e);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
