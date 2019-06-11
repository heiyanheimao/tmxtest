<?php
/**
 * Created by PhpStorm.
 * User: TMX
 * Date: 2019/6/10
 * Time: 14:40
 * Detail: 初始化令牌桶
 */

require_once 'TokenBucket.php';
$cnf = require_once 'cnf.php';
//初始化令牌桶
$bucket = new TokenBucket($cnf['bucket']['bucketName'], $cnf['bucket']['bucketMax'], $cnf['bucket']['perNum'], $cnf['redis']);
$bucket->init();