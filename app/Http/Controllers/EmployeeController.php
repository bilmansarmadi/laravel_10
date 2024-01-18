<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;


class EmployeeController extends Controller
{
    public function store(EmployeeRequest $request): JsonResponse
    {

        $data = $request->validated();

        $employee = Employee::create($data->all());

        return response()->json(['message' => 'Employee created successfully', 'data' => $employee], 201);
    }

}
