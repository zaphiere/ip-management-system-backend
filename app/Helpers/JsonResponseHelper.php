<?php

namespace App\Helpers;

class JsonResponseHelper
{
    /**
     * Json template for success
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success($data = null, string $message = 'Success', int $code = 200)
    {
        $response = [
            'status' => 'success',
            'message' => $message,
        ];

        if($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    /**
     * Json template for success
     * Handles resource list
     *
     * @param array<mixed> $resource
     * @param string $message
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function successList(array $resource, string $message = 'Success', int $code = 200)
    {
        return response()->json(array_merge([
            'status' => 'success',
            'message' => $message,
        ], $resource), $code);
    }

    /**
     * Json template for error
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function error($data = null, string $message = 'Error', int $code = 400)
    {
        $response = [
            'status' => 'error',
            'message' => $message,
        ];

        if($data) {
            $response['data'] = $data;
        }

        return response()->json($response, $code);
    }

    /**
     * Json template for unauthorized
     *
     * @param string $message
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public static function unauthorized(string $message = 'Unauthorized Access')
    {
        return response()->json([
            'status' => 'unauthorized',
            'message' => $message,
        ], 401);
    }
}
