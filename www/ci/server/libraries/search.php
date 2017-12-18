<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/18
 * Time: 下午10:20
 */
use QL\QueryList;
class search {
    private $baseurl = 'http://zhannei.baidu.com/cse/search?click=1&s=6778570619699276691&nsid=';
    private $key = '';
    private $url = '';
    public function __construct($key) {
        $this->url = $this->baseurl . '&'.$key;
    }
    public function fetch_search_result() {
        $data = QueryList::Query($this->url, array(
            "item" => array('.result-list .result-item', 'html')
        ))->data;
        var_dump($data);
    }


}