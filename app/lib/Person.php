<?php
namespace app\lib;

class Person
{
    public $name;
    public $birthday;

    public function __construct($name, $birthday = null)
    {
        $this->name = $name;
        $this->birthday = $birthday ?: date('Y-m-d');
    }
}