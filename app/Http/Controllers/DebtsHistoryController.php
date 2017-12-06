<?php

namespace App\Http\Controllers;

use App\DebtsHistory;
use App\Http\Resources\DebtsHistory as DebtsHistoryResource;

class DebtsHistoryController extends Controller
{
    private $debtsHistory;

    public function __construct(DebtsHistory $debtsHistory)
    {
        $this->debtsHistory = $debtsHistory;
    }

    public function show($userId, $debtId)
    {
        $debtHistory = $this->debtsHistory->where('debt_id', $debtId);

        return new DebtsHistoryResource($debtHistory);
    }
}
