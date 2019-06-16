<?php
/**
 * Date     2019-06-16
 * Time     20:59
 * Author   CD-JAY
 * Detail   订阅频道
 */
ini_set('default_socket_timeout', -1);//防止超时
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 0);
$redis->subscribe(['channel1'], function($r, $channel, $msg){
    echo $msg.PHP_EOL;

});
//查看当前redis被订阅频道
//var_dump($redis->pubsub('channels','*'));
////查看频道下订阅人数
//var_dump($redis->pubsub('numsub', ['a','b']));
////查询当前被订阅模式的数量
//var_dump($redis->pubsub('numpat',[]));