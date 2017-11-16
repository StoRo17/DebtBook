<?php

namespace Tests\Feature;

use App\Profile;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testFirstAndLastNamesUpdate()
    {
        $user = factory(User::class, 1)
            ->states('verified')
            ->create()
            ->each(function ($u) {
                $u->profile()->save(factory(Profile::class)->make());
            })
            ->first();

        Passport::actingAs($user, ['*']);

        $firstName = 'John';
        $lastName = 'Doe';
        $response = $this->putJson(route('updateProfile', $user->id), [
            'first_name' => $firstName,
            'last_name' => $lastName,
        ]);

        $this->assertDatabaseHas('profiles', [
            'first_name' => $firstName,
            'last_name' => $lastName,
            'avatar' => '/storage/avatars/no_image.jpg'
        ]);
        $response->assertJson([
            'success' => true,
            'message' => 'Profile updated.'
        ]);

        $responseArray = $response->json();
        $this->assertEquals($firstName, $responseArray['data']['profile']['first_name']);
        $this->assertEquals($lastName, $responseArray['data']['profile']['last_name']);
    }
}
