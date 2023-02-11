<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PatchProfileRequest;
use App\Http\Requests\UploadAvatarRequest;
use App\Http\Resources\ProfileResource;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function view(): ProfileResource
    {
        return new ProfileResource(auth()->user());
    }

    public function patch(PatchProfileRequest $request)
    {

    }

    public function uploadAvatar(UploadAvatarRequest $request)
    {

    }
}
