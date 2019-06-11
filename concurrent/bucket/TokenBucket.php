<?php
/**
 * Created by PhpStorm.
 * User: TMX
 * Date: 2019/6/10
 * Time: 14:33
 * Detail: 利用redis实现令牌桶
 */

class TokenBucket
{
    private $bucketMax;//令牌桶存储数量
    private $bucketName;//令牌桶名称
    private $perNum;//每秒入桶数量
    private $redis;//redis对象

    /**连接redis
     * TokenBucket constructor.
     * @param string $bucketName 令牌桶名称
     * @param int $bucketMax 令牌桶最大容量
     * @param int $perNum 每秒注入令牌数
     * @param array $cnf redis配置
     */
    public function __construct($bucketName, $bucketMax, $perNum, $cnf)
    {
        $this->bucketName = $bucketName;
        $this->bucketMax = $bucketMax;
        $this->perNum = $perNum;
        try {
            $this->redis = new Redis();
            $this->redis->connect($cnf['host'], $cnf['port'], $cnf['timeout']);
        } catch (Exception $e) {
            echo '1系统繁忙，请稍后再试~';
            exit;
        }
        return true;
    }

    /**初始化桶大小
     * @return bool|int|string
     */
    public function init()
    {
        $total = array_fill(0, $this->bucketMax, 1);
        try {
            //删除令牌桶
            $this->redis->del($this->bucketName);
            //初始化令牌桶
            $ret = $this->redis->lPush($this->bucketName, ...$total);
        } catch (Exception $e) {
            echo '2系统繁忙，请稍后再试~';
            exit;
        }
        if ($ret === false) {
            echo '3系统繁忙，请稍后再试~';
            exit;
        }
        return $ret;
    }

    /**添加令牌
     * @return bool|int
     */
    public function addToken()
    {
        try {
            //获取当前令牌桶已存数量
            $nowNum = $this->redis->lLen($this->bucketName);
            if ($nowNum != $this->bucketMax) {
                $addTokenNum = $nowNum + $this->perNum > $this->bucketMax ? $this->bucketMax - $nowNum : $this->perNum ;
                $token = array_fill(0, $addTokenNum, 1);
                $ret = $this->redis->lPush($this->bucketName, ...$token);
                if ($ret === false) {
                    echo '5系统繁忙，请稍后再试~';
                    exit;
                }
                return $ret;
            }
            return 0;
        } catch (Exception $e) {
            echo '4系统繁忙，请稍后再试~';
            exit;
        }
    }

    /**获取令牌
     * @return bool
     */
    public function getToken()
    {
        try {
            return $this->redis->rPop($this->bucketName) ? 'ok' : 'error';
        } catch (Exception $e) {
            echo '5系统繁忙，请稍后再试~';
            exit;
        }
    }
}