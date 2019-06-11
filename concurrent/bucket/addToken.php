<?php
/**
 * Created by PhpStorm.
 * User: TMX
 * Date: 2019/6/10
 * Time: 16:03
 * Detail: 模拟每秒添加令牌 每天跑的脚本
 */

require_once 'TokenBucket.php';
$cnf = require_once 'cnf.php';
//初始化令牌桶
$bucket = new TokenBucket($cnf['bucket']['bucketName'], $cnf['bucket']['bucketMax'], $cnf['bucket']['perNum'], $cnf['redis']);
//模拟每秒添加令牌
for ($i = 0; $i < 86400; $i++) {
    $bucket->addToken();
    sleep(1);
}
