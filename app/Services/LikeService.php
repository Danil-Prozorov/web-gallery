<?php

namespace App\Services;

use App\Models\Image_storage as Image;
use App\Models\Like;
use App\Services\Interfaces\LikeInterface;

class LikeService implements LikeInterface
{
    public function addLike($id)
    {
        // Searching images with id == $id
        $image = Image::findOrFail($id)->first();
        $data  = [
            'user_id'    => Auth::id(),
            'image_id'   => $image['id'],
            'image_path' => $image['image_path']
        ];

        // Update image likes counter
        $image->update(['likes_count' => $image['likes_count']++]);
        Like::create($data);
        // TODO: Create Notification here

        // Response
        return response(['message' => 'Like successfully added'], 201);
    }

    public function removeLike($id)
    {
        // Find
        $image = Image::findOrFail($id)->first();
        $like  = Like::findWhere('image_id', $image['id'])->first();

        // Remove 'like'
        if($image['likes_count'] > 0) {
            $image->update([$image['likes_count'] => $image['likes_count']--]);
            $like->delete();

            // Response
            return response(['message' => 'Like was removed'], 200);
        }

        // Response if 'like' counter equal zero or less
        return response(['message' => 'Like less or equal to zero'], 410);
    }
}
