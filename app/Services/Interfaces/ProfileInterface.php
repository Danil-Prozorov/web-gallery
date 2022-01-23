<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface ProfileInterface
{
    public function editProfile($text);

    public function updateProfilePicture(Request $request);

    public function uploadBackgroundPicture(Request $request);

    public function deleteProfile();
}
