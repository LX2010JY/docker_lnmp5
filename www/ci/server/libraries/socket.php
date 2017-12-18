<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/18
 * Time: 下午10:19
 */
class socket {
    private $server;
    public function __construct($port) {
        $this->server = new swoole_websocket_server("127.0.0.1", $port);
        $this->server->on('open', function($server, $req) {
            echo "connection open: {$req->fd}\n";
        });

        /**
         * 当收到客户端发送来的消息的时候，触发事件
         */
        $this->server->on('message', function($server, $frame) {
            echo "received message: {$frame->data}\n";
            if($frame->data == 'download') {
                $url = "https://www.xs.la/78_78031/";
                $spider = new BqSpider($url, $server, $frame);
                echo "\n开始下载咯!";
                $spider->start_crawl();
            } else {
                $server->push($frame->fd, json_encode(array("hello", "world")));
            }

        });

        /**
         * 当客户端断开连接时触发事件
         */
        $this->server->on('close', function($server, $fd) {
            echo "connection close: {$fd}\n";
        });

        //开启websocket服务端监听事务 端口9500
        $this->server->start();
    }
}