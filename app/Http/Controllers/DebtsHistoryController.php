<?php

namespace App\Http\Controllers;

use App\Debt;
use App\DebtsHistory;
use App\Http\Requests\DebtsHistoryRequest;
use App\Http\Resources\DebtsHistory as DebtsHistoryResource;
use function foo\func;

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

    public function show($debtId, $debtHistoryId)
    {
        return new DebtsHistoryResource($this->debtsHistory->find($debtHistoryId));
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
        $debtHistoryElement = $this->debtsHistory->find($debtHistoryId);
        $debtHistoryElement->update($request->all());

        $debtHistoryTotalAmount = $this->debtsHistory->where('debt_id', $debtId)
            ->get()
            ->reduce(function ($totalAmount, $item) {
                $amount = $item->type == 'give' ? $item->amount : -$item->amount;
                return $totalAmount + $amount;
            });

        $debt = $this->debt->find($debtId);
        $debt->update(['total_amount' => $debtHistoryTotalAmount]);

        return new DebtsHistoryResource($debtHistoryElement);
    }

    public function delete($debtId, $debtHistoryId)
    {
        $debt = $this->debt->find($debtId);
        $debtHistory = $this->debtsHistory->find($debtHistoryId);

        $debt->total_amount -= $debtHistory->type == 'give' ? $debtHistory->amount : -$debtHistory->amount;
        $debt->save();

        $debtHistory->delete();

        return response()->json([
            'success' => true,
            'message' => 'Debt history deleted'
        ]);
    }
}
