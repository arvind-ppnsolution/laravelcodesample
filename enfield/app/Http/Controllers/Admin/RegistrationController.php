<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Utility\ValidationUtil;
use App\Notifications\TestNotification;
use App\Events\NewMessage;
use App\Models\User;
use Notification;
use Session;

class RegistrationController extends Controller
{
    use ValidationUtil;

    /**
     * For testing purpose
     *
     * @return anything for testing
     */
    public function test(){
        $rider = User::find(1);
       event(new NewMessage("home", "hello this is test"));
    }

    /**
     * For showing login form
     *
     * @return View responce blade view with data
     */
    public function loginForm(){
        return view('admin.auth.login');
    }

    /**
     * For logging in
     *
     * @param Request $request request body from client
     * @return Json responce data with http responce code
     */
    public function login(Request $request)
    {
        $valid = $this->loginRegistrationValidAdmin($request);
        if ($valid) {
            return $valid;
        }

        if (\Auth::attempt(['email' => $request->email, 'password' => $request->password], isset($request->remember) ? true : false)) {
            \Session::put('riders_admin_timezone', $request->tz);
            // Authentication passed...
            if(\Auth::user()->authorizeRole('Admin')){
                return response()->json([
                    'success' => true,
                    'message' => 'Login Successful',
                    'redirect' => route('admin.dashboard'),
                ]);
            }else {
                \Auth::logout();
                return response()->json([
                    'success' => false,
                    'message' => 'Wrong Credentials',
                    'redirect' => 'javascript:void(0)',
                ]);
            }
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Wrong Credentials',
                'redirect' => 'javascript:void(0)',
            ]);
        }
    }

    /**
     * For logging out
     *
     * @param Request $request request body from client
     * @return Route redirecting to login page
     */
    public function logout(Request $request)
    {
        \Auth::logout();
        \Session::forget('riders_admin_timezone');
        return redirect()->route('admin.login')->with('success', 'You are successfully logged out.');
    }

}
