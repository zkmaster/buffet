<?php

namespace app\core;


use app\lib\exception\MethodNotAllowedException;
use app\lib\exception\RouteNotFoundException;
use ReflectionClass;
use ReflectionMethod;

class App
{
    /**
     * @var $request Request
     */
    public $request;
    public $route;

    public function __construct()
    {
        $this->init();
    }

    public function init()
    {
        $this->registerExceptionHandle();
        $this->setRequest();
        $this->setRoute();
    }

    public function run()
    {
        $this->checkRoute();
        $this->doRequest();
    }

    protected function checkRoute()
    {
        if ($this->route) {
            if ($this->request->getRequestMethod() != $this->route['type']) {
                throw new MethodNotAllowedException();
            }
            if (class_exists($this->route['controller'])) {
                $class = new ReflectionClass($this->route['controller']);
                $has_method = $class->hasMethod($this->route['method']);
                if ($has_method === false) {
                    throw new RouteNotFoundException();
                }
                $method = $class->getMethod($this->route['method']);
                dd($method);
                if ($method->getModifiers() != ReflectionMethod::IS_PUBLIC) {
                    throw new RouteNotFoundException();
                }
            }
        }
    }

    protected function doRequest()
    {
        //before
        $class = new $this->route['controller']();
        $method = $this->route['method'];
        $class->$method();
        //after
    }

    protected function setRequest()
    {
        $this->request = new Request();
    }

    protected function setRoute()
    {
        $version = $this->getVersion();
        $route = (new Route())->getRoute($version, $this->request->getPathInfo());
        $this->route = $this->formatRoute($route);
    }

    protected function formatRoute($route)
    {
        if (is_array($route)) {
            $use = isset($route['use']) ? $route['use'] : '';
            if (!$use) {
                throw new RouteNotFoundException();
            }
            @list($controller, $method) = explode('@', $use);
            $route['controller'] = $controller;
            $route['method'] = $method;
            unset($route['use']);
            $route['type'] = isset($route['type']) ? strtoupper($route['type']) : 'GET';
            return $route;
        }elseif (is_string($route)) {
            @list($controller, $method) = explode('@', $route);
            return [
                'controller' => $controller,
                'method' => $method,
                'type' => 'GET',
            ];
        }elseif (is_object($route)) {
            return json_decode(json_encode($route), true);
        }
        return [];
    }

    protected function getVersion()
    {
        return intval($this->request->getHeader()['Version']);
    }

    /**
     * 注册异常处理
     */
    protected function registerExceptionHandle()
    {
        set_exception_handler([__CLASS__, 'handleException']);
    }

    /**
     * 异常处理
     * @param \Exception $e
     */
        public static function handleException(\Exception $e)
    {
        if (PHP_SAPI !== 'cli') {
            http_response_code($e->getCode());
        }
        # 是否打开debug
        $display = APP_DEBUG ? true : false;
        ini_set('display_errors', $display);
        echo $e->getMessage() . PHP_EOL;
//        echo 'File:' . $e->getFile() . PHP_EOL;
//        echo 'Line:' . $e->getLine() . PHP_EOL;
//        echo 'Trace:' . $e->getTraceAsString() . PHP_EOL;
    }
}