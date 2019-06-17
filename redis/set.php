<?php
/**
 * Date     2019-06-17
 * Time     15:37
 * Author   CD-JAY
 * Detail   set操作
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
//=================set操作==============================
/*说明：sAdd(key,member1,member2)
将一个或多个member元素加入到集合key当中，已经存在于集合的member元素将被忽略。
时间复杂度:O(N)
返回结果:
被添加到集合中的新元素的数量，不包括被忽略的元素。
*/
var_dump($redis->sAdd('set',1,2,3));
/*说明：sCard(key)
返回集合key的基数(集合中元素的数量)。
时间复杂度:O(1)
返回结果:
集合的基数。 当key不存在时，返回0。
*/
var_dump($redis->sCard('set'));
/*说明：sIsMember(key,member)
判断member元素是否是集合key的成员。
时间复杂度:O(1)
返回结果:
如果member元素是集合的成员，返回1。
如果member元素不是集合的成员，或key不存在，返回0。
*/
var_dump($redis->sIsMember('set',4));
/*说明：sMembers(key)
返回集合key中的所有成员。
时间复杂度:O(N)
返回结果:
集合中的所有成员。
*/
var_dump($redis->sMembers('set'));
/*说明：sRandMember(key,[count])
返回集合中的一个随机元素。
该操作和SPOP相似，但SPOP将随机元素从集合中移除并返回，而SRANDMEMBER则仅仅返回随机元素，而不对集合进行任何改动。
时间复杂度:O(N)
返回结果:
被选中的随机元素。 当key不存在或key是空集时，返回nil。
*/
var_dump($redis->sRandMember('set', 2));
/*说明：sPop(key)
移除并返回集合中的一个随机元素。
时间复杂度:O(1)
返回结果:
被移除的随机元素。
当key不存在或key是空集时，返回nil。
*/
var_dump($redis->sPop('set'));
/*说明：sRem(key,member1...)
移除集合key中的一个或多个member元素，不存在的member元素会被忽略。
当key不是集合类型，返回一个错误。
时间复杂度:O(n)
返回结果:
被成功移除的元素的数量，不包括被忽略的元素。
*/
var_dump($redis->sRem('set',1));