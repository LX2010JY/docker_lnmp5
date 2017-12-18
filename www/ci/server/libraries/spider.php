<?php
/**
 * Created by PhpStorm.
 * Author      : Lxiao
 * CreateTime  : 2017/12/18 17:20
 * Description :
 */
use QL\QueryList;
abstract class spider {
    protected $url;
    protected $baseurl;
    protected $datalist;
    protected $server;
    protected $db;
    public function __construct($url, $server=null, $frame=null) {
        $this->url = $url;
        $this->server = $server;
        $this->frame = $frame;
        $this->get_baseurl();
        $this->db = &load_class('Novel');
    }
    /**
     * 获取域名
     */
    protected function get_baseurl() {
        $pattern = "/^([^\/]*\/\/)([^\/]*)\//";
        $r = preg_match($pattern, $this->url, $m);
        $this->baseurl = rtrim($m[0], '/');
    }
    /**
     * 构建完整url
     */
    protected function build_url($url) {
        if(is_array($url)) {
            foreach ($url as $k => $v) {
                $url[$k] = rtrim($this->baseurl, '/') . $v;
            }
        } else {
            $url = rtrim($this->baseurl, '/') . $url;
        }
        return $url;
    }
    /**
     * 反馈消息
     * @param $info
     */
    public function return_message($info) {
        echo "\n".$info;
        $this->server->push($this->frame->fd, $info);
    }
    /**
     * 保存小说内容
     * @param $data
     */
    protected function save_novel($data) {
        if(!$this->datalist['nid']) return 0;
        $have_save = $this->db->check_have_save_data(array('title' => $data['title']), 'novel_chapter');
        if($have_save) {
            $this->return_message("你已经下载过了：{$data['title']}");
            return 0;
        }
        $cp_id = $this->db->add_novel_chapter(array(
            'title' => $data['title'],
            'content' => $data['content'],
            'from'   => $data['url'],
            'nid'    => $this->datalist['nid']
        ));
        return $cp_id;
    }
    /**
     * 检查小说类型是否存在，如果存在则写入表，若不存在则新建再写入
     */
    protected function save_category() {
        $category = $this->datalist['category'];
        $nid = $this->datalist['nid'];
        $this->db->save_category($category, $nid);
    }
    /**
     * 小说封面下载
     */
    protected function download_cover() {
        $pathinfo = pathinfo($this->datalist['cover']);
        $filename = md5($pathinfo['filename'] ? $pathinfo['filename'] : time());
        $extension = $pathinfo['extension'] ? $pathinfo['extension'] : 'jpg';
        $fname = $filename . '.' . $extension;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->datalist['cover']);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        $file = curl_exec($ch);
        curl_close($ch);
        $f = fopen('../upload/cover/' . $fname, 'a');
        fwrite($f, $file);
        fclose($f);
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
     * 开始下载吧
     */
    public function start_crawl() {
        //获取书基本信息
        $res = $this->get_novel_base_data();
        if(!$res) return;
        //保存书类别
        $this->save_category();
        //下载封面
        $this->download_cover();
        //抓取所有章节
        $this->crawl_all_chapter();
    }
    //获取一本小说基本信息
    public abstract function get_novel_base_data();
    //获取一本小说单一章节信息
    public abstract function get_one_chapter_info($url);

}