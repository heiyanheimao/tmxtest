<?php
/**
 * Date     2019-06-17
 * Time     15:31
 * Author   CD-JAY
 * Detail   2进制操作
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);

//给对应偏移位置设置值 0|1 从最左开始表示偏移量
//1000 0000 \x80
//var_dump($redis->setBit('bit', 0, 1));//返回原先值
////1010 0000 \xA0
//var_dump($redis->setBit('bit', 2, 1));
////1010 0001 \xA1
//var_dump($redis->setBit('bit', 7, 1));
////1010 0001 1000 0000 \xA1\x80
//var_dump($redis->setBit('bit', 8, 1));
////\xA1\x80\x00\x00\x00\x00\x00\x00\x00\x00\x00\x00\x08
//var_dump($redis->setBit('bit', 100, 1));
////获取对应偏移位置的值 从最左开始表示偏移量
//var_dump($redis->getBit('bit', 100));
//var_dump($redis->bitCount('bit'));//统计给定key值当中位置为1的个数
//var_dump($redis->bitOp('not', 'bit1', 'bit'));
var_dump(base_convert('\x80', 16, 2));