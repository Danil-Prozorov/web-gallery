<?php

namespace App\Services;

use App\Models\Image;
use App\Services\Realization\ImageRealization;
use Illuminate\Http\Request;

class ImageService extends ImageRealization
{
    public function upload(Request $request)
    {
        return $this->uploadImage($request);
    }

    public function update(Request $request)
    {
        return $this->updateImageData($request);
    }

    public function delete(Request $request)
    {
        return $this->removeImage($request);
    }

}
