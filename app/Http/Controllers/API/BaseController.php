<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BaseController extends Controller
{
    /**
     * succcess response method.
     * @return JsonResponse
     */
    public function sendResponse($result, $message = '')
    {
        if (isset($result['items'])) {
            $response = [
                'success' => true,
                'message' => $message
            ];
            $response = array_merge($result, $response);
        } else {
            $response = [
                'success' => true,
                'items' => $result,
                'message' => $message
            ];
        }

        return response()->json($response, 200);
    }

    /**
     * return error response.
     * @return JsonResponse
     */
    public function sendError($error, $errorMessages = [], $error_code, $code = 404)
    {
        $response = [
            'success' => false,
            'message' => $error,
            'error_code' => $error_code,
        ];

        if (!empty($errorMessages)) {
            $response['items'] = $errorMessages;
        }

        return response()->json($response, $code);
    }
}
