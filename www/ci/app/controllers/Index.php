<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/13
 * Time: 下午10:22
 */
class Index extends CI_Controller {
    private $data = [];
    public function __construct() {
        parent::__construct();
        @$this->data['user'] = $this->session->email;
    }

    /**
     * 全网首页
     */
    public function index() {
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $this->data);
        $this->load->view('index/index');
        $this->load->view('templates/footer');
    }

    /**
     * 搜索结果
     * @param bool $q 搜索关键字
     */
    public function search($q = FALSE) {
        $this->data['q'] = $q;
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $this->data);
        $this->load->view('index/search');
        $this->load->view('templates/footer');
    }
}