<?php
/**
 * Date     2019-06-16
 * Time     22:24
 * Author   CD-JAY
 * Detail   redis执行lua脚本
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
/*说明：eval(script,arg,numkeys)使用 Lua 解释器执行脚本
时间复杂度:O(1)
返回结果:执行结果
*/
$script = "return {1,2,3,redis.call('get',KEYS[1]),redis.call('get',KEYS[2])}";
$script = "return redis.call('set',KEYS[1],ARGV[1])";
$arg = ['string','cba','sss'];
$numkeys = 1;
var_dump($redis->eval($script, $arg, $numkeys));
var_dump($redis->evalSha("99afcf0dbb126b67256884edb154d1c365569da8", [], 0));//执行哈希脚本
var_dump($redis->script('load', 'return 3*3'));//载入脚本，并返回哈希值
var_dump($redis->script("flush"));//重置lua 删除所有脚本
var_dump($redis->script('exists', '99afcf0dbb126b67256884edb154d1c365569da8'));//判断校验和是否存在 存在1 不存在0 以数组的形式呈现
var_dump($redis->script('kill'));//杀死所有运行的lua脚本
