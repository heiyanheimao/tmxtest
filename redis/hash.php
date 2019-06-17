<?php
/**
 * Date     2019-06-17
 * Time     15:35
 * Author   CD-JAY
 * Detail   哈希操作
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
//=================hash操作==============================
/*说明：hSet(key,hashKey,value)将哈希表key中的域hashKey的值设为value。
如果key不存在，一个新的哈希表被创建并进行hSet操作。
如果域hashKey已经存在于哈希表中，旧值将被覆盖。
时间复杂度:O(1)
返回结果:
如果hashKey是哈希表中的一个新建域，并且值设置成功，返回1。
如果哈希表中域hashKey已经存在且旧值已被新值覆盖，返回0
*/
var_dump($redis->hSet('hash', 'name', 'zhangsa'));
/*说明：hGet(key,hashKey)返回哈希表key中给定域hashKey的值。
时间复杂度:O(1)
返回结果:
成功返回值 不存在返回false
*/
var_dump($redis->hGet('hash', 'name'));
/*说明：hExists(key,hashKey)判断哈希表key中给定域hashKey是否存在。
时间复杂度:O(1)
返回结果:
存在true 不存在false
*/
var_dump($redis->hExists('hash', 'xxx'));
/*说明：hDel(key,hashKey1,hashKey2....)删除哈希表key中给定域hashKey1..。
时间复杂度:O(N)
返回结果:
被成功移除的域的数量，不包括被忽略的域。
*/
//var_dump($redis->hDel('hash', 'name',0 ));
/*说明：hLen(key)返回哈希表key中域的数量。
时间复杂度:O(1)
返回结果:
哈希表中域的数量。
当key不存在时，返回0。
*/
var_dump($redis->hLen('hash'));
/*说明：hGetAll(key)返回哈希表key中，所有的域和值。
在返回值里，紧跟每个域名(field name)之后是域的值(value)，所以返回值的长度是哈希表大小的两倍。
时间复杂度:O(N)
返回结果:
以列表形式返回哈希表的域和域的值。 若key不存在，返回空列表。
*/
var_dump($redis->hGetAll('hash'));