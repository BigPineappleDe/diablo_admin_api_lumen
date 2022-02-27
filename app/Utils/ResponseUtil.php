<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/26
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 响应工具类
 *
 */


namespace App\Utils;


use JetBrains\PhpStorm\ArrayShape;

class ResponseUtil
{
    public function __construct(
        //成功响应码
        public int $successCode = 200,
        //失败响应码
        public int $errorCode = 300,
        //授权异常响应码
        public int $authErrCode = 301
    )
    {
    }

    //正常成功响应输出
    #[ArrayShape(['code' => "int", 'data' => "array", 'msg' => "string", 'isEcho' => "bool"])]
    public function success(array $data = [], string $message = "success", int $code = 200, bool $isEcho = false): bool|\Illuminate\Http\JsonResponse|string
    {
        $obj = self::formatData($data, $code, $message);
        if (!$isEcho) return response()->json($obj);
        return json_encode($obj);
    }

    //异常输出
    #[ArrayShape(['code' => "int", 'msg' => "string", 'data' => "array"])]
    public function error(string $message = "error", array $data = [], int $code = 300)
    {
        return response()->json(self::formatData($data, $code, $message));
    }

    //统一格式
    #[ArrayShape(['code' => "int", 'data' => "array", 'msg' => "string"])]
    private function formatData(array $data, int $code, string $msg): array
    {
        return [
            'code' => $code,
            'msg' => $msg,
            'data' => $data
        ];
    }
}
