<?php
/**
 * Created by PhpStorm.
 * User: TMX
 * Date: 2019/6/10
 * Time: 16:10
 * Detail:
 */

require_once 'TokenBucket.php';
$bucket = new TokenBucket($cnf['bucket']['bucketName'], $cnf['bucket']['bucketMax'], $cnf['bucket']['perNum'], $cnf['redis']);
//消耗令牌
file_put_contents('test.txt', $bucket->getToken().PHP_EOL, FILE_APPEND);
