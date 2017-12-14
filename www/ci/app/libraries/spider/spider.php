<?php
/**
 * Created by PhpStorm.
 * Author      : Lxiao
 * CreateTime  : 2017/12/14 16:06
 * Description :
 */
interface spider {
    /**
     * 获取页面基本信息
     * @param $url
     * @return mixed
     */
    public function fetch_page_content($url);

    /**
     * 获取封面
     * @return mixed
     */
    public function get_cover();

    /**
     * 获取标题
     * @return mixed
     */
    public function get_title();

    /**
     * 获取作者
     * @return mixed
     */
    public function get_author();

    /**
     * 获取简介
     * @return mixed
     */
    public function get_desc();

    /**
     * 获取类型 玄幻？
     * @return mixed
     */
    public function get_category();

    /**
     * 是否已经完结
     * @return mixed
     */
    public function is_over();

    /**
     * 获取章节名、地址
     * @return mixed list
     */
    public function get_chapter();

    /**
     * 下载章节
     * @return mixed
     */
    public function download_chapter();

    /**
     * 下载单个章节
     * @param $url
     * @return mixed
     */
    public function download_single_chapter($url);

    /**
     * 先存在redis，如果没下载完就出错了，则丢弃掉，然后存入数据库
     * @return mixed
     */
    public function save();
}