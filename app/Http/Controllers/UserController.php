<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function show(Request $request, $id)
    {
        return new UserResource($request->user());
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = $request->user();

        if (Hash::check($request->password, $user->password)) {
            $user->password = bcrypt($request->new_password);
            $user->save();

            return response()->json([
                'message' => 'Password changed.',
                'success' => true,
            ]);
        }

        throw ValidationException::withMessages(['password' => ['Old password wrong.']]);
    }
}
