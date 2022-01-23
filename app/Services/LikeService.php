<?php

namespace App\Services;

use App\Services\Realization\LikeRealization;

class LikeService extends LikeRealization
{
    public function add($id)
    {
        return $this->addLike($id);
    }

    public function remove($id)
    {
        return $this->removeLike($id);
    }
}
