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


use App\Messages\UserMessage;
use App\Models\AdminModel;
use App\Services\UserService;
use App\Utils\ServiceUtil;

class UserServiceImpl extends ServiceUtil implements UserService
{
    //登录
    public function doLogin()
    {
        $accessToken = $this->weComLib->getAccessToken();
        dump($accessToken);exit;
        $param = $this->request->all();
        $message = UserMessage::DO_LOGIN;
        //找到账号
        $user = AdminModel::from(AdminModel::TB_USER)->where('account', $param['account'])->first();
        //账户不存在
        if (!$user) return $this->responseUtil->error($this->messageLib->getMessage($message, "accountIsNull"));
        $user = $user->toArray();
        if ($user['state'] != 0) return $this->responseUtil->error($this->messageLib->getMessage($this->messageLib, "accountStateErr"));
        dump($user);
    }
}
