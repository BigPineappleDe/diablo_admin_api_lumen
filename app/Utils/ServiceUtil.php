<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/22
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 业务工具类
 *
 */


namespace App\Utils;


use App\Libs\MessageLib;
use App\Libs\WeComLib;
use Illuminate\Http\Request;

class ServiceUtil
{
    public function __construct(
        //工具类
        public BaseUtil $baseUtil,
        //请求体
        public Request $request,
        //响应工具类
        public ResponseUtil $responseUtil,
        //信息工具库
        public MessageLib $messageLib,
        //企业微信工具库
        public WeComLib $weComLib
    )
    {
    }
}
