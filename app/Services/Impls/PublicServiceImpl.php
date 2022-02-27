<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/22
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 公共业务接口实现类
 *
 */


namespace App\Services\Impls;


use App\Services\PublicService;
use App\Utils\ServiceUtil;

class PublicServiceImpl extends ServiceUtil implements PublicService
{
    //测试
    public function test()
    {
        return $this->responseUtil->success();
    }
}
