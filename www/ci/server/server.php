<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/16
 * Time: 下午8:29
 * websocket 通信服务端
 */
define('BASEPATH', pathinfo(__FILE__, PATHINFO_DIRNAME)); //当前地址
define('LIBRARYPATH', 'libraries');
define('MODELPATH', LIBRARYPATH.'/model'); //数据库模型操作
define('SPIDERPATH', LIBRARYPATH . '/spider'); //数据抓取操作
define('CONFIGPATH', 'config'); //配置文件

require_once "../server/libraries/spider/spider.php";
require_once "../server/libraries/spider/NewBySpider.php";
require_once "../vendor/autoload.php";
require_once "./common.php";



$server = new swoole_websocket_server("127.0.0.1", 9501);
/**
 * 当连接建立的时候，触发事件
 */
$server->on('open', function($server, $req) {
    echo "connection open: {$req->fd}\n";
});

/**
 * 当收到客户端发送来的消息的时候，触发事件
 */
$server->on('message', function($server, $frame) {
    echo "received message: {$frame->data}\n";
    if($frame->data == 'download') {
        $url = "http://www.81zw.net/book/18173/";
        $url = "http://www.81zw.net/book/415/";
        $spider = new NewBySpider($url, $server, $frame);
        $spider->get_novel_base_data();
        echo "\n开始下载咯!";
        $spider->crawl_all_chapter();
    } else {
        $server->push($frame->fd, json_encode(array("hello", "world")));
    }

});

/**
 * 当客户端断开连接时触发事件
 */
$server->on('close', function($server, $fd) {
    echo "connection close: {$fd}\n";
});

//开启websocket服务端监听事务 端口9500
$server->start();