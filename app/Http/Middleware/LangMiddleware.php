<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/22
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 语言配置中间件
 *
 */

namespace App\Http\Middleware;

use App\Constants\SystemConstant;
use Closure;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     * @throws \Exception
     */
    public function handle($request, Closure $next)
    {
        $lan = $request->header(SystemConstant::LAN_HEADER_KEY) ?: env('DEFAULT_LANGUAGE');
        //语言数组
        $lanArray = SystemConstant::LAN_LIST;
        if (!in_array($lan, $lanArray)) throw new \Exception('Language does not exist !!!');
        return $next($request);
    }
}
