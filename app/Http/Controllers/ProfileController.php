<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\Profile as ProfileResource;
use App\Services\AvatarHandler;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request)
    {
        return new ProfileResource($request->user()->profile);
    }

    public function update(ProfileRequest $request, AvatarHandler $avatarHandler, $id)
    {
        $user = $request->user();

        $path = $avatarHandler->handleUploadedImage($request, $id);

        $user->profile()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'avatar' => $path
        ]);

        return (new ProfileResource($user->profile))
            ->additional([
                'success' => true,
                'message' => 'Profile updated.'
            ]);
    }
}
