<?php

namespace App\Http\Controllers;
class BaseController extends Controller
{
    public  function successResponse($status , $data=[], $message, $code)
    {
        return response([
            'status' => $status,
            'data' => $data,
            'message' => $message
        ], $code);
    }

    public function errorResponse($status, $message, $code)
    {
        return response([
            'status' => $status,            
            'message' => $message
        ], $code);
    }
}
