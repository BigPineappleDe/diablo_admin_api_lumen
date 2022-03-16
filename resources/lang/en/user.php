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

return [
    //登录控制器
    'doLogin' => [
        'request' => [
            'account' => 'required|string',
            'password' => 'required|string',
        ],
        //中文
        'message' => [
            'required' => ':attribute not null!',
            'string' => ':attribute type must be string!',
        ],
        'attribute' => [
            'account' => 'Account',
            'password' => 'Password',
        ],
        "accountIsNull" => "Account does not exist!!!",
        "accountStateErr" => "Account has been disabled!!!",
    ]
];
