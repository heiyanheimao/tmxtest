<?php
/**
 * Date     2019-07-31
 * Time     23:19
 * Author   CD-JAY
 * Detail
 */
$server = new Swoole\WebSocket\Server("0.0.0.0", 9501);
$server->on('open', function (Swoole\WebSocket\Server $server, $request)  {
//    echo "server: handshake success with fd{$request->fd}\n";
//    $info['server'] = $request->server;
//    var_dump($request);
    if ($request->fd == 3) {
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);
        $redis->set('server', $request->fd);
    }
});

$server->on('message', function (Swoole\WebSocket\Server $server, $frame){
//    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    $serverFd = $redis->get('server');
    if ($serverFd === false) {
        $server->push($frame->fd, "服务未开启");
    } elseif($serverFd == $frame->fd) {
        var_dump($frame->data);
        $server->push(intval(json_decode($frame->data, true)['fd']),$frame->data);
    } else {
        $server->push(intval($serverFd), $frame->fd);
    }

//    if ($serverFd != $frame->fd) {
//        $server->push($serverFd, "1");
//    } else {
//        $server->push(($frame->data) + 1);
//    }
});

$server->on('close', function ($ser, $fd) {
    $redis = new Redis();
    $redis->connect('127.0.0.1', 6379);
    if ($redis->get('server') == $fd) {
        $redis->del('server');
    }

});

$server->start();