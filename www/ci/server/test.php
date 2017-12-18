<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/18
 * Time: 下午10:27
 */
define('BASEPATH', pathinfo(__FILE__, PATHINFO_DIRNAME)); //当前地址
define('LIBRARYPATH', 'libraries');
define('MODELPATH', LIBRARYPATH.'/model'); //数据库模型操作
define('SPIDERPATH', LIBRARYPATH . '/spider'); //数据抓取操作
define('CONFIGPATH', 'config'); //配置文件

require_once "./common.php";
require_once "./libraries/search.php";
require_once "../vendor/autoload.php";
$s = new search('大主宰');
$s->fetch_search_result();
