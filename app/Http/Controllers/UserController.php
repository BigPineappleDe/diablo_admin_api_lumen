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


use App\Libs\MessageLib;
use App\Messages\UserMessage;
use App\Services\Impls\UserServiceImpl;

class UserController
{
    public function __construct(
        public MessageLib $messageLib,
        public UserServiceImpl $userService,
    )
    {}

    //登录
    public function doLogin()
    {
        $this->messageLib->search(UserMessage::DO_LOGIN);
        return $this->userService->doLogin();
    }
}
