<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Lang;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    public function testUserWithVerifiedEmailCanLogin()
    {
        $password = 'secret';
        $user = factory(User::class)->create([
            'password' => bcrypt($password),
            'email_token' => null,
            'verified' => true,
        ]);

        $response = $this->postJson('auth/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertSuccessful();
        $response->assertJson([
            'message' => 'User logged in'
        ]);
    }

    public function testUserWithUnverifiedEmailCannotLogin()
    {
        $password = 'secret';
        $user = factory(User::class)->create();

        $response = $this->postJson('auth/login', [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertStatus(422);
        $response->assertJson([
            'message' => 'The given data was invalid.',
            'errors' => [
                'email' => ['Email has not been verified']
            ]
        ]);
    }
}
