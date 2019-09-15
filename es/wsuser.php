<?php
/**
 * Date     2019-07-31
 * Time     23:19
 * Author   CD-JAY
 * Detail
 */
$server = new Swoole\WebSocket\Server("0.0.0.0", 9501);
$server->on('open', function (Swoole\WebSocket\Server $server, $request)  {

});

$server->on('message', function (Swoole\WebSocket\Server $server, $frame){
    go(function(){
        $redis = new Swoole\Coroutine\Redis();
        $redis->connect("127.0.0.1", 6379);
        $redis->setDefer(true);
        $redis->set('key1', 'value');
        Co::sleep(10);
        $redis2 = new Swoole\Coroutine\Redis();
        $redis2->connect("127.0.0.1", 6379);
        $redis2->setDefer(true);
        $redis2->get('key1');

        $result1 = $redis->recv();
        $result2 = $redis2->recv();

        var_dump($result1, $result2);
    });
});

$server->on('close', function ($ser, $fd) {

});

$server->start();