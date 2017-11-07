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

    public function testRegister()
    {
        Mail::fake();

        $email = 'johndoe@gmail.com';
        $response = $this->postJson(route('register'), [
            'email' => $email,
            'password' => '123456',
            'password_confirmation' => '123456'
        ]);

        Mail::assertSent(EmailVerification::class);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Register complete'
            ]);

        $this->assertDatabaseHas('users', [
            'email' => $email,
            'email_token' => base64_encode($email)
        ]);
    }

    public function testUserVerified()
    {
        $user = factory(User::class)->create();
        $response = $this->get("verify-email/{$user->email_token}");
        
        $response->assertRedirect('/email-confirmed');
        $this->assertDatabaseHas('users', [
            'email' => $user->email,
            'verified' => true,
            'email_token' => null,
        ]);
    }
}
