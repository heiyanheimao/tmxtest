<?php

class Test
{
	public static $a =111;
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
class cTest extends Test{

}
$test = new Test();
$test->getSelf();
$test->getStatic();
$ctest = new cTest();
$ctest->getSelf();
$ctest->getStatic();
$str = 'http://www.w3school.com.cn/php/func_string_crc32.asp';
var_dump(crc32($str));
var_dump(sprintf('%u', crc32($str)));
var_dump(hexdec(hash('md5', $str)));
var_dump(dechex(crc32($str)));