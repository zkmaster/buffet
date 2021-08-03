<?php

namespace app\controller;

class TestController extends Controller
{
    public function test(array $name)
    {
        dd(__METHOD__);
    }

    public function test1()
    {
        // TODO
    }

    public function test2()
    {
        echo __METHOD__ . PHP_EOL;
    }

    public function test3()
    {
        echo __METHOD__ . PHP_EOL;
    }
}