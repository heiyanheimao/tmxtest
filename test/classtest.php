<?php

class Test
{
    public static $a = 111;

    public function __construct()
    {
    }

    public function getSelf()
    {
        var_dump(Test::$a);
        // var_dump(new self());
    }


    public function getStatic()
    {
        // var_dump(new static());
    }
}

class cTest extends Test
{
    /**
     * cTest constructor.
     * @
     */
    public function __construct()
    {
        parent::__construct();
    }


    public function getSelf()
    {
       $this->getStatic();
    }


}

$test = new Test();
$test->getSelf();
$test->getStatic();
$cTest = new cTest();
$cTest->getSelf();
$cTest->getStatic();
$str = 'http://www.w3school.com.cn/php/func_string_crc32.asp';
var_dump(crc32($str));
var_dump(sprintf('%u', crc32($str)));
var_dump(hexdec(hash('md5', $str)));
var_dump(dechex(crc32($str)));