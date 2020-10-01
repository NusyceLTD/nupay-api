<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class BaseController extends Controller
{
    /**
     * succcess response method.
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendResponse($result, $message = '')
    {
        if (isset($result['data'])) {
            $response = [
                'success' => true,
                'message' => $message
            ];
            $response = array_merge($result, $response);
        } else {
            $response = [
                'success' => true,
                'data' => $result,
                'message' => $message
            ];
        }
        return response()->json($response, 200);
    }

    /**
     * return error response.
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($error, $errorMessages = [], $error_code, $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'error_code' => $error_code,
        ];

        if (!empty($errorMessages)) {
            $response['data'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
