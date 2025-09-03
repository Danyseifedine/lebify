<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    /*
            |--------------------------------------------------------------------------
            | Email Verification Controller
            |--------------------------------------------------------------------------
            |
            | This controller is responsible for handling email verification for any
            | user that recently registered with the application. Emails may also
            | be re-sent if the user didn't receive the original email message.
            |
            */

    use VerifiesEmails;

    /**
     * Where to redirect users after verification.
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
        $this->middleware('auth');
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    protected function verified()
    {
        $verified = 1;
        $success = 1;

        return redirect($this->redirectTo . '?verified=' . $verified . '&success=' . $success);
    }

    public function resend(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return new JsonResponse([
                'message' => 'Email already verified.',
            ], 400);
        }

        $request->user()->sendEmailVerificationNotification();

        return new JsonResponse([
            'message' => 'Verification email sent!',
            'status' => 'success',
        ], 200);
    }
}
