<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\RegisterRequest;
use App\Jobs\SendVerificationEmail;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation.
    |
    */

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => base64_encode($data['email'])
        ]);
    }

    /**
     * Handle a registration request for the application.
     *
     * @param RegisterRequest|Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->create($request->only(['email', 'password']));
        $user->profile()->create($request->only(['first_name', 'last_name']));

        event(new Registered($user));
        dispatch(new SendVerificationEmail($user));

        return response()->json([
            'success' => true,
            'message' => 'Register complete.'
        ], 201);
    }

    /**
     * Verify user email.
     *
     * @param string $token
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function verify($token)
    {
        $user = User::where('email_token', $token)->first();
        $user->verified = true;
        $user->email_token = null;

        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'User email was verified.'
        ]);
    }
}
