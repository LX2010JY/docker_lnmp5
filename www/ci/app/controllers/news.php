<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/11/23
 * Time: 下午10:28
 */
class news extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("news_model");
        $this->load->helper("url_helper");
    }

    /**
     * 获取所有的新闻信息
     */
    public function index() {
        $data['news'] = $this->news_model->get_news();

        $data['title'] = 'News archive';
        $this->load->view('templates/header', $data);
        $this->load->view('news/index', $data);
        $this->load->view('templates/footer');
    }

    /**
     * 获取单独的新闻条目
     * @param bool $slug
     */
    public function view($slug = false) {
        $data['news_item'] = $this->news_model->get_news($slug);
        if(empty($data['news_item'])) {
            show_404();
        }
        $data['title'] = 'nihao';
        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }
}