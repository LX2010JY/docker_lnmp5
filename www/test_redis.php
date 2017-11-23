<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/9/15
 * Time: 下午11:02
 */
$redis = new Redis();
$link = $redis->connect('redis','6379');
if(!$link) exit("connect link failed");
echo "Connection successed.";
$redis->set("name","luoxiao");
echo $redis->get("name");
echo "<br>";
echo "Server is running :".$redis->ping();