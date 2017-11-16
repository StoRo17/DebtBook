<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileRequest;
use App\Http\Resources\User as UserResource;

class ProfileController extends Controller
{
    public function update(ProfileRequest $request, $id)
    {
        $user = $request->user();
        $user->profile()->update($request->all());

        return (new UserResource($user))
            ->additional([
                'success' => true,
                'message' => 'Profile updated.'
            ]);
    }
}
