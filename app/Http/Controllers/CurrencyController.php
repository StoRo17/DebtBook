<?php

namespace App\Http\Controllers;

use App\Currency;

class CurrencyController extends Controller
{
    public function index()
    {
        return response()->json([
            'data' => Currency::all(),
        ]);
    }
}
