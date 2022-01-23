<?php

namespace App\Services\Interfaces;

use Illuminate\Http\Request;

interface LikeInterface
{
    public function addLike($id);

    public function removeLike($id);
}
