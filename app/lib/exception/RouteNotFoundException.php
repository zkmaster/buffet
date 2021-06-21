<?php

namespace app\lib\exception;

use Throwable;

class RouteNotFoundException extends \Exception
{
    public function __construct($message = "路由不存在！", $code = 404, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}