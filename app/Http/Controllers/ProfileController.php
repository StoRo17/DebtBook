<?php

namespace App\Http\Controllers;

use App\Http\Resources\Profile as ProfileResource;
use App\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function show(Request $request, $id)
    {
        return new ProfileResource(Profile::find($id));
    }
}
