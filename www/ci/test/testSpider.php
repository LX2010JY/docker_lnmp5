<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/14
 * Time: 下午8:42
 */
require_once "../app/libraries/spider/spider.php";
require_once "../app/libraries/spider/BySpider.php";
//八一小说阅读网站
$url = "http://www.81zw.net/book/1653/";
$spider = new BySpider($url);
$spider->fetch_page_content($url);