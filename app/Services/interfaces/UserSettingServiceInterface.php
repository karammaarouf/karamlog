<?php

namespace App\Services\Interfaces;

use App\Models\UserSetting;

interface UserSettingServiceInterface
{
    // Update the user's settings.
    public function update(UserSetting $userSetting, array $data);
     // Set the user's mode preference.
    public function setMode(UserSetting $userSetting, $mode);
    // Set the user's locale preference.
    public function setLocale(UserSetting $userSetting, $locale);
    // Set the user's color preference.
    public function setColor(UserSetting $userSetting, $color);

    // Set the user's sidebar type preference.
    public function setSidebarType(UserSetting $userSetting, $sidebar_type);

    // Set the user's icon preference.
    public function setIcon(UserSetting $userSetting, $icon);

    // Set the user's layout preference.
    public function setLayout(UserSetting $userSetting, $layout);

    // Set default settings for the user.
    public function setDefault(UserSetting $userSetting);
    // Set the user's sessions preference.
    public function setSessions(UserSetting $userSetting);

}
