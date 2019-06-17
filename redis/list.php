<?php
/**
 * Date     2019-06-17
 * Time     15:36
 * Author   CD-JAY
 * Detail   list操作
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
//=================list操作==============================
/*说明：lPush(key,value1,value2)将一个或多个值value插入到列表key的表头。
时间复杂度:O(1)
返回结果:返回列表的长度 类型不对返回false
*/
var_dump($redis->lPush('list',1,2,3));
/*说明：rPush(key,value1,value2)将一个或多个值value插入到列表key的表尾。
时间复杂度:O(1)
返回结果:返回列表的长度 类型不对返回false
*/
var_dump($redis->rPush('list', 1, 2, 3));
/*说明：lPop(key)移除并返回列表key的头元素
时间复杂度:O(1)
返回结果:移除的值 类型不对或者没有数据返回false
*/
var_dump($redis->lPop('list'));
/*说明：rPop(key)移除并返回列表key的尾元素
时间复杂度:O(1)
返回结果:移除的值 类型不对或者没有数据返回false
*/
var_dump($redis->rPop('list'));
/*说明：lIndex(key,index)返回列表key中，下标为index的元素。从0开始 -1最后
时间复杂度:O(N)，N为到达下标index过程中经过的元素数量。因此，对列表的头元素和尾元素执行LINDEX命令，复杂度为O(1)。
返回结果:列表中下标为index的元素。 失败为false
*/
var_dump($redis->lIndex('list', 100));
/*说明：lSet(key,index,value)将列表key下标为index的元素的值甚至为value。
下标(index)参数start和stop都以0为底
时间复杂度:对头元素或尾元素进行LSET操作，复杂度为O(1)。其他情况下，为O(N)，N为列表的长度。
返回结果:
如果命令执行成功 true;
*/
var_dump($redis->lSet('list',0,'aaaa'));
/*说明：lLen(key)返回列表key的长度
时间复杂度:O(1)
返回结果:列表key的长度。
*/
var_dump($redis->lLen('list'));
/*说明：lInsert(key,position,pivot,value)在列表的元素前或者后插入元素。当指定元素不存在于列表中时，不执行任何操作。
当列表不存在时，被视为空列表，不执行任何操作。
如果 key 不是列表类型，返回一个错误。
REDIS::AFTER REDIS::BEFORE
时间复杂度:O(N)
返回结果:
如果命令执行成功，返回插入操作完成之后，列表的长度。
如果没有找到pivot，返回-1。
如果key不存在或为空列表，返回0。
*/
var_dump($redis->lInsert('x', REDIS::AFTER, 'abab','x'));
/*说明：lRem(key,value,count)根据参数count的值，移除列表中与参数value相等的元素
count > 0: 从表头开始向表尾搜索，移除与value相等的元素，数量为count。
count < 0: 从表尾开始向表头搜索，移除与value相等的元素，数量为count的绝对值。
count = 0: 移除表中所有与value相等的值。
时间复杂度:O(N)
返回结果:
如果命令执行成功，返回插入操作完成之后，列表的长度。
如果没有找到pivot，返回-1。
如果key不存在或为空列表，返回0。
*/
var_dump($redis->lRem('list', 'abab',1));
/*说明：lTrim(key,start,stop)对一个列表进行修剪(trim)，就是说，让列表只保留指定区间内的元素，不在指定区间之内的元素都将被删除。
下标(index)参数start和stop都以0为底
时间复杂度:O(N)
返回结果:
如果命令执行成功 true;
*/
var_dump($redis->lTrim('list',0,1));
