<?php
/**
 * Created by PhpStorm.
 * User: xtn
 * Date: 2018/7/10
 * Time: 9:53
 */

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{

    /**
     * @param string $message
     * @param null $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendSuccess($message = "success", $data = null, $code = Response::HTTP_OK)
    {
        return response()->json([
            'code' => 1,
            'success' => true,
            'msg' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param string $message
     * @param null $data
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    public function sendError($message = "fail", $data = null, $code = Response::HTTP_BAD_REQUEST)
    {
        return response()->json([
            'code' => 0,
            'success' => false,
            'msg' => $message,
            'data' => $data
        ], $code);
    }
}