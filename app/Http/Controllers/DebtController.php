<?php

namespace App\Http\Controllers;

use App\Debt;
use App\Http\Requests\DebtCreationRequest;
use App\Http\Resources\Debt as DebtResource;

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

    public function show($debtId)
    {
        return new DebtResource($this->debt->find($debtId));
    }

    public function create(DebtCreationRequest $request)
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

    public function delete($debtId)
    {
        $debt = $this->debt->find($debtId);
        $debt->delete();

        return response()->json([
            'success' => true,
            'message' => 'Debt deleted'
        ]);
    }
}
