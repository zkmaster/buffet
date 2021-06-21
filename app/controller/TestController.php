<?php

namespace app\controller;

class TestController extends Controller
{
    public function test(array $name)
    {
        dd(__METHOD__);
    }
}