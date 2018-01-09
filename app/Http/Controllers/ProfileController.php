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

    public function update(ProfileRequest $request, $id)
    {
        $user = $request->user();

        $user->profile()->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
        ]);

        return (new ProfileResource($user->profile))
            ->additional([
                'success' => true,
                'message' => 'Profile updated.'
            ]);
    }
}
