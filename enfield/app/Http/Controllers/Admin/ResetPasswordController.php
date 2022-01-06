<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Password;
use Auth;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

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
        $this->middleware('guest');
    }

    protected function guard()
    {
      return Auth::guard();
    }

    protected function broker()
    {
      return Password::broker();
    }

    /**
     * For showing reset password view
     *
     * @param Request $request request body from client
     * @param Token $token token for reset password
     * @return View responce blade view with data
     */
    public function showResetForm(Request $request, $token = null)
    {
        return view('admin.auth.reset-admin')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'token' => 'required',
            'email' => 'required|email',
            'password_confirmation' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }

    /**
     * Get the password reset validation error messages.
     *
     * @return array
     */
    protected function validationErrorMessages()
    {
        return [
          'password.required' => 'Password is required',
          'password_confirmation.required' => 'Confirm password is required',
          'password.confirmed' => "Password doesn't matched",
          'password.min' => 'Password should be minimum 8 characters',
        ];
    }
}
