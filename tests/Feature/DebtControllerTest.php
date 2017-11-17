<?php

namespace Tests\Feature;

use App\Debt;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DebtControllerTest extends TestCase
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
                $u->debts()->saveMany(factory(Debt::class, 5)->make());
            })
            ->first();

        Passport::actingAs($this->user, ['*']);
    }

    public function testIndex()
    {
        $response = $this->getJson(route('getDebts', $this->user->id));
        $response->assertJson($this->user->debts->toArray());
    }
}
