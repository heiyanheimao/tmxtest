<?php
/**
 * Date     2019-06-17
 * Time     11:41
 * Author   CD-JAY
 * Detail   排序 执行顺序 alpha|sort|by limit get store 写的时候不分顺序但是需要注意get顺序
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
//var_dump($redis->sort('list'));//对数字值进行排序 升序排 非数字值返回false
//var_dump($redis->sort('list', ['alpha' => true]));//按照字符串进行排序
//var_dump($redis->sort('list', ['alpha' => true, 'sort' => 'desc']));//sort按照字符串进行排序 降序排序 asc升序排序

//例如 a-id 3 b-id 1 c-id 2
//list c b a 排序
//结果为 b c a
//var_dump($redis->sort('words', ['by' => '*-id']));//by 找到所有满足by规则的键 对其值进行排序 然后替换自身排序

//var_dump($redis->sort('list', ['limit' => [0,3]]));//获取前几个值 跟mysql的limit一致

//例如 a-id 3 b-id 1 a-id 2
//list c b a
//结果为 2 1 3
//var_dump($redis->sort('list', ['get' => '*-id', 'alpha' => 1, 'sort' => 'desc']));//get 可以是字符串可以是数组 根据排序结果 去匹配get里面的键 返回get里面键对应的值
var_dump($redis->sort('list', ['alpha' => true, 'store' => 'new']));//store 将排序结果保存到新的列表当中