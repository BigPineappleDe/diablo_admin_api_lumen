<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/27
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 用户业务信息
 *
 */


namespace App\Messages;


class UserMessage
{
    //登录要用到的
    public const DO_LOGIN = [
        'request' => [
            'account' => 'required|string',
            'password' => 'required|string',
        ],
        //中文
        'zh-cn' => [
            'message' => [
                'required' => ':attribute 不能为空！',
                'string' => ':attribute 类型必须为string',
            ],
            'attribute' => [
                'account' => '账号',
                'password' => '密码',
            ],
            "accountIsNull" => "账号不存在！！！",
            "accountStateErr" => "账号已被禁用！！！",
        ],
    ];
}
