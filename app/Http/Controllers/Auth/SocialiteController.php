<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the provider's authentication page.
     */
    public function redirect($provider)
    {
        if (!in_array($provider, ['github', 'google'])) {
            abort(404);
        }

        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from the provider and handle authentication.
     */
    public function callback($provider)
    {
        if (!in_array($provider, ['github', 'google'])) {
            abort(404);
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
        } catch (\Exception $e) {
            if (Auth::check()) {
                return redirect()->route('profile.edit')->withErrors(['status' => 'Account connection failed. Please try again.']);
            }
            return redirect()->route('login')->withErrors(['email' => 'External authentication failed. Please try again.']);
        }
        if (Auth::check()) {
            $currentUser = Auth::user();

            $existingAccount = User::where('provider', $provider)
                ->where('provider_id', $socialUser->getId())
                ->first();

            if ($existingAccount && $existingAccount->id !== $currentUser->id) {
                return redirect()->route('profile.edit')
                    ->withErrors(['status' => 'This ' . ucfirst($provider) . ' account is already linked to another user.']);
            }

            $currentUser->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
                'avatar' => $currentUser->avatar ?? $socialUser->getAvatar(),
            ]);

            return redirect()->route('profile.edit')->with('status', 'account-connected');
        }

        $user = User::where('provider', $provider)
            ->where('provider_id', $socialUser->getId())
            ->first();

        if (!$user) {
            $user = User::where('email', $socialUser->getEmail())->first();

            if ($user) {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'provider_token' => $socialUser->token,
                    'avatar' => $user->avatar ?? $socialUser->getAvatar(),
                ]);
            }
        }

        if (!$user) {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'OAuth User',
                'email' => $socialUser->getEmail(),
                'password' => null,
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'provider_token' => $socialUser->token,
                'avatar' => $socialUser->getAvatar(),
            ]);
        }

        Auth::login($user);

        return redirect()->route('dashboard');
    }
}