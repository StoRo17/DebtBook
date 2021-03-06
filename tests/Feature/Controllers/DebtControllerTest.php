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
        $this->user = factory(User::class)
            ->states('verified')
            ->create();

        Passport::actingAs($this->user, ['*']);
    }

    public function testDebtCreateAndDebtHistoryAdd()
    {
        $data = [
            'amount' => 100,
            'currency_id' => 1,
            'name' => 'John',
            'type' => 'give',
            'comment' => 'Beer',
        ];

        $response = $this->postJson(route('createDebt', $this->user->id), $data);
        $data['id'] = $this->user->debts()
            ->where('name', $data['name'])
            ->limit(1)
            ->first()
            ->id;

        $response->assertJson([
            'data' => [
                'id' => $data['id'],
                'total_amount' => $data['amount'],
                'currency_id' => $data['currency_id'],
                'name' => $data['name'],
            ]
        ]);
        $this->assertDatabaseHas('debts', [
            'id' => $data['id'],
            'total_amount' => $data['amount'],
            'currency_id' => $data['currency_id'],
            'name' => $data['name'],
        ]);
        $this->assertDatabaseHas('debts_histories', [
            'debt_id' => $data['id'],
            'amount' => $data['amount'],
            'type' => $data['type'],
            'comment' => $data['comment'],
        ]);
    }
}
