<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/13
 * Time: 下午10:22
 */
class Index extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }

    public function index() {
        @$data['user'] = $this->session->email;

        $this->load->view('templates/header');
        $this->load->view('templates/navbar', $data);
        $this->load->view('index/index');
        $this->load->view('templates/footer');
    }
}