<?php

namespace App\Http\Controllers;

use App\Debt;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    private $debts;

    public function __construct(Debt $debts)
    {
        $this->debts = $debts;
    }

    public function index($userId)
    {
        $debts = $this->debts->where('user_id', $userId)->get();

        return $debts;
    }
}
