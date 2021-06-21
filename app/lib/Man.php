<?php


namespace app\lib;


class Man extends Person
{
    public $sex;

    public function __construct($name, $birthday = null)
    {
        parent::__construct($name, $birthday);
        $this->sex = '男';
    }

    /**
     * 获取性别
     * @return string
     */
    public function getSex()
    {
        return $this->sex;
    }
}