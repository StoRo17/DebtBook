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

    public function testIndex()
    {
        $this->user->debts()->saveMany(factory(Debt::class, 5)->make());
        $response = $this->getJson(route('getDebts', $this->user->id));
        $response->assertJson($this->user->debts->toArray());
    }

    public function testDebtCreateAndDebtHistoryAdd()
    {
        $data = [
            'amount' => '100',
            'currencyId' => '1',
            'name' => 'John',
            'type' => 'give',
            'comment' => 'Beer',
        ];

        $response = $this->postJson(route('createDebt', $this->user->id), $data);

        $data['id'] = 1;
        $data['total_amount'] = $data['amount'];
        unset($data['amount']);

        $response->assertJson($data);
        $this->assertDatabaseHas('debts', [
            'id' => $data['id'],
            'total_amount' => $data['total_amount'],
            'currency_id' => $data['currencyId'],
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
