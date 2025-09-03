<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm(Request $request)
    {
        if ($request->query('role') == 'admin') {
            return view('auth.admin.login');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $this->validateLogin($request);

        if ($this->attemptLogin($request)) {
            $user = $request->user();

            if ($request->query('role') == 'admin') {
                if (!$user->hasRole('admin')) {
                    Auth::logout();
                    return response()->json(['message' => 'Unauthorized. Admin access only.']);
                }
            } elseif ($request->query('auth') == 'user') {
                if ($user->hasRole('admin')) {
                    Auth::logout();
                    return response()->json(['message' => 'Unauthorized. User access only.']);
                }
            }

            return $this->sendLoginResponse($request);
        }

        return $this->sendFailedLoginResponse($request);
    }

    protected function authenticated()
    {
        $redirectToWithQuery = $this->redirectTo . '?success=1';
        return response()->json(['redirect' => $redirectToWithQuery]);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('landing.content');
    }
}
