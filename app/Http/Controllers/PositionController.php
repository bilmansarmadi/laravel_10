<?php

namespace App\Http\Controllers;

use App\Models\Position;
use Illuminate\Http\Request;
use App\Http\Resources\PositionResource;

class PositionController extends Controller
{
    public function index(Request $request)
    {
        $positions = Position::all();

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => PositionResource::collection($positions),
            'error' => null,
        ]);
    }
}
