<?php

namespace App\Http\Controllers;

use App\Models\UserSetting;
use Illuminate\Http\Request;
use App\Services\UserSettingService;
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

    public function update(Request $request){
        $request->validate([
            'layout' => 'sometimes|string|in:rtl,ltr,Box',
            'sidebar_type' => 'sometimes|string|in:Vertical,Horizontal',
            'icon' => 'sometimes|string|in:Stroke,Colorful',
            'mode' => 'sometimes|string|in:Dark,Light,Mix',
            'color' => 'sometimes|string|in:#308e87,#57375D,#0766AD,#025464,#884A39,#0C356A',
        ]);
        $userSetting =UserSetting::firstOrCreate(['user_id' => $request->user()->id]);
        $this->userSettingService->setColor($userSetting,$request->color);
        $this->userSettingService->setMode($userSetting,$request->mode);
        $this->userSettingService->setLayout($userSetting,$request->layout);
        $this->userSettingService->setSidebarType($userSetting,$request->sidebar_type);
        $this->userSettingService->setIcon($userSetting,$request->icon);

        return redirect()->back()->with('success', 'Settings updated successfully');
    }
    public function setMode(Request $request){
        $request->validate([
            'mode' => 'required|string|in:Dark,Light,Mix',
        ]);
        $userSetting = UserSetting::firstOrCreate(['user_id' => $request->user()->id]);
        $this->userSettingService->setMode($userSetting,$request->mode);
        return redirect()->back()->with('success', 'Mode updated successfully');

    }    public function setLocale(Request $request){
        $request->validate([
            'locale' => 'required|string|in:en,ar',
        ]);
        $locale = strtolower($request->input('locale'));
        $userSetting = UserSetting::firstOrCreate(['user_id' => $request->user()->id]);
        $this->userSettingService->setLocale($userSetting,$locale);
        return redirect()->back()->with('success', 'Locale updated successfully');
    }
    /**
     * Set default settings for the user.
     */
    public function setDefault(Request $request){
        $userSetting = UserSetting::firstOrCreate(['user_id' => $request->user()->id]);
        $this->userSettingService->setDefault($userSetting);
        return redirect()->back()->with('success', 'Default settings set successfully');
    }
}
