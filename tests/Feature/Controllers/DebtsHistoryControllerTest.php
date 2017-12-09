<?php

namespace Tests\Feature\Controllers;

use App\Debt;
use App\User;
use Laravel\Passport\Passport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DebtsHistoryControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testDebtHistoryCreate()
    {
        $user = factory(User::class)->states('verified')->create();
        Passport::actingAs($user);

        $debt = $user->debts()->create([
            'total_amount' => 1000,
            'currency_id' => 1,
            'name' => 'John',
        ]);

        $data = [
            'amount' => 100,
            'type' => 'give',
            'comment' => 'Some comment',
        ];

        $response = $this->postJson(route('createDebtHistory', [$user->id, $debt->id]), [
            'amount' => $data['amount'],
            'type' => $data['type'],
            'comment' => $data['comment'],
        ]);

        $response->assertJson(['data' => $data]);
        $this->assertDatabaseHas('debts_histories', $data);
        $this->assertDatabaseHas('debts', [
            'id' => $debt->id,
            'total_amount' => 1100
        ]);
    }
}
