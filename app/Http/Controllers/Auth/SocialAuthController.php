<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class SocialAuthController extends Controller
{
public function redirect()
{
    return Socialite::driver('google')->redirect();
}
public function callback()
{
    $socialUser = Socialite::driver('google')->user();

    $user = User::firstOrCreate(
        ['email' => $socialUser->getEmail()],
        [
            'name'        => $socialUser->getName() ?? 'Google User',
            'password'    => bcrypt(Str::random(24)),
            'provider'    => 'google',
            'provider_id' => $socialUser->getId(),
        ]
    );

    $user->update([
        'provider'    => 'google',
        'provider_id' => $socialUser->getId(),
    ]);

    auth()->login($user);

    return redirect()->route('dashboard.index');
}

}
