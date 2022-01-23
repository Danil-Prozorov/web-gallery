<?php

namespace App\Services\Realization;

use App\Jobs\DeleteUserJob;
use App\Models\Image_storage as Image;
use App\Models\Profile;
use App\Services\Interfaces\ProfileInterface;
use Illuminate\Http\Request;

class ProfileRealization implements ProfileInterface
{
    public function editProfile($text)
    {
        // Find profile
        $profile = $this->getProfile();

        // Edit
        $profile->update(['profile_description' => strip_tags($text)]);

        // Response
        return response(['message' => 'Profile successfully updated'], 205);
    }

    public function updateProfilePicture(Request $request)
    {
        // Call function for update profile images
        return $this->updatePhoto(1, $request);
    }

    public function uploadBackgroundPicture(Request $request)
    {
        // Call function for update background profile images
        return $this->updatePhoto(2, $request);
    }

    public function deleteProfile()
    {
        // Find profile & user
        $profile = $this->getProfile();
        $user    = Auth::user();
        $images  = Image::where('user_id', $user['id']);

        if ($user['id'] == $profile['user_id']) {
            // Add Job for deleting in queue
            dispatch(new DeleteUserJob($user, $profile, $images));
        }

        // Redirect
        return redirect('/');
    }

    protected function getProfile()
    {
        return Profile::find(Auth::id())->first();
    }

    protected function storeImage($request)
    {
        $image = $request['image']->store('uploads', 'public');

        return $image;
    }

    protected function updatePhoto($i, $request)
    {
        // Save image
        $image = $this->storeImage($request);

        // Find profile
        $profile = $this->getProfile();
        if ($i == 1) {
            // Edit
            $profile->update(['profile_photo' => $image]);

            // Response
            return response(['message' => 'Profile picture successfully updated'], 205);
        } elseif ($i == 2) {
            $profile->update(['background_profile_photo' => $image]);

            return response(['message' => 'Background picture successfully updated'], 205);
        }
    }
}
