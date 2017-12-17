<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/16
 * Time: 上午10:51
 */
use QL\QueryList;

class NewBySpider{
    private $url;
    private $baseurl;
    private $datalist;
    private $server;
    private $db;
    public function __construct($url, $server, $frame) {
        $this->url = $url;
        $this->server = $server;
        $this->frame = $frame;
        $this->get_baseurl();
        $this->db = &load_class('Novel');
    }
    /**
     * 获取域名
     */
    private function get_baseurl() {
        $pattern = "/^([^\/]*\/\/)([^\/]*)\//";
        $r = preg_match($pattern, $this->url, $m);
        $this->baseurl = rtrim($m[0], '/');
    }

    /**
     * 获取一部小说基本信息
     */
    public function get_novel_base_data() {
        $data = QueryList::Query($this->url, array(
            'cover' => array('#fmimg img', 'src'),
            'title' => array('#maininfo #info h1', 'text'),
            'author' => array('#maininfo>#info>p:eq(0)', 'text'),
            'category' => array('.con_top > a:eq(1)', 'text'),
            'intro' => array('#intro>p:eq(0)', 'text'),
        ),'', 'utf-8');
        $arr = $data->getData(function ($x) {
            return $x;
        });
        $this->datalist = $arr[0];
        $chapter = QueryList::Query($this->url, array(
            'chapter' => array("#list dd>a", 'href')
        ));
        $arr = $chapter->getData(function ($x) {
            return $x['chapter'];
        });
        $this->datalist['chapter'] = $this->build_url($arr);
        $this->datalist['cover'] = $this->build_url($this->datalist['cover']);
        @$this->datalist['author'] = explode('：', $this->datalist['author'])[1];
//        $have_save = $this->db->check_have_save_data(['title'=> $this->datalist['title']]);
        $nid = $this->db->add_novel(array(
            'title' => $this->datalist['title'],
            'author' => $this->datalist['author'],
            'cover'  => $this->datalist['cover'],
            'category' => $this->datalist['category'],
            'intro'  => $this->datalist['intro'],
            'from'   => $this->url
        ));
        $this->datalist['nid'] = $nid;
    }

    /**
     * 抓取一本小说全部内容
     */
    public function crawl_all_chapter() {
        foreach ($this->datalist['chapter'] as $k => $v) {
            $r = $this->get_one_chapter_info($v);
            $this->datalist['chapter'][$k] = array(
                'title' => $r['title'],
                'url'   => $v,
                'content' => $r['content']
            );

            $this->save_novel($this->datalist['chapter'][$k]);
            $this->return_message("\n已经下载第" . ($k+1) . "章：{$r['title']},正在下载第" . ($k+2) ."章...");
        }
        echo "\n下载完毕！";
        $this->return_message("\n全部下载完毕！！！");
    }

    /**
     * 下载中，反馈消息给用户
     * @param $info
     */
    public function return_message($info) {
//        echo $info;
        $this->server->push($this->frame->fd, $info);
    }
    /**
     * 获取一章内容
     * @param $url
     */
    public function get_one_chapter_info($url) {
        $obj = QueryList::Query($url, array(
            'title' => array(".bookname h1", 'text'),
            'content' => array('#content', 'html')
        ));
        $data = $obj->getData(function ($x) {
            $x['title'] = trim(str_replace('正文', "", $x['title']));
            $x['content'] = preg_replace("/<br.*?>/", "\n", $x['content']);
            $x['content'] = preg_replace("/&.*?;/", " ", $x['content']);
            return $x;
        });
        return $data[0];
    }

    /**
     * 保存小说内容
     * @param $data
     */
    private function save_novel($data) {
        if(!$this->datalist['nid']) return 0;
//        $have_save = $this->db->check_have_save_data(array('title' => $data['title']), 'novel_chapter');
//        if($have_save) return 0;
        $cp_id = $this->db->add_novel_chapter(array(
            'title' => $data['title'],
            'content' => $data['content'],
            'from'   => $data['url'],
            'nid'    => $this->datalist['nid']
        ));
        return $cp_id;
    }
    /**
     * 构建完整url
     */
    private function build_url($url) {
        if(is_array($url)) {
            foreach ($url as $k => $v) {
                $url[$k] = rtrim($this->baseurl, '/') . $v;
            }
        } else {
            $url = rtrim($this->baseurl, '/') . $url;
        }
        return $url;
    }
    //测试
    public static function test() {
        $hj = QueryList::Query('http://mobile.csdn.net/',array("url"=>array('.unit h1 a','href')));
        $data = $hj->getData(function ($x) {
            return $x['url'];
        });
        print_r($data);
    }
}