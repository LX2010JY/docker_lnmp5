<?php
/**
 * Created by PhpStorm.
 * Author      : Lxiao
 * CreateTime  : 2017/11/29 17:14
 * Description : 用户登录权限相关
 */
class Auth extends CI_Controller {
    public function __construct() {
        parent::__construct();
        //session初始化暂时放在这儿吧
        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('auth_model');
    }


    public function register() {
        $data = ['error'=> ''];
        if($_POST) {
            $this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('passwd', 'passwd', 'required');
            if($this->form_validation->run() === false) {
                $data['error'] = '请完善信息';
            } else {
                if($this->auth_model->check_has_register()) {
                    $data['error'] = '此邮箱已经注册过了';
                } else {
                    $this->auth_model->regist_user();
                    $data['error'] = '注册成功';
                }
            }
        }
        $this->load->view('templates/header');
        $this->load->view("auth/register", $data);
        $this->load->view('templates/footer');
    }
}