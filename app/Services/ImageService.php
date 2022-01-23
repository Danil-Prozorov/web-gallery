<?php

namespace App\Services;

use App\Models\Image;
use App\Services\Interfaces\ImageInterface;
use Illuminate\Http\Request;

class ImageService implements ImageInterface
{
    public function uploadImage(Request $request)
    {
        // Data packaging
        $image = $request['image']->store('uploads', 'public');
        $data  = [
            'user_id'     => strip_tags($request['user_id']),
            'image_path'  => $image,
            'description' => strip_tags($request['description'])
        ];

        // Creating new model instance
        Image::create($data);

        // TODO: Create Notification about new photo for all subscribers

        // Response
//        return response(['message' => 'Image uploaded successfully'], 201);
        return redirect();
    }

    public function updateImageData(Request $request)
    {
        // Find image
        $image = Image::find(strip_tags($request['id']))->first();

        // Data packaging
        $data = [
            'description' => strip_tags($request['description'])
        ];

        // Updating model instance
        $image->update($data);

        // Response
        return response(['message' => 'Image successfully updated'], 205);
    }

    public function removeImage(Request $request)
    {
        // Image search
        $image = Image::find(strip_tags($request['id']))->first();

        // Delete
        unlink("/storage/".$image['image_path']);
        $image->delete();

        // Response
        return response(['message' => 'Image deleted'], 200);
    }
}
