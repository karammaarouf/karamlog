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

    // 1️⃣ ابحث عن المستخدم عبر provider
    $user = User::where('provider', 'google')
        ->where('provider_id', $socialUser->getId())
        ->first();

    // 2️⃣ إذا ما لقيته، ابحث بالإيميل
    if (!$user && $socialUser->getEmail()) {
        $user = User::where('email', $socialUser->getEmail())->first();
    }

    // 3️⃣ إذا ما زال غير موجود → أنشئه
    if (!$user) {
        $user = User::create([
            'name'        => $socialUser->getName() ?? 'Google User',
            'email'       => $socialUser->getEmail(),
            'password'    => bcrypt(Str::random(24)),
            'provider'    => 'google',
            'provider_id' => $socialUser->getId(),
        ]);
    } else {
        // 4️⃣ اربط الحساب الحالي بـ Google
        $user->update([
            'provider'    => 'google',
            'provider_id' => $socialUser->getId(),
        ]);
    }

    auth()->login($user);

    return redirect()->route('home');
}

}
