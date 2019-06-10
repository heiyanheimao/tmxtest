<?php
/**
 * Date     2019-06-10
 * Time     23:46
 * Author   CD-JAY
 * Detail   配置文件
 */
return [
    'redis' => [
        'host' => '127.0.0.1',
        'port' => 6379,
        'timeout' => 3
    ],
    'single' => [
        'perTime' => 100,//3秒内禁止再次提交数据
    ]
];
