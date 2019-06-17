<?php
/**
 * Date     2019-06-17
 * Time     15:37
 * Author   CD-JAY
 * Detail   zset操作
 */
$redis = new Redis();
$redis->connect('127.0.0.1', 6379, 3);
//=================zset操作============================
//score从表头到表尾从小到大排序
/*说明：zAdd($key, $options, $score1, $value1, $score2 = null, $value2 = null, $scoreN = null, $valueN = null )
将具有指定分数的所有指定成员添加到存储在的有序集中key。可以指定多个分数/成员对。如果指定的成员已经是已排序集的成员，则更新分数并将元素重新插入正确的位置以确保正确的排序。
如果key不存在，则创建具有指定成员作为唯一成员的新排序集，就像已排序集是空的一样。如果密钥存在但未保存有序集，则返回错误
options
    XX：仅更新已存在的元素。永远不要添加元素
    NX：不要更新现有元素。始终添加新元素。
    CH：将返回值从添加的新元素数修改为更改的元素总数（CH是已更改的缩写）。更改的元素是添加的新元素和已更新分数的已存在元素。因此，命令行中指定的元素具有与过去相同的分数，不计算在内。注意：通常ZADD的返回值仅计算添加的新元素的数量。
    INCR：指定此选项时，ZADD的作用类似于ZINCRBY。在此模式下只能指定一个得分元素对。
时间复杂度:O（log（N））
返回结果:
这次添加成功的元素个数 不包括那些被更新的、已经存在的成员
*/
var_dump($redis->zAdd('zset', ['NX'], 1244, 'lala2323'));
/*说明：zCard|zSize($key )
返回有序集key的基数
时间复杂度:O（1）
返回结果:
当key存在且是有序集类型时，返回有序集的基数。
当key不存在时，返回0。
其它类型返回false
*/
var_dump($redis->zCard('zset'));
/*说明：zCount($key, $start, $end)
返回有序集key中，score值在min和max之间(默认包括score值等于min或max)的成员。
前面添加(表示开区间
时间复杂度:O(log(N)+M)，N为有序集的基数，M为值在min和max之间的元素的数量。
返回结果:
score值在min和max之间的成员的数量。
*/
var_dump($redis->zCount('zset', '(1', '(3'));
/*说明：zRange( $key, $start, $end, $withscores = null )
返回有序集 key 中，指定区间内的成员。
其中成员的位置按 score 值递增(从小到大)来排序。
具有相同 score 值的成员按字典序(lexicographical order )来排列。
时间复杂度:O(log(N)+M)，N为有序集的基数，M为值在min和max之间的元素的数量。
返回结果:
指定区间内，带有 score 值(可选)的有序集成员的列表

zRevRange score从大到小排序
*/
var_dump($redis->zRange('zset', 0, -1 , true));
/*说明：zRank( $key, $member )
返回有序集 key 中成员 member 的排名。其中有序集成员按 score 值递增(从小到大)顺序排列。
排名以 0 为底，也就是说， score 值最小的成员排名为 0 。
时间复杂度:O(log(N))
返回结果:
如果 member 是有序集 key 的成员，返回 member 的排名。
如果 member 不是有序集 key 的成员，返回 false 。

zRevRank score从大到小排序
*/
var_dump($redis->zRank('zset', 'lala1'));
/*说明：zRem( $key, $member1, $member2 = null, $memberN = null)
移除有序集 key 中的一个或多个成员，不存在的成员将被忽略。
当 key 存在但不是有序集类型时，返回一个错误。
时间复杂度:O(M*log(N))， N 为有序集的基数， M 为被成功移除的成员的数量
返回结果:
被成功移除的成员的数量，不包括被忽略的成员。
*/
var_dump($redis->zRem('zset', 'lala1'));
/*说明：zScore( $key, $member )
返回有序集 key 中，成员 member 的 score 值。
如果 member 元素不是有序集 key 的成员，或 key 不存在，返回 nil 。
时间复杂度:O(1)
返回结果:
member 成员的 score 值，以字符串形式表示。
*/
var_dump($redis->zScore('zset', 'lala'));