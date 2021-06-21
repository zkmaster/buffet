<?php

namespace app\core;

use app\lib\exception\RouteNotFoundException;

class Route
{
    public function __construct()
    {
    }

    protected function actionDir()
    {
        return __DIR__ . '\..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'actions';
    }

    protected function getVersionFile($version)
    {
        return 'v' . $version . '.php';
    }

    public function getRoute($version, $path_info)
    {
        $file_name = $this->actionDir() . DIRECTORY_SEPARATOR . $this->getVersionFile($version);
        if (file_exists($file_name)) {
            $route = require $file_name;
            $route = $route ?: [];
            $path_info = ltrim($path_info, '/');
            if (isset($route[$path_info])) {
                return $route[$path_info];
            }else {
                throw new RouteNotFoundException();
            }
        }else {
            trigger_error('版本路由文件不存在！', E_USER_ERROR);
        }

    }
}