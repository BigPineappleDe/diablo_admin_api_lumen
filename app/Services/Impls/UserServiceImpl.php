<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/27
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 用户业务接口实现类
 *
 */


namespace App\Services\Impls;


use App\Services\UserService;
use App\Utils\ServiceUtil;

class UserServiceImpl extends ServiceUtil implements UserService
{
    //登录
    public function doLogin()
    {
        $param = $this->request->all();
        dump( $param );
    }
}
