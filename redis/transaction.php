<?php
/**
 * Date     2019-06-16
 * Time     21:44
 * Author   CD-JAY
 * Detail   redis事务 将多个命令打包执行 需要注意redis没有事务回滚
 *          exec不执行:1.watch和exec时间之间当其他客户端对监视的键进行了污染
 * ·                  2.不存在的命令或者错误的命令格式
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
$redis->watch('key');
var_dump($redis->multi());//开启事务
//var_dump($redis->set('key','hello'));
var_dump($redis->set('key2','hello3'));
var_dump($redis->lPush('key', 'a'));
var_dump($redis->exec());