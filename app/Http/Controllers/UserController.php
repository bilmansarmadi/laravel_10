<?php

namespace App\Http\Controllers;
use App\Http\Helpers\ResponseHelper;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $filter = [
            'users_name' => $request->input('users_name'),
            'users_email' => $request->input('users_email'),
            'location' => $request->input('location'),
            'balance' => $request->input('balance'),
        ];
        $message = "Ok";
        $status = 200;
        $usersQuery = User::query();

        // Apply filters
        $usersQuery->when($filter, function ($query) use ($filter) {
            foreach ($filter as $field => $value) {
                if ($value) {
                    $query->where($field, 'like', '%' . $value . '%');
                }
            }
        });

        // Paginate the results
        $perPage = $request->input('per_page', 10); // You can adjust the per page count
        $users = $usersQuery->paginate($perPage);

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

    public function register(UserRegisterRequest $request): JsonResponse
    {
        $data = $request->validated();

        if(User::where('users_name', $data['users_name'])->count() == 1){
            throw new HttpResponseException(response([
                "code" =>   "400",
                "status" => "false",
                "data" => [],
                "error" => [
                    "users_name" => ["users already registered"],
                ]
            ], 400));
        }

        $user = new User($data);
        $user->users_password = Hash::make($data['users_password']);
        $user->save();

        return (new UserResource($user))->response()->setStatusCode(201);
    }

    public function login(UserLoginRequest $request): UserResource
    {
        $data = $request->validated();

        $user = User::where('users_email', $data['users_email'])->first();
        if (!$user || !Hash::check($data['users_password'], $user->users_password)) {
            throw new HttpResponseException(response([
                "code" => 401,
                "success" => false,
                "data" => null,
                "error" => [
                    "users_email" => ["Invalid email or password"],
                ]
            ], 401));
        }

        $user->users_token = Str::uuid()->toString();
        $user->save();

        return new UserResource($user);

    }

    public function get(Request $request): UserResource
    {
       $user = Auth::User();
       return new UserResource($user);
    }


}
