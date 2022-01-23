<?php

namespace App\Services;


use App\Services\Realization\ProfileRealization;
use Illuminate\Http\Request;

class ProfileService extends ProfileRealization
{
    public function edit()
    {
        return $this->editProfile();
    }
}
