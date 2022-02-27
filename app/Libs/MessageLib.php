<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/27
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 响应信息库
 *
 */


namespace App\Libs;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageLib
{
    public function __construct(
        public Request $request,
    )
    {
    }

    //表单验证器
    public function search($data)
    {
        $language = self::getRequestLanguage();
        if ($language == 'null') $language = 'zh-cn';
        self::makeErrorMsg($this->request->all(), $data['request'], $data[$language]['message'], $data[$language]['attribute']);
    }

    //错误捕获
    private static function makeErrorMsg($data, $rules, $messages, $attribute)
    {
        $validator = Validator::make($data, $rules, $messages, $attribute);
        if ($validator->fails()) {
            $result = [];
            foreach (json_decode(json_encode($validator->errors()), true) as $k => $v) {
                $result[] = $v[0];
            }
            throw new \Exception(implode('|', $result));
        }
    }

    //根据Key获取响应信息
    public function getMessage($data, $key)
    {
        return $data[self::getRequestLanguage()][$key];
    }

    //获取请求语言
    private function getRequestLanguage()
    {
        return $this->request->header('Language') ?: 'zh-cn';
    }
}
