<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface ImageInterface
{
    public function uploadImage(Request $request);

    public function updateImageData(Request $request);

    public function removeImage(Request $request);
}
