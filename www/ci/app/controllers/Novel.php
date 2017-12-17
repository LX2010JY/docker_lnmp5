<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/16
 * Time: 下午8:52
 * 小说下载
 */
class Novel extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    /**
     * 小说下载情况实时推送
     */
    public function index() {
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view('novel/index');
        $this->load->view('templates/footer');
    }
}