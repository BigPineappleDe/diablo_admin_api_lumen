<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/3/7
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: JWT库
 *
 */


namespace App\Libs;


class JwtLib
{


    public function __construct(
        private string $header,
        private string $payload,
        private string $signature,
    ){
        $this->header = self::getHeader();
    }


    //生成jwt
    public function getJwt($data, $user = null, $admin = null)
    {
        $this->payload = self::getPayload($data, $admin, $user);
        $this->signature = self::getSignature();
        return $this->header . "." . $this->payload . "." . $this->signature;
    }


    //获取JWT的负载数据
    public function getJwtData($jwt)
    {
        $is = self::checkJwt($jwt);
        if ($is) {
            $jwtArr = explode('.', $jwt);
            $payload = json_decode(base64_decode($jwtArr[1]), true);
            if (empty($payload['data'])) throw new \Exception('JWT invalid data!');
            return $payload['data'];
        }
    }

    //校验JWT
    private function checkJwt($jwt)
    {
        $jwtArr = explode('.', $jwt);
        if (count($jwtArr) != 3) throw new  \Exception("Illegal JWT !");
        if ($jwtArr[0] != $this->header) throw new \Exception("Invalid header !");
        $this->payload = $jwtArr[1];
        $payloadArr = json_decode(base64_decode($this->payload), true);
        //签发时间是不是当前时间之前的
        if (time() < intval($payloadArr['iat'])) throw new \Exception("iat error !");
        //看下时间是否过期了
        if (time() >= intval($payloadArr['exp'])) throw new \Exception("exp error !");
        $this->signature = self::getSignature();
        if ($jwtArr[2] != $this->signature) throw new \Exception("Invalid signature !");
        return true;
    }


    //header部分
    private static function getHeader()
    {
        $arr = [
            'alg' => 'HS256',
            'typ' => "JWT",
        ];
        return base64_encode(json_encode($arr));
    }

    //负载部分
    private function getPayload($data, $admin = null, $user = null)
    {
        $arr = [
            "iss" => $admin ?: 'admin',// JWT签发者
            "iat" => time(),// 签发时间
            "exp" => time() + intval(env('JWT_EXP_TIME')),// 过期时间
            "sub" => $user ?: 'user',// 面向的用户
            "data" => $data, // 负载
            "jti" => self::getJti($data), //Token唯一标识
        ];
        return base64_encode(json_encode($arr));
    }

    //signature部分
    private function getSignature()
    {
        return base64_encode(hash_hmac("sha256", $this->header . "." . $this->payload, env('JWT_KEY'), true));
    }

    //生成jti
    private function getJti($data)
    {
        return md5(sha1(json_encode($data)) . time());
    }
}
