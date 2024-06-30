<?php

namespace App\Http\Controllers;

abstract class Controller
{
    /**
     * success response method.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result)
    {
        $response = [
            'success' => true,
            'data'    => $result,
            'errorCode' => 0,
        ];

        return response()->json($response, 200);
    }

    /**
     * return error response.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($errorCode, $errorMessages = [], $code = 404)
    {
        $response = [
            'success' => false,
            'data'    => !empty($errorMessages) ? $errorMessages : null,
            'errorCode' => $errorCode,
        ];

        return response()->json($response, $code);
    }
}
