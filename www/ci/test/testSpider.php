<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/14
 * Time: 下午8:42
 */
require_once "../server/libraries/spider/spider.php";
require_once "../server/libraries/spider/NewBySpider.php";
require_once "../vendor/autoload.php";
//八一小说阅读网站
$url = "http://www.81zw.net/book/18173/";
//$spider = new BySpider($url);
//$spider->fetch_page_content($url);
use spider\NewBySpider;
$spider = new NewBySpider($url);
$spider->get_novel_base_data();
$spider->crawl_all_chapter();