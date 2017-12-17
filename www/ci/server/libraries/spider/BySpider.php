<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/14
 * Time: 下午8:40
 */
class BySpider implements spider {
    private $url;
    private $html;
    private $baseurl;
    private $data;
    public function __construct($url) {
        $this->url = $url;
        $this->get_baseurl();
    }
    private function get_baseurl() {
        $pattern = "/^([^\/]*\/\/)([^\/]*)\//";
        $r = preg_match($pattern, $this->url, $m);
        $this->baseurl = rtrim($m[0], '/');
    }
    /**
     * 获取页面基本信息
     * @param $url
     * @return mixed
     */
    public function fetch_page_content($url) {
        // TODO: Implement fetch_page_content() method.
        $this->load_url($url);
        //获取封面
        $this->data['cover'] = $this->get_cover();
        //获取标题
        $this->data['title'] = $this->get_title();
        //获取作者
        $this->data['author'] = $this->get_author();
        $this->data['desc'] = $this->get_desc();

        $this->data['chaplist'] = $this->get_chapter();
        var_dump($this->data);
//        $this->download_chapter($chaplist);
    }

    public function load_url($url) {
        //八一小说网是gbk编码，转为utf-8
        $html = file_get_contents($url);
        $html = iconv("gbk", "utf-8", $html);
        $this->html = $html;
    }
    /**
     * 获取封面
     * @return mixed
     */
    public function get_cover() {
        // TODO: Implement get_cover() method.
        $pattern = "/<div id=\"fmimg\">.*<img.*src=\"([^\"]*)\".*<\/div>/";
        preg_match($pattern, $this->html , $matterns);
        return "{$this->baseurl}.{$matterns[1]}";
    }

    /**
     * 获取标题
     * @return mixed
     */
    public function get_title() {
        //这写的什么玩意儿？
        $pattern = "/<div id=\"maininfo\">[^>]*>[^>]*>([^<]*)/";
        preg_match($pattern, $this->html, $m);
        return $m[1];
    }

    /**
     * 获取作者
     * @return mixed
     */
    public function get_author() {
        // TODO: Implement get_author() method.
        $pattern = "/<div id=\"maininfo\">([\w\W]*?)<p>(.*?)<\/p>/";
        preg_match($pattern, $this->html, $m);
        $r = $m[2];
        if(!$r) return "";
        $author = explode('：', $r);
        $author = $author[1];
        return $author;
    }

    /**
     * 获取简介
     * @return mixed
     */
    public function get_desc() {
        // TODO: Implement get_desc() method.
        $pattern = "/<div id=\"intro\"[\w\W]*?<p>([\w\W]*?)<\/p>/";
        preg_match($pattern, $this->html, $m);
        return $m[1];
    }

    /**
     * 获取类型 玄幻？
     * @return mixed
     */
    public function get_category() {
        // TODO: Implement get_category() method.
    }

    /**
     * 是否已经完结
     * @return mixed
     */
    public function is_over() {
        // TODO: Implement is_over() method.
    }

    /**
     * 获取章节名、地址
     * @return mixed list
     */
    public function get_chapter() {
        // TODO: Implement get_chapter() method.
        $pattern = "/<dl>([\w\W]*)<\/dl>/";
        preg_match($pattern, $this->html, $mm);
        $pattern = "/<dd>.*<a.*href=\"(.*)\">(.*)<\/a><\/dd>/";
        preg_match_all($pattern, $mm[1], $e, PREG_PATTERN_ORDER);
        $chap_list = [];
        foreach ($e[0] as $k => $v) {
            $chap_list[] = array(
                'url' => rtrim($this->baseurl, '/') . $e[1][$k],
                'title' => $e[2][$k]
            );
        }
        return $chap_list;
    }

    public function write_file($file) {
        // TODO: Implement write_file() method.

    }

    /**
     * 下载章节
     * @return mixed
     */
    public function download_chapter($chaplist) {
        // TODO: Implement download_chapter() method.
        $f = fopen("./圣墟.txt", "a+");
        foreach ($chaplist as $k => $v) {
            $file = $this->download_single_chapter($v['url'], $v['title']);
            fwrite($f, "\n{$v['title']}\n");
            fwrite($f, $file);
            echo "\n正在获取第{$k}条数据...\n";
        }
    }

    /**
     * 下载单个章节
     * @param $url
     * @return mixed
     */
    public function download_single_chapter($url, $title) {
        // TODO: Implement download_single_chapter() method.
        $html = file_get_contents($url);
        $html = iconv("gbk", "utf-8", $html);
        $pattern = "/<div id=\"content\">([\w\W]*?)<\/div>/";
        preg_match($pattern, $html, $ma);
        $r = str_replace("<br />", "\n", $ma[1]);
        $r = str_replace("&nbsp;", " ", $r);
        return $r;
    }

    /**
     * 先存在redis，如果没下载完就出错了，则丢弃掉，然后存入数据库
     * @return mixed
     */
    public function save() {
        // TODO: Implement save() method.
    }
}