<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Support\Facades\Lang;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LoginTest extends TestCase
{
    use RefreshDatabase;

    protected $errorMessage;

    public function setUp()
    {
        parent::setUp();
        $this->errorMessage = [
            'message' => 'The given data was invalid.',
            'errors' => []
        ];
    }

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

        $this->errorMessage['errors'] = ['email' => [trans('auth.email_not_verified')]];

        $response->assertStatus(422);
        $response->assertJson($this->errorMessage);
    }

    public function testPasswordErrorReturns()
    {
        $user = factory(User::class)->states('verified')->create();
        $response = $this->postJson('auth/login', [
            'email' => $user->email,
            'password' => 'secret1'
        ]);

        $this->errorMessage['errors'] = ['password' => [trans('auth.wrong_password')]];

        $response->assertStatus(422);
        $response->assertJson($this->errorMessage);
    }

    public function testEmailErrorReturns()
    {
        factory(User::class)->states('verified')->create();
        $response = $this->postJson('auth/login', [
            'email' => 'a@com',
            'password' => 'secret'
        ]);

        $this->errorMessage['errors'] = ['email' => [trans('auth.wrong_email')]];

        $response->assertStatus(422);
        $response->assertJson($this->errorMessage);
    }
}
