<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Resources\EmployeeResource;
use Illuminate\Http\Exceptions\HttpResponseException;
use App\Http\Helpers\ResponseHelper;


class EmployeeController extends Controller
{
    public function store(EmployeeRequest $request): JsonResponse
    {

        $data = $request->validated();

        if ($request->hasFile('image_path')) {
            $imagePath = $request->file('image_path')->store('images', 'public');
            $data['image_path'] = $imagePath;
        }

        $employee = new Employee($data);
        $employee->save();

        return (new EmployeeResource($employee))->response()->setStatusCode(201);
    }


    public function update(int $id, EmployeeUpdateRequest $request): JsonResponse
    {

        $Employee = Employee::where('id', $id)->first();
        if(!$Employee){
            throw new HttpResponseException(response([
                "code" =>   "400",
                "status" => "false",
                "data" => [],
                "error" => [
                    "employee" => ["not found"],
                ]
            ], 404));
        }
        $data = $request->validated();
        if ($request->hasFile('image_path')) {
            // Handle upload and update image_path
            $imagePath = $request->file('image_path')->store('images', 'public');
            $data['image_path'] = $imagePath;
        }
        $Employee->fill($data);
        $Employee->save();



        return (new EmployeeResource($Employee))->response()->setStatusCode(200);
    }


    public function delete(int $id): JsonResponse{

        $Employee = Employee::where('id', $id)->first();
        if(!$Employee){
            throw new HttpResponseException(response([
                "code" =>   "400",
                "status" => "false",
                "data" => [],
                "error" => [
                    "employee" => ["not found"],
                ]
            ], 404));
        }

        $Employee->delete();

        return (new EmployeeResource($Employee))->response()->setStatusCode(200);
    }

    public function GetData(Request $request)
    {

        $filter = [
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'province_id' => $request->input('province_id'),
            'city_id' => $request->input('city_id'),
            'street_address' => $request->input('street_address'),
            'zip_code' => $request->input('zip_code'),
            'ktp_number' => $request->input('ktp_number'),
            'position_id' => $request->input('position_id'),
            'bank_id' => $request->input('bank_id'),
            'bank_account_number' => $request->input('bank_account_number'),
        ];

        $message = "Ok";
        $status = 200;
        $employeeQuery = Employee::query();

        // Apply filters
        $employeeQuery->when($filter, function ($query) use ($filter) {
            foreach ($filter as $field => $value) {
                if ($value) {
                    $query->where($field, 'like', '%' . $value . '%');
                }
            }
        });

        // Paginate the results
        $perPage = $request->input('per_page', 10); // You can adjust the per page count
        $users = $employeeQuery->paginate($perPage);

        // Extract next page URL
        $nextPageUrl = $users->nextPageUrl();
        $total = $users->total();
        if($total == 0){
            $message = "Data Not Found";
            $status = 404;
        }
        // Include next page URL in the response
        $response = [
            'value' => $users->items(),
            'paging' => [
                'next_page_url' => $nextPageUrl,
                'current_page' => $users->currentPage(),
                'per_page' => $perPage,
                'total' => $total
            ]
        ];

        return ResponseHelper::response($response, $message, $status);
    }



}
