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


use App\Constants\UserConstant;
use App\Models\AdminModel;
use App\Services\UserService;
use App\Utils\ServiceUtil;

class UserServiceImpl extends ServiceUtil implements UserService
{
    //信息文件名
    private const FILE_NAME = UserConstant::USER_FILE_NAME;

    //登录
    public function doLogin()
    {
        $param = $this->request->all();
        $message = $this->messageLib->getMessage(self::FILE_NAME, __FUNCTION__);
        //找到账号
        $user = AdminModel::from(AdminModel::TB_USER)->where('account', $param['account'])->first();
        //账户不存在
        if (!$user) return $this->responseUtil->error($message["accountIsNull"]);
        $user = $user->toArray();
        if ($user['state'] != 0) return $this->responseUtil->error($message["accountStateErr"]);

    }
}
