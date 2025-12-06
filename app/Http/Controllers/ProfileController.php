<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserInformation;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $userInformations = $user->userInformations;
        return view('pages.dashboard.profile.index', compact('user', 'userInformations'));
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validatedUser = $request->validate([
            'name' => ['required','string','max:255'],
            'email' => ['required','email','max:255','unique:users,email,'.$user->id],
            'password' => ['nullable','confirmed','min:8'],
        ]);

        $userData = [
            'name' => $validatedUser['name'],
            'email' => $validatedUser['email'],
        ];
        if (!empty($validatedUser['password'])) {
            $userData['password'] = bcrypt($validatedUser['password']);
        }
        $user->update($userData);

        $validatedInfo = $request->validate([
            'birth_date' => ['nullable','date'],
            'phone' => ['nullable','string','max:50'],
            'address' => ['nullable','string','max:255'],
            'city' => ['nullable','string','max:100'],
            'state' => ['nullable','string','max:100'],
            'country' => ['nullable','string','max:100'],
        ]);

        $info = UserInformation::firstOrNew(['id' => $user->id]);
        $info->fill($validatedInfo);
        $info->id = $user->id;
        $info->save();

        return redirect()->route('profile.index')->with('success', __('Profile updated successfully'));
    }
}
