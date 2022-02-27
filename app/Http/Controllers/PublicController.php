<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/22
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 公共控制器
 *
 */


namespace App\Http\Controllers;

use App\Libs\MessageLib;
use App\Services\Impls\PublicServiceImpl;

class PublicController
{

    public function __construct(
        public MessageLib $messageLib,
        public PublicServiceImpl $publicService,
    )
    {}

    //测试实例
    public function test(): \Illuminate\Http\JsonResponse|bool|string
    {
        return $this->publicService->test();
    }
}
