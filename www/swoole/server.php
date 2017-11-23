<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/9/15
 * Time: 下午11:08
 */
$server = new swoole_server("127.0.0.1",9501);
$server->on("connect",function ($ser,$fd){
    echo "Client: connect succeed.\n";
});
$server.on("receive",function ($ser,$fd,$from_id,$data) {
    $ser->send($fd,"Server:".$data);
});

$server.on("close",function($ser,$fd) {
    echo "Server Closed.\n";
});

$server->start();