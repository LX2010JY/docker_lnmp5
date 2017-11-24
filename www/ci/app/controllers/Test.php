<?php
/**
 * Created by PhpStorm.
 * Author      : Lxiao
 * CreateTime  : 2017/11/24 14:33
 * Description :
 */
class Test extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //引用类库的方法，位置在 application/library 或者 system/library 别再include_once 了...，又丑又乱
        $this->load->library('example_library');
        //引用通用函数库的方法 位置在 application/helper 或者 system/helper
        $this->load->helper('example');
    }

    /**
     * 调用自定义函数
     */
    public function func() {
        test();
    }

    /**
     * 调用自定义类库
     */
    public function lib() {
        $this->example_library->get_current_uri();
    }

    /**
     * 定义挂钩点执行方法
     */
    public function hooks($param) {
        echo 'this is a hook '. $param;
    }
}