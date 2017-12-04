<?php

namespace App\Http\Controllers;

use App\Debt;
use App\DebtsHistory;
use App\Http\Requests\DebtCreationRequest;
use App\Http\Resources\Debt as DebtResource;
use App\User;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    private $debt;

    public function __construct(Debt $debt)
    {
        $this->debt = $debt;
    }

    public function index($userId)
    {
        $debts = $this->debt->where('user_id', $userId)->get();

        return DebtResource::collection($debts);
    }

    public function create(DebtCreationRequest $request, $userId)
    {
        $totalAmount = $request->type == 'give' ? $request->amount : -$request->amount;

        $debt = $this->debt;
        $debt->currency_id = $request->currency_id;
        $debt->total_amount = $totalAmount;
        $debt->name = $request->name;

        $debt->user()->associate($request->user())->save();
        $debt->history()->create($request->all());

        return new DebtResource($debt);
    }
}
