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

    private $errorMessage;

    public function setUp()
    {
        parent::setUp();
        $this->user = factory(User::class)->states('verified')->create();
        $this->user->profile()->save(factory(Profile::class)->make());

        Passport::actingAs($this->user, ['*']);

        $this->errorMessage = [
            'message' => 'The given data was invalid.',
            'errors' => []
        ];
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
        ]);
        $response->assertJson([
            'success' => true,
            'message' => 'Profile updated.'
        ]);

        $responseArray = $response->json();
        $this->assertEquals($firstName, $responseArray['data']['first_name']);
        $this->assertEquals($lastName, $responseArray['data']['last_name']);
    }

    public function testReceiveErrorsWhenSendInvalidData()
    {
        $response = $this->putJson(route('updateProfile', $this->user->id));

        $this->errorMessage['errors'] = [
            'first_name' => [trans('validation.required', ['attribute' => 'first name'])],
            'last_name' => [trans('validation.required', ['attribute' => 'last name'])]
        ];
        $response->assertStatus(422)
            ->assertExactJson($this->errorMessage);
    }
}
