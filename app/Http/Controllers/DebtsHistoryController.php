<?php

namespace App\Http\Controllers;

use App\DebtsHistory;
use App\Http\Requests\DebtsHistoryCreationRequest;
use App\Http\Resources\Debt;
use App\Http\Resources\DebtsHistory as DebtsHistoryResource;

class DebtsHistoryController extends Controller
{
    private $debt;

    private $debtsHistory;

    public function __construct(Debt $debt, DebtsHistory $debtsHistory)
    {
        $this->debt = $debt;
        $this->debtsHistory = $debtsHistory;
    }

    public function index($userId, $debtId)
    {
        $debtHistory = $this->debtsHistory->where('debt_id', $debtId)->get();

        return DebtsHistoryResource::collection($debtHistory);
    }

    public function create(DebtsHistoryCreationRequest $request, $userId, $debtId)
    {
        $totalAmount = $request->type == 'give' ? $request->amount : -$request->amount;

        $debt = $this->debt->where('debt_id', $debtId)->get();
        $debt->total_amount += $totalAmount;
        $debtHistory = $debt->history()->create($request->all());
        $debt->save();

        return new DebtsHistoryResource($debtHistory);
    }
}
