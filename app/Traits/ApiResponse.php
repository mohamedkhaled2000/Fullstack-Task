<?php

namespace App\Traits;

trait ApiResponse {
    /**
     * @param mixed $data
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function successResponse($data, string $message = 'Success', int $status = 200)
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $status);
    }

    /**
     * @param string $message
     * @param int $status
     * @return \Illuminate\Http\JsonResponse
     */
    public function errorResponse(string $message, int $status)
    {
        return response()->json([
            'status' => $status,
            'message' => $message
        ], $status);
    }
}
