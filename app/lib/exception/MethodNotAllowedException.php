<?php


namespace app\lib\exception;


use Throwable;

class MethodNotAllowedException extends \Exception
{
    public function __construct($message = "请求方法错误！", $code = 405, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}