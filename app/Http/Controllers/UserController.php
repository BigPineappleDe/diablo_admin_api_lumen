<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/27
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 用户控制器
 *
 */


namespace App\Http\Controllers;


use App\Constants\UserConstant;
use App\Libs\MessageLib;
use App\Services\Impls\UserServiceImpl;

class UserController
{
    public function __construct(
        public MessageLib $messageLib,
        public UserServiceImpl $userService,
    ){}

    private const FILE_NAME = UserConstant::USER_FILE_NAME;

    //登录
    public function doLogin()
    {
        $this->messageLib->search(self::FILE_NAME, __FUNCTION__);
        return $this->userService->doLogin();
    }
}
