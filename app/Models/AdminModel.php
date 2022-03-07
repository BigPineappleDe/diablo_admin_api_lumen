<?php
declare(strict_types=1);
/**
 *
 *  User: Diablo
 *  Date: 2022/2/27
 *  User: 544730126@qq.com
 *  Blog: https://blog.fenglide.com.cn/
 *  Project: laravel-api
 *  Action: 管理库模型
 *
 */


namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class AdminModel extends Model
{
    protected $connection = 'admin';
    //自动维护时间
    public $timestamps = true;
    //维护的时间字段
    const UPDATED_AT = "updateTime";//更新
    //模型数据的保存格式
    protected $dateFormat = 'U';

    //==== 事物处理 ====

    //开启一个事物
    protected function beginTransaction()
    {
        DB::connection($this->connection)->beginTransaction();
    }

    //回滚一个事物
    protected function rollBack()
    {
        DB::connection($this->connection)->rollBack();
    }

    //提交一个事物
    protected function commit()
    {
        DB::connection($this->connection)->commit();
    }

    //==== 事物处理结束 ====

    //==== 数据表 ====

    public const TB_USER = "tb_user"; //用户表
    public const TB_USER_GROUP = "tb_user_group"; //用户权限组表

    //==== 数据表结束 ====
}
