<?php

namespace Tests\Unit;

use App\Jobs\SendVerificationEmail;
use App\Mail\EmailVerification;
use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SendVerificationEmailJobTest extends TestCase
{
    use RefreshDatabase;

    public function testSendVerificationEmailJob()
    {
        \Bus::fake();
        \Mail::fake();
        $user = factory(User::class)->create();

        dispatch(new SendVerificationEmail($user));
        \Mail::assertSent(EmailVerification::class);
    }
}
