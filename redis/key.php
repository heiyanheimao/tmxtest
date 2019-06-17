<?php
/**
 * Date     2019-06-17
 * Time     15:32
 * Author   CD-JAY
 * Detail   key操作
 */
$redis = new Redis();
$redis->connect('127.0.0.1',6379);
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
var_dump($redis->bgrewriteaof());