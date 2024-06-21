<?php
namespace App\Traits;

use Illuminate\Support\Facades\Validator;

trait JsonResponse
{
    public function sendSuccess($data, $message = "success")
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
            'data' => $data,
        ]);
    }

    public function sendMessage($message)
    {
        return response()->json([
            'status' => 200,
            'message' => $message,
        ]);
    }

    public function unauthorized($message, $err = "unauthorized")
    {
        return response()->json([
            'status' => 401,
            'error' => $err,
            'message' => $message,
        ], 401);
    }

    public function badRequest($message, $err = "bad_request")
    {
        return response()->json([
            'status' => 400,
            'error' => $err,
            'message' => $message,
        ], 400);
    }

    public function forbidden($message, $err = "forbidden")
    {
        return response()->json([
            'status' => 403,
            'error' => $err,
            'message' => $message,
        ], 403);
    }

    public function validates($rules, $message = [], $attributes = [])
    {
        $validator = Validator::make(request()->all(), $rules, $message, $attributes);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'message' => $validator->errors()->first(),
                'error' => $validator->errors()
            ], 422)->send();
            exit();
        }
    }

    public function validateException($message = [])
    {
        return response()->json([
            'status' => 422,
            'message' => collect($message)->first(),
            'error' => $message
        ], 422);
    }
}
