<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/9/15
 * Time: 下午11:00
 */
$mem = new Memcache;
$link = $mem->connect("memcached","11211");
if(!$link) {
    exit("connect memcached failed.");
}
$mem->set("name","冯佳雨",0,5201314);
echo $mem->get("name");

