<?php
/**
 * Created by PhpStorm.
 * Author      : Lxiao
 * CreateTime  : 2017/11/29 17:39
 * Description : 用户相关
 */
class Auth_model extends CI_Model {
    public function __construct() {
        $this->load->database();
    }

    /**
     * 判断用户邮箱是否已经注册了
     * @return bool
     */
    public function check_has_register() {
        $query = $this->db->get_where("user", array('email' => $this->input->post('email')));
        $r = $query->row_array();
        if($r) return true;
        return false;
    }

    /**
     * 注册用户
     * @return mixed
     */
    public function regist_user() {
        $this->load->helper('url');
        $data = array(
            'email' => $this->input->post('email'),
            'passwd_mw' => $this->input->post('passwd'),
            'passwd_hash' => md5($this->input->post('passwd'))
        );
        return $this->db->insert('user', $data);
    }

    /**
     * 登录
     * @return bool
     */
    public function login() {
        $query = $this->db->get_where('user', array('email'=> $this->input->post('email'), 'passwd_hash'=> md5($this->input->post('passwd'))));
        $r = $query->row_array();
        if($r) {
            $_SESSION = array_merge($_SESSION, $r);
            return true;
        } else {
            return false;
        }
    }
}