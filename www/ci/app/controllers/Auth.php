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
//        //session初始化暂时放在这儿吧,已移至 config/autoload.php
//        $this->load->library('session');
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('auth_model');
    }
	/**
	 * 用户登录界面
     * 用户登录以后，session返回一个session id存入cookie中，而登录信息等存在了服务端session文件中，每次用户访问，通过cookie传过来的session id，
     * 去查找session文件，并获取用户相关信息，这样就知道登录用户是谁了
     * TODO session保存时间短，如果用户信息保存在服务端，那么如何做到记住登录状态，几个月保持登录状态呢？
	 */
	public  function login() {
		$data = array('error' => '');
		if($_POST) {
			$this->form_validation->set_rules('email', 'email', 'required');
            $this->form_validation->set_rules('passwd', 'passwd', 'required');
            if($this->form_validation->run() === false) {
                $data['error'] = '请完善登录信息';
            } else {
                if($this->auth_model->login()) {
                    $data['error'] = '登录成功';
                    redirect('index/index');
                } else {
                    $data['error'] = '账号或者密码错误';
                }
            }
		}
		$this->load->view('templates/header');
		$this->load->view('templates/navbar');
		$this->load->view('auth/login', $data);
		$this->load->view('templates/footer');
	}
	/**
 	 * 用户注册界面
	 */
    public function register() {
        $data = array('error'=> '');
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
                    redirect('auth/login', $data);
                }
            }
        }
        $this->load->view('templates/header');
        $this->load->view('templates/navbar');
        $this->load->view("auth/register", $data);
        $this->load->view('templates/footer');
    }

    /**
     * 用户登出
     */
    public function logout() {
        session_destroy();
        redirect('index/index');
    }
}
