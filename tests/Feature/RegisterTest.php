<?php

namespace Tests\Feature;

use App\Mail\EmailVerification;
use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegisterTest extends TestCase
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

    public function testRegister()
    {
        Mail::fake();

        $email = 'johndoe@gmail.com';
        $firstName = 'John';
        $lastName = 'Doe';

        $response = $this->postJson(route('register'), [
            'email' => $email,
            'password' => '123456',
            'password_confirmation' => '123456',
            'first_name' => $firstName,
            'last_name' => $lastName
        ]);

        Mail::assertSent(EmailVerification::class);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'message' => 'Register complete.'
            ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'email_token' => base64_encode($email)
        ]);

        $this->assertDatabaseHas('profiles', [
            'id' => 1,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'avatar' => '/storage/avatars/no_image.jpg',
            'user_id' => 1
        ]);
    }

    public function testRegisterFailsWhenSendEmptyData()
    {
        $response = $this->postJson(route('register'));

        $requiredString = 'validation.required';
        $this->errorMessage['errors'] = [
            'email' => [trans($requiredString, ['attribute' => 'email'])],
            'password' => [trans($requiredString, ['attribute' => 'password'])],
            'first_name' => [trans($requiredString, ['attribute' => 'first name'])],
            'last_name' => [trans($requiredString, ['attribute' => 'last name'])],
        ];

        $response->assertStatus(422);
        $response->assertJson($this->errorMessage);
    }

    public function testUserVerified()
    {
        $user = factory(User::class)->create();
        $response = $this->get(route('verifyEmail', $user->email_token));

        $response->assertJson([
            'success' => true,
            'message' => 'User email was verified.'
        ]);
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'verified' => true,
            'email_token' => null,
        ]);
    }
}
