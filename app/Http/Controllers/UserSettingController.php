<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Services\UserSettingService;
use App\Http\Requests\UserSettingUpdateRequest;

class UserSettingController extends Controller
{
    protected $userSettingService;

    public function __construct(UserSettingService $userSettingService)
    {
        $this->userSettingService = $userSettingService;
    }
    
    public function index()
    {
        $userSetting = UserSetting::firstOrCreate(['user_id' => auth()->user()->id]);
        return view('pages.user-settings.index', compact('userSetting'));
    }

    public function update(UserSettingUpdateRequest $request){

        $userSetting =UserSetting::firstOrCreate(['user_id' => $request->user()->id]);
        $this->userSettingService->setColor($userSetting,$request->color);
        $this->userSettingService->setMode($userSetting,$request->mode);
        $this->userSettingService->setLayout($userSetting,$request->layout);
        $this->userSettingService->setSidebarType($userSetting,$request->sidebar_type);
        $this->userSettingService->setIcon($userSetting,$request->icon);

        return redirect()->back()->with('success', __('Settings updated successfully'));
    }

    public function setMode(UserSettingUpdateRequest $request){

        $userSetting = UserSetting::firstOrCreate(['user_id' => $request->user()->id]);
        $this->userSettingService->setMode($userSetting,$request->mode);
        return redirect()->back()->with('success', __('Mode updated successfully'));


    }    
    
    public function setLocale(UserSettingUpdateRequest $request){

        $locale = strtolower($request->input('locale'));
        $userSetting = UserSetting::firstOrCreate(['user_id' => $request->user()->id]);
        $this->userSettingService->setLocale($userSetting,$locale);
        return redirect()->back()->with('success', __('Locale updated successfully'));
    }
    /**
     * Set default settings for the user.
     */
    public function setDefault(){

        $userSetting = UserSetting::firstOrCreate(['user_id' => auth()->user()->id]);
        $this->userSettingService->setDefault($userSetting);
        return redirect()->back()->with('success', __('Default settings set successfully'));
    }
}
