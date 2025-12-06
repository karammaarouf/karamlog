<?php

namespace App\Services;

use App\Models\UserSetting;
use App\Services\Interfaces\UserSettingServiceInterface;

class UserSettingService implements UserSettingServiceInterface
{
    // Set the user's mode preference.
    public function setMode(UserSetting $userSetting, $mode)
    {
        $userSetting->update(['mode' => $mode]);
        $userSetting->save();
        session()->put(['mode' => $mode]);
        $themeClass = $mode === 'Dark' ? 'dark-only' : ($mode === 'Light' ? 'light' : 'dark-sidebar');
        session()->put(['theme_class' => $themeClass]);
    }
    public function setColor(UserSetting $userSetting, $color)
    {
        // Set the user's color preference.
        $userSetting->update(['color' => $color]);
        $userSetting->save();
        session()->put(['color' => $color]);
    }
    // Set the user's sidebar type preference.
    public function setSidebarType(UserSetting $userSetting, $sidebar_type)
    {
        // Set the user's sidebar type preference.
        $userSetting->update(['sidebar_type' => $sidebar_type]);
        $userSetting->save();
        session()->put(['sidebar_type' => $sidebar_type]);
    }
    // Set the user's icon preference.
    public function setIcon(UserSetting $userSetting, $icon)
    {
        // Set the user's icon preference.
        $userSetting->update(['icon' => $icon]);
        $userSetting->save();
        session()->put(['icon' => $icon]);
    }
    // Set the user's layout preference.
    public function setLayout(UserSetting $userSetting, $layout)
    {
        // Set the user's layout preference.
        $userSetting->update(['layout' => $layout]);
        $userSetting->save();
        if (strtolower($layout) === 'rtl') {
            session()->put(['dir' => 'rtl']);
        } elseif (strtolower($layout) === 'ltr') {
            session()->put(['dir' => 'ltr']);
        } else {
            session()->put(['dir' => 'box']);
        }
    }
    // Set the user's locale preference.
    public function setLocale(UserSetting $userSetting, $locale)
    {
        // Set the user's locale preference.
        $layout= $locale == 'en' ? 'ltr' : 'rtl';
        $userSetting->update(['locale' => $locale, 'layout' => $layout]);
        app()->setLocale($locale);
        session()->put(['locale' => $locale]);
        session()->put(['dir' => $layout]);
        $userSetting->save();
    }
    // Set default settings for the user.
    public function setDefault(UserSetting $userSetting)
    {
        // Set default settings for the user.
        $userSetting->update([
            'mode' => 'Light',
            'color' => '#308e87',
            'sidebar_type' => 'Vertical',
            'icon' => 'Stroke',
            'layout' => 'ltr',
            'locale' => 'en',
        ]);
        $userSetting->save();
        session()->flush();
        session()(['theme_class' => 'light']);
        session()(['mode' => $userSetting->mode]);
        session()(['color' => $userSetting->color]);
        session()(['sidebar_type' => $userSetting->sidebar_type]);
        session()(['icon' => $userSetting->icon]);
        session()(['locale' => $userSetting->locale]);
        session()(['dir' => 'ltr']);
    }
}
