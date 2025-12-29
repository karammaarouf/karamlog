<?php

namespace App\Services\Interfaces;

use App\Models\User;

interface ProfileServiceInterface
{
    // Get the user's profile information.
    public function getUserInformations(User $user);
    // Get the user's contact information.
    public function getContactInformations(User $user);
    // Update the user's profile information.
    public function updateInformations(User $user, array $data);
    // Update the user's contact information.
    public function updateContactInformations(User $user, array $data);
    // Update the user's password.
    public function updatePassword(User $user, array $data);
}
