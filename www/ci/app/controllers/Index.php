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
        $this->load->model('Novel_model');
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
        if($q !== false) $q = urldecode($q);
        $this->data['q'] = $q;
        $data = $this->Novel_model->search_novel($q);
        $this->data['list'] = $data;
        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $this->data);
        $this->load->view('index/search', $this->data);
        $this->load->view('templates/footer');
    }
}