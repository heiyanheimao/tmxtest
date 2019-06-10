<?php

/**
 * Date     2019-06-10
 * Time     19:53
 * Author   CD-JAY
 * Detail   解决单用户并发 同一个用户相同数据
 */

class single
{
    private $redis;//redis对象
    private $perTime;//禁止再次提交数据时间

    /** 初始化redis
     * single constructor.
     * @param int $perTime 禁止提交时间
     * @param array $cnf redis配置
     */
    public function __construct($perTime, $cnf)
    {
        $this->perTime = $perTime;
        try {
            $this->redis = new Redis();
            $this->redis->connect($cnf['host'], $cnf['port'], $cnf['timeout']);
        } catch (Exception $e) {
            echo '系统繁忙，清稍后再试~';
            exit;
        }
    }

    /**检测token
     * @param int $id 用户id
     * @param array $data 提交的数据
     */
    public function checkToken($id, $data)
    {
        //将id和data进行哈希
        $key = sha1($id . json_encode($data));
        try {
            $ret = $this->redis->set($key, 1, ['NX', 'EX' => $this->perTime]);
            if ($ret === false) {
                echo '数据已提交请不要再次请求';
                exit;
            }
            return true;
        } catch (Exception $e) {
            echo '系统繁忙，清稍后再试~';
            exit;
        }
    }
}