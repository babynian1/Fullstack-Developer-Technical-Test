<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    public function sendResponse($result, $message, $code = 200)
    {
        $response = [
            'data'    => $result,
            'message' => $message,
        ];

        if($code == 200)
        {
            $response['success'] = true;
        } else {
            $response['success'] = false;
        }
       

        return response()->json($response, $code);
    }
}
