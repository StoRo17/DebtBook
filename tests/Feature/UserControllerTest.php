<?php

namespace Tests\Feature;

use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserIdAndEmailReturns()
    {
        $user = factory(User::class)->states('verified')->create();

        Passport::actingAs($user, ['*']);

        $response = $this->getJson(route('getUser', $user->id));

        $response->assertSuccessful();
        $response->assertJson([
            'data' => [
                'id' => $user->id,
                'email' => $user->email,
            ]
        ]);
        $response->assertJsonMissing([
            'data' => [
                'verified' => $user->verified,
                'email_token' => $user->email_token
            ]
        ]);
    }
}
