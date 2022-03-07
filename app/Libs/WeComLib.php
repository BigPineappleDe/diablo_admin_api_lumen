<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/3/7
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 企业微信工具库
 *
 */


namespace App\Libs;


use Illuminate\Support\Facades\Cache;

class WeComLib
{

    //企业ID
    private string $corpId;
    //应用ID
    private string $appAgentId;
    //应用私钥
    private string $appSecret;

    public function __construct(
        //基础地址
        private string $weComUrl = "https://qyapi.weixin.qq.com/cgi-bin",
        //access_token缓存Key
        private string $cacheAccessTokenKey = "DIABLO_ADMIN_WECOM_ACCESS_TOKEN",
    )
    {
        $this->corpId = env('WECOM_CORPID');
        $this->appAgentId = env('WECOM_APP_AGENTID');
        $this->appSecret = env('WECOM_APP_SECRET');
    }

    //获取access_token
    public function getAccessToken()
    {
        $data = Cache::get($this->cacheAccessTokenKey);
        $isHttp = false;
        if (empty($data)) $isHttp = true;
        if (!$isHttp) {
            $data = json_decode($data, true);
            if (empty($data['access_token'])) $isHttp = true;
            if ($data['expires_in_time'] <= time()) $isHttp = true;
            if (!$isHttp) return $data['access_token'];
        }
        $row = self::getUrl('/gettoken', ['corpid' => $this->corpId, 'corpsecret' => $this->appSecret]);
        $row['expires_in_time'] = time() + intval($row['expires_in']);
        Cache::forever($this->cacheAccessTokenKey, json_encode($row));
        return $row['access_token'];
    }

    //请求
    private function getUrl(string $router = "", array $param = [])
    {
        $url = $this->weComUrl . $router . "?" . http_build_query($param);
        $obj = json_decode(file_get_contents($url), true);
        if ($obj['errcode'] != 0) throw new \Exception($obj['errmsg']);
        return $obj;
    }
}
