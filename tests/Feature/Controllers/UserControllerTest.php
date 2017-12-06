<?php

namespace Tests\Feature;

use App\Profile;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testUserWithProfileReturns()
    {
        $user = factory(User::class, 1)
            ->states('verified')
            ->create()
            ->each(function ($u) {
                $u->profile()->save(factory(Profile::class)->make());
            })
            ->first();

        Passport::actingAs($user, ['*']);

        $response = $this->getJson(route('getUser', $user->id));

        $response->assertSuccessful();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'email',
                'profile' => [
                    'id',
                    'user_id',
                    'first_name',
                    'last_name',
                    'avatar'
                ]
            ]
        ]);
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
