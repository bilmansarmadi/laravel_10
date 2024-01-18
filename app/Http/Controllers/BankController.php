<?php

namespace App\Http\Controllers;

use App\Models\Bank;
use Illuminate\Http\Request;
use App\Http\Resources\BankResource;

class BankController extends Controller
{
    public function index(Request $request)
    {
        $banks = Bank::all();

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => BankResource::collection($banks),
            'error' => null,
        ]);
    }
}
