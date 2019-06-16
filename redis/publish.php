<?php
/**
 * Date     2019-06-16
 * Time     21:00
 * Author   CD-JAY
 * Detail   向频道发送消息
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
var_dump($redis->publish('channel1', 'name'));