<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Province;
use App\Http\Resources\ProvinceResource;

class ProvinceController extends Controller
{
    public function index(Request $request)
    {
        $provinces = Province::all();

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => ProvinceResource::collection($provinces),
            'error' => null,
        ]);
    }
}
