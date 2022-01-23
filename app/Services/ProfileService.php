<?php

namespace App\Services;


use App\Services\Realization\ProfileRealization;
use Illuminate\Http\Request;

class ProfileService extends ProfileRealization
{
    public function edit($text)
    {
        return $this->editProfile($text);
    }

    public function update($mod, Request $request)
    {
        if ($mod == 'profile') {
            return $this->updateProfilePicture($request);
        } elseif ($mod == 'background') {
            return $this->uploadBackgroundPicture($request);
        }

        return response(['message' => 'update or uploading file was impossible'], 403);
    }

    public function delete()
    {
        return $this->deleteProfile();
    }
}
