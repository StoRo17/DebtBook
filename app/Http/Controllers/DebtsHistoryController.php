<?php

namespace App\Http\Controllers;

use App\Debt;
use App\DebtsHistory;
use App\Http\Requests\DebtsHistoryRequest;
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

    public function index($debtId)
    {
        $debtHistory = $this->debtsHistory->where('debt_id', $debtId)->get();

        return DebtsHistoryResource::collection($debtHistory);
    }

    public function create(DebtsHistoryRequest $request, $debtId)
    {
        $totalAmount = $request->type == 'give' ? $request->amount : -$request->amount;

        $debt = $this->debt->find($debtId);
        $debt->total_amount += $totalAmount;
        $debtHistory = $debt->history()->create($request->all());
        $debt->save();

        return new DebtsHistoryResource($debtHistory);
    }

    public function update(DebtsHistoryRequest $request, $debtId, $debtHistoryId)
    {
        $totalAmount = $request->type == 'give' ? $request->amount : -$request->amount;

        $debtHistory = $this->debtsHistory->find($debtHistoryId);
        $debtHistory->update($request->all());

        $this->debt->find($debtId)->update(['total_amount' => $totalAmount]);

        return new DebtsHistoryResource($debtHistory);
    }
}
