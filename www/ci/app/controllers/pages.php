<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/11/23
 * Time: 下午9:32
 */
class Pages extends CI_Controller {

    public function index() {
        var_dump($_SERVER);
    }

    public function view($page = 'home') {
        if(!file_exists(APPPATH . 'views/pages/'.$page.'.php')) {
            show_404();
        }
        $data['title'] = ucfirst($page);
        $this->load->view('templates/header', $data);
        $this->load->view('pages/'.$page, $data);
        $this->load->view('templates/footer', $data);
    }
}