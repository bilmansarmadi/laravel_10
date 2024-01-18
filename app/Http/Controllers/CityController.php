<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Resources\CityResource;

class CityController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all();

        return response()->json([
            'code' => 200,
            'success' => true,
            'data' => CityResource::collection($cities),
            'error' => null,
        ]);
    }
}
