<?php
/**
 * Created by PhpStorm.
 * User: TMX
 * Date: 2019/6/10
 * Time: 16:42
 * Detail: 系统配置文件
 */
return [
    'redis' => [
        'host' => '127.0.0.1',//连接ip
        'port' => 6379,//连接端口
        'timeout' => 3,//连接超时时间
    ],
    'bucket' => [
        'bucketName' => 'bucket',//令牌桶名称
        'bucketMax' => 1000,//令牌桶最大容量
        'perNum' => 500,//每秒注入令牌数量
    ]
];