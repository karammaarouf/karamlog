<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface ProfileServiceInterface
{
    public function getUserInformations();
    // Update the user's profile information.
    public function update(array $data);
    // Update the user's password.
    public function updatePassword(User $user, array $data);
}
