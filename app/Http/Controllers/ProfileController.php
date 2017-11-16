<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\User as UserResource;

class ProfileController extends Controller
{
    public function update(ProfileRequest $request, $id)
    {
        $user = $request->user();

        $path = '/storage/avatars/';
        if ($request->hasFile('avatar')) {
            $fileName = $id . '_avatar.jpg';
            $path .= $fileName;
            $request->file('avatar')->storeAs('/avatars', $fileName, 'public');
        } else {
            $path .= 'no_image.jpg';
        }

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
