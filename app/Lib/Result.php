<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/2/2
 * Time: 9:26
 */

namespace App\Lib;


class Result
{
    public $code;//返回码（-1: 系统异常 ;0:失败 ;1: 成功）
    public $message; //描述信息
    public static $SUCCESS = 1;
    public static $FAIL = 0;
    public static $ERRORS = -1;

    public function __construct($code, $msg="")
    {
        if(!is_numeric($code)){
            $this->code = $code ? 1 : 0;
        }else{
            $this->code = $code;
        }

        $this->message = $msg;
    }
}