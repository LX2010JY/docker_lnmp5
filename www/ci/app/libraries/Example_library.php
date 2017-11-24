<?php
/**
 * Created by PhpStorm.
 * Author      : Lxiao
 * CreateTime  : 2017/11/24 14:23
 * Description : 类库创建测试
 */
class Example_library {
    protected $CI;

    public function __construct() {
        //调用codeigniter 对象，& 使用同一个codeigniter对象，而不是副本
        $this->CI = & get_instance();
    }

    public function get_current_uri() {
        $this->CI->load->helper('url');
        $current_url = current_url();
        echo $current_url;
    }

    public function redirect($url) {
        $this->CI->load->helper('url');
        redirect($url);
    }
}