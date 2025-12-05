<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();
        $userSettings = $request->user()->userSettings;
        if ($userSettings) {
            $layout = $userSettings->layout;
            $dir = in_array(strtolower($layout), ['rtl','ltr']) ? strtolower($layout) : 'box';
            session(['dir' => $dir]);
            session(['sidebar_type' => $userSettings->sidebar_type]);
            session(['icon' => $userSettings->icon]);
            session(['color' => $userSettings->color]);
            $mode = $userSettings->mode;
            session(['mode' => $mode]);
            $themeClass = $mode === 'Dark' ? 'dark-only' : ($mode === 'Mix' ? 'dark-sidebar' : 'light');
            session(['theme_class' => $themeClass]);
            $code = strtolower($userSettings->locale) === 'ar' ? 'ar' : 'en';
            session(['locale' => $code]);
            app()->setLocale($code);
        }
        $request->session()->regenerate();
        return redirect()->route('home');
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        session()->flush();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
