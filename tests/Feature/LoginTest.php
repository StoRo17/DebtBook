<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class LoginTest extends TestCase
{
    use DatabaseMigrations;

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
        Artisan::call('passport:install');

        $password = 'secret';
        $user = factory(User::class)->create([
            'password' => bcrypt($password),
            'email_token' => null,
            'verified' => true,
        ]);

        $response = $this->postJson(route('login'), [
            'email' => $user->email,
            'password' => $password
        ]);

        $response->assertSuccessful();
        $response->assertJson([
            'success' => true,
            'message' => 'User logged in'
        ]);
        $this->assertArrayHasKey('tokens', $response->json());
    }

    public function testUserWithUnverifiedEmailCannotLogin()
    {
        $password = 'secret';
        $user = factory(User::class)->create();

        $response = $this->postJson(route('login'), [
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
        $response = $this->postJson(route('login'), [
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
        $response = $this->postJson(route('login'), [
            'email' => 'a@com',
            'password' => 'secret'
        ]);

        $this->errorMessage['errors'] = ['email' => [trans('validation.exists', ['attribute' => 'email'])]];

        $response->assertStatus(422);
        $response->assertJson($this->errorMessage);
    }
}
