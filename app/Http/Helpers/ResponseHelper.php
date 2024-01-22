<?php
namespace app\Http\Helpers;

use Illuminate\Http\JsonResponse;

class ResponseHelper
{
    public static function response($data, $message = 'Success', $status = 200): JsonResponse
    {

        return response()->json([
            'code' => $status,
            'status' => $message,
            'data' => $data['value'],
            'error' => '',
            'pagination' => $data['paging'],
        ], $status);
    }
}
