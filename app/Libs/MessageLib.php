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


use App\Utils\BaseUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;

class MessageLib
{
    public function __construct(
        public Request $request,
        public BaseUtil $baseUtil,
    )
    {
    }

    //表单验证器
    public function search(...$str)
    {
        $data = self::getMessage(...$str);
        self::makeErrorMsg($this->request->all(), $data['request'], $data['message'], $data['attribute']);
    }

    //根据Key获取响应信息
    public function getMessage(...$str)
    {
        $data = $str;
        $loadData = Lang::get($data[0], [], self::getRequestLanguage());
        unset($data[0]);
        foreach ($data as $item) {
            $loadData = $loadData[$item];
        }
        return $loadData;
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

    private function getRequestLanguage()
    {
        return $this->baseUtil->getLanguage();
    }
}
