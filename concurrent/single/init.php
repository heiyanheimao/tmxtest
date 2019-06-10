<?php
/**
 * Date     2019-06-10
 * Time     23:54
 * Author   CD-JAY
 * Detail   初始化数据
 */

$cnf = require_once 'cnf.php';
require_once 'single.php';

$single = new Single($cnf['single']['perTime'], $cnf['redis']);
$id = 10;
$data = [
    'name' => 'zhangsan',
    'age' => 23
];
var_dump($single->checkToken($id, $data));