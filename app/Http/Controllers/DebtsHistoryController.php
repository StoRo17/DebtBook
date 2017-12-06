<?php

namespace App\Http\Controllers;

use App\DebtsHistory;
use Illuminate\Http\Request;

class DebtsHistoryController extends Controller
{
    private $debtsHistory;

    public function __construct(DebtsHistory $debtsHistory)
    {
        $this->debtsHistory = $debtsHistory;
    }

    public function show($debtId)
    {
        $debtHistory = $this->debtsHistory->where('debt_id', $debtId);

        return $debtHistory;
    }
}
