<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/18
 * Time: 下午9:56
 * 笔趣阁小说网
 */
use QL\QueryList;
class BqSpider extends spider {
    public function __construct($url, $server=null, $frame=null) {
        parent::__construct($url, $server, $frame);
    }
    /**
     * 获取一部小说基本信息
     */
    public function get_novel_base_data() {
        $data = QueryList::Query($this->url, array(
            'cover' => array('#fmimg img', 'src'),
            'title' => array('#maininfo #info h1', 'text'),
            'author' => array('#maininfo>#info>p:eq(0)', 'text'),
//            'category' => array('.con_top > a:eq(1)', 'text'),
            'intro' => array('#intro', 'text'),
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
        $this->datalist['category'] = '未知';
        $this->datalist['chapter'] = $this->build_url($arr);
        $this->datalist['cover'] = $this->build_url($this->datalist['cover']);
        @$this->datalist['author'] = explode('：', $this->datalist['author'])[1];
        $have_save = $this->db->check_have_save_data(['title'=> $this->datalist['title']]);
        if($have_save) {
            $this->return_message('这本书你已经下载过了');
            return false;
        }
        $nid = $this->db->add_novel(array(
            'title' => $this->datalist['title'],
            'author' => $this->datalist['author'],
            'cover'  => $this->datalist['cover'],
            'category' => $this->datalist['category'],
            'intro'  => $this->datalist['intro'],
            'from'   => $this->url
        ));
        $this->datalist['nid'] = $nid;
        return true;
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
}