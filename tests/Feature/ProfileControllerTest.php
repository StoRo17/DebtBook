<?php

namespace Tests\Feature;

use App\Profile;
use App\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class, 1)
            ->states('verified')
            ->create()
            ->each(function ($u) {
                $u->profile()->save(factory(Profile::class)->make());
            })
            ->first();

        Passport::actingAs($this->user, ['*']);
    }

    public function testFirstAndLastNamesUpdate()
    {
        $firstName = 'John';
        $lastName = 'Doe';
        $response = $this->putJson(route('updateProfile', $this->user->id), [
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

    public function testAvatarUpload()
    {
        Storage::fake('public');
        $firstName = $this->user->profile->first_name;
        $lastName = $this->user->profile->last_name;

        $response = $this->putJson(route('updateProfile', $this->user->id),[
            'first_name' => $firstName,
            'last_name' => $lastName,
            'avatar' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertDatabaseHas('profiles', [
            'first_name' => $firstName,
            'avatar' => "/storage/avatars/{$this->user->id}_avatar.jpg"
        ]);

        Storage::disk('public')->assertExists("avatars/{$this->user->id}_avatar.jpg");
    }
}
