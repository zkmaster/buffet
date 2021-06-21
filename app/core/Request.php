<?php


namespace app\core;


class Request
{
    protected $header = null;
    protected $request_method = null;
    protected $path_info = null;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->setHeader();
        $this->setRequestMethod();
        $this->setPathInfo();
    }

    protected function setHeader()
    {
        $res = [];
        foreach ($_SERVER as $name => $value) {
            if (strncmp($name, 'HTTP_', 5) === 0) {
                $name = str_replace(' ', '-', ucwords(strtolower(str_replace('_', ' ', substr($name, 5)))));
                $res[$name] =$value;
            }
        }
        $this->header = $res;
    }

    protected function setRequestMethod()
    {
        $this->request_method = $_SERVER['REQUEST_METHOD']; //请求方式
    }

    protected function setPathInfo()
    {
        $this->path_info = $_SERVER['PATH_INFO']; // 路径
    }

    public function getHeader()
    {
        return $this->header;
    }

    public function getRequestMethod()
    {
        return $this->request_method;
    }

    public function getPathInfo()
    {
        return $this->path_info;
    }
}