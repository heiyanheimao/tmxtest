<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2019/5/21
 * Time: 0:10
 */

$redis = new Redis();
$redis->connect('127.0.0.1');

//=================系统操作==============================
/*说明:type获取类型
时间复杂度:O(1)
返回结果：none(key不存在)0|string(字符串)1|list(列表)3|set(集合)2|zset(有序集)4|hash(哈希表)5
*/
var_dump($redis->type('hash'));
/*说明：object('encoding',name)获取值的内部编码
encoding 获取内部编码方式
refcount 获取对象引用计数
idletime 获取对象空转时长
时间复杂度:O(1)
返回结果:
string  int raw embstr
list ziplist linkedlist
hash ziplist hashtable
set intset hashtable
zset ziplist skiplist
*/
var_dump($redis->object('encoding','string'));
/*说明：eval(script,arg,numkeys)使用 Lua 解释器执行脚本
时间复杂度:O(1)
返回结果:执行结果
*/
$script = "return {1,2,3,redis.call('get',KEYS[1]),redis.call('get',KEYS[2])}";
$script = "return redis.call('set',KEYS[1],ARGV[1])";
$arg = ['string','cba','sss'];
$numkeys = 1;
var_dump($redis->eval($script, $arg, $numkeys));
/*说明：select(index)
切换到指定的数据库，数据库索引号用数字值指定，以 0 作为起始索引值。
新的链接总是使用 0 号数据库。
时间复杂度:O(1)
返回结果:切换成功true
*/
var_dump($redis->select(0));
/*说明：del( $key1, ...$otherKeys)
移除给定的一个或多个key。
如果key不存在，则忽略该命令。
时间复杂度:O(N)，N为要移除的key的数量。
移除单个字符串类型的key，时间复杂度为O(1)。
移除单个列表、集合、有序集合或哈希表类型的key，时间复杂度为O(M)，M为以上数据结构内的元素数量。
返回结果:被移除key的数量。
*/
var_dump($redis->del('a'));
/*说明：expire( $key, $ttl )
为给定key设置生存时间。
当key过期时，它会被自动删除。
时间复杂度:O(1)
返回结果:设置成功返回true。
当key不存在或者不能为key设置生存时间时(比如在低于2.1.3中你尝试更新key的生存时间)，返回false。
pexpire 设置微妙级别
expireat 设置到时间戳过期 单位秒
pexpireat 设置到时间戳过期 单位毫秒
*/
var_dump($redis->expire('b', 100));
/*说明：time(void)
获取时间戳以及毫秒数
时间复杂度:O(1)
返回结果:设置成功返回数组array(2) {
  [0]=>
  string(10) "1560330401"
  [1]=>
  string(6) "983685"
}
*/
var_dump($redis->time());
/*说明：ttl(key)
返回给定key的剩余生存时间(time to live)(以秒为单位)。
时间复杂度:O(1)
返回结果:key的剩余生存时间(以秒为单位)。
当key不存在，返回-2 。
当key没有设置生存时间时，返回-1 。
pttl 返回毫秒
*/
var_dump($redis->pttl('c'));
/*说明：persist(key)
移除给定key的生存时间。
时间复杂度:O(1)
返回结果:当生存时间移除成功时，返回true.
如果key不存在或key没有设置生存时间，返回0。
当key不存在，返回false 。
当key没有设置生存时间时，返回false 。
*/
var_dump($redis->persist('c'));
/*说明：save()
同步保存当前数据库的数据到磁盘。rdb阻塞保存
时间复杂度：
O(N)， N 为要保存到数据库中的 key 的数量。
返回值：
总是返回 true
*/
var_dump($redis->save());
/*说明：bgsave()
在后台异步保存当前数据库的数据到磁盘。

BGSAVE 命令执行之后立即返回 OK ，然后 Redis fork出一个新子进程，原来的 Redis 进程(父进程)继续处理客户端请求，而子进程则负责将数据保存到磁盘，然后退出。

客户端可以通过 LASTSAVE 命令查看相关信息，判断 BGSAVE 命令是否执行成功。

时间复杂度：

O(N)， N 为要保存到数据库中的 key 的数量。

返回值：

总是返回true
*/
var_dump($redis->bgsave());
/*说明：bgrewriteaof()
异步(Asynchronously)重写 AOF 文件以反应当前数据库的状态。

即使 BGREWRITEAOF 命令执行失败，旧 AOF 文件中的数据也不会因此丢失或改变。

时间复杂度：

O(N)， N 为要追加到 AOF 文件中的数据数量。

返回值：

总是返回true
*/
var_dump($redis->bgrewriteaof());exit;
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