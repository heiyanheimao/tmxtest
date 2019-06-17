<?php
/**
 * Date     2019-06-17
 * Time     17:29
 * Author   CD-JAY
 * Detail   redis 慢查询
 */
//操作
//config set slowlog-log-slower-than 100 表示记录执行超过100微妙的命令
//config set slowlog-max-len 100 表示设置最多保存100条慢日志
//slowlog get 获取慢日志
//1) 1) (integer) 1 //唯一标识 可以认为是索引
//   2) (integer) 1560739651//执行时间戳
//   3) (integer) 19344//执行时长 单位 微妙
//   4) 1) "BGSAVE"//执行命令 以及参数
//2) 1) (integer) 0
//   2) (integer) 1560739651
//   3) (integer) 35821
//   4) 1) "SAVE"

//slowlog len  获取当前慢日志条数
//slowlog reset  重置慢日志