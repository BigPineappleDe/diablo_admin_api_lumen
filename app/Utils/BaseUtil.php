<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/22
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 基础工具类
 *
 */


namespace App\Utils;


use App\Constants\SystemConstant;
use Illuminate\Http\Request;

class BaseUtil
{
    public function __construct(
        public Request $request
    )
    {}

    //获取语言
    public function getLanguage()
    {
        return $this->request->header(SystemConstant::LAN_HEADER_KEY);
    }
}
