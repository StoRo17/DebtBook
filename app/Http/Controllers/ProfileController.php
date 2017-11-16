<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\User as UserResource;
use App\Services\AvatarHandler;

class ProfileController extends Controller
{
    public function update(ProfileRequest $request, AvatarHandler $avatarHandler, $id)
    {
        $user = $request->user();

        $path = $avatarHandler->handleUploadedImage($request, $id);

        $user->profile()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'avatar' => $path
        ]);

        return (new UserResource($user))
            ->additional([
                'success' => true,
                'message' => 'Profile updated.'
            ]);
    }
}
