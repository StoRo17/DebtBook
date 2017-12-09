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

    /**
     * @dataProvider debtHistoryCreateProvider
     */
    public function testDebtHistoryCreate($totalAmount, $amount, $type, $expectedTotalAmount)
    {
        $user = factory(User::class)->states('verified')->create();
        Passport::actingAs($user);

        $debt = $user->debts()->create([
            'total_amount' => $totalAmount,
            'currency_id' => 1,
            'name' => 'John',
        ]);

        $data = [
            'amount' => $amount,
            'type' => $type,
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
            'total_amount' => $expectedTotalAmount
        ]);
    }

    public function debtHistoryCreateProvider()
    {
        return [
            [1000, 100, 'give', 1100],
            [1000, 100, 'take', 900],
            [-1000, 100, 'give', -900],
            [100, 100, 'take', 0],
        ];
    }
}
