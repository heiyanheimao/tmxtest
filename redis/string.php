<?php
/**
 * Date     2019-06-17
 * Time     15:31
 * Author   CD-JAY
 * Detail
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
//=================string操作============================
/*说明：set(key,value,[timeout])设置字符串
时间复杂度:O(1)
返回结果:总是返回(TRUE)，因为SET不可能失败
*/
var_dump($redis->set('string',123));
/*说明：get(key)获取key对应的字符串值
时间复杂度:O(1)
返回结果:返回对应的值 失败返回false
*/
var_dump($redis->get('string'));
/*说明：append(key,str)将str追加到key对应的值最后
时间复杂度:平摊复杂度O(1)
返回结果:追加str之后，key中字符串的长度
*/
var_dump($redis->append('string', "good"));
/*说明：incrByFloat(key,float)将key对应的值加上float值
时间复杂度:O(1)
返回结果:成功返回加完以后值 失败返回false
*/
$redis->set('num1',"2");
var_dump($redis->incrByFloat('num1',2.5));
/*说明：incrBy(key,int)将key对应的值加上int值
时间复杂度:O(1)
返回结果:成功返回加完以后值 失败返回false(key只能是整数)
*/
$redis->set('num2',"2");
var_dump($redis->incrBy('num2',2));
/*说明：decrBy(key,int)将key对应的值加上int值
时间复杂度:O(1)
返回结果:成功返回加完以后值 失败返回false(key只能是整数)
*/
var_dump($redis->decrBy('num2',2));
/*说明：strlen(key)获取key对应值的长度
时间复杂度:O(1)
返回结果:成功值长度 当 key不存在时，返回0 其他类型返回false
*/
var_dump($redis->strlen('list'));
/*说明：setRange(key,offset,value)用value参数覆写给定key所储存的字符串值，从偏移量offset开始。不存在的key当作空白字符串处理
时间复杂度:对小(small)的字符串，平摊复杂度O(1)  否则为O(M)，M为value参数的长度。
返回结果:修改之后，字符串的长度  失败返回false
*/
var_dump($redis->setRange('string',0,'abcdefghij'));
/*说明：getRange(key,start,end)返回key中字符串值的子字符串，字符串的截取范围由start和end两个偏移量决定(包括start和end在内)
负数偏移量表示从字符串最后开始计数，-1表示最后一个字符，-2表示倒数第二个，以此类推
时间复杂度:O(N)，N为要返回的字符串的长度。
复杂度最终由返回值长度决定，但因为从已有字符串中建立子字符串的操作非常廉价(cheap)，所以对于长度不大的字符串，该操作的复杂度也可看作O(1)
返回结果:截取得出的子字符串
*/
var_dump($redis->getRange('string', 0,1));
