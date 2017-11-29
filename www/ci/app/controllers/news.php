<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/11/23
 * Time: 下午10:28
 */
class News extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model("news_model");
        $this->load->helper("url_helper");
//        $this->output->enable_profiler(TRUE);

    }
    //url调用方法重新映射，一旦创建了_remap方法，所有访问News的url都会访问这个方法
//    public function _remap($method) {
//        $method = ''.$method;
//        if(method_exists($this, $method)) {
//            $this->$method();
//        } else {
//            $this->index();
//        }
//    }

    /**
     * 输出方法 ，在控制器发送数据给浏览器之前 必须先调用此方法
     * @param $output 发送给浏览器的方法
     */
    public function _output($output) {
        echo $output;
    }
    /**
     * 获取所有的新闻信息
     */
    public function index() {
        $data['news'] = $this->news_model->get_news();
        $this->output->cache(10);

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
        $slug = urldecode($slug);
        $data['news_item'] = $this->news_model->get_news($slug);
        if(empty($data['news_item'])) {
            show_404();
        }
        $data['title'] = 'nihao';
        $this->load->view('templates/header', $data);
        $this->load->view('news/view', $data);
        $this->load->view('templates/footer');
    }

    /**
     * 创建新闻条目
     */
    public function create() {
        $this->load->helper('form');
        $this->load->library('form_validation');

        $data['title'] = 'Create a news item';

        $this->form_validation->set_rules('title', 'Title', 'required');
        $this->form_validation->set_rules('text', 'Text', 'required');

        if($this->form_validation->run() === false) {
            $this->load->view('templates/header', $data);
            $this->load->view('news/create');
            $this->load->view('templates/footer');
        } else {
            $this->news_model->set_news();
            $this->load->view('news/success');
        }
    }
}