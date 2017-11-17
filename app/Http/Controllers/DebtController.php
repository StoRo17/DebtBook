<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DebtController extends Controller
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    public function index($userId)
    {
        $user = $this->user->find($userId);

        return $user->debts;
    }
}
