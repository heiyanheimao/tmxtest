<?php
/**
 * Date     2019-06-16
 * Time     22:24
 * Author   CD-JAY
 * Detail   redis执行lua脚本
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
//var_dump($redis->script('load', 'return 3*3'));
//var_dump($redis->eval("return 4*4",[], 0));
var_dump($redis->evalSha("a1303cbe71eee57700babea4dedc14bbbaa16d40", [], 0));
var_dump(sha1('return 4*4'));
