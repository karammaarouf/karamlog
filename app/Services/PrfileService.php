<?php
namespace App\Services;

use App\Models\User;
use App\Models\UserInformation;
use Illuminate\Support\Facades\Hash;
use App\Services\Interfaces\ProfileServiceInterface;

class PrfileService implements ProfileServiceInterface
{
    // Get the user's profile information.
    public function getUserInformations(User $user)
    {
        return $user->userInformations()->firstOrCreate(['id' => $user->id]);
    }
    // Get the user's contact information.
    public function getContactInformations(User $user)
    {
        return $user->contactInformations()->firstOrCreate(['id' => $user->id]);
    }
    // Update the user's profile information.
    public function updateInformations(User $user, array $data)
    {
    $userInformations = $this->getUserInformations($user);

    // حقول جدول users فقط
    $userData = [
        'name' => $data['name'] ?? null,
        'email' => $data['email'] ?? null,
    ];

    // حقول جدول user_informations
    $infoData = collect($data)->except(['name', 'email', 'contact'])->toArray();
    $user->update($userData);
    $userInformations->update($infoData);   
    }
    // Update the user's contact information.
    public function updateContactInformations(User $user, array $data)
    {
        if (isset($data['contact'])) {
            $contactInformations = $this->getContactInformations($user);
            $contactInformations->update($data['contact']);
        }
    }
    // Update the user's password.
    public function updatePassword(User $user, array $data)
    {
        $user->password = Hash::make($data['new_password']);
        $user->save();
    }
}
