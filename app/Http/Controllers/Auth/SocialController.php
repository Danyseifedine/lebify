<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\SocialAccount;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback(Request $request, $provider)
    {
        try {
            $socialiteUser = Socialite::driver($provider)->user();
            $email = $socialiteUser->email;

            if ($provider == 'github' && !$email) {
                $email = $socialiteUser->nickname . '@github.com';
            }

            $user = User::firstOrCreate(
                ['email' => $email],
                [
                    'name' => $socialiteUser->name,
                    'email' => $email,
                    'email_verified_at' => now(),
                ]
            );

            if ($user->wasRecentlyCreated) {
                $userRole = Role::where('name', 'user')->first();
                if ($userRole) {
                    $user->addRole($userRole);
                }
            }

            $socialAccount = $user->socialAccounts()->updateOrCreate(
                ['provider' => $provider],
                [
                    'provider_id' => $socialiteUser->id,
                    'token' => $socialiteUser->token,
                ]
            );

            Auth::login($user);
            return redirect()->route('dashboard');
        } catch (Exception $e) {
            Log::error('Social login error: ' . $e->getMessage());
            return redirect()->route('login')
                ->withErrors(['error' => 'Unable to login using ' . $provider . '. Please try again.']);
        }
    }
}
