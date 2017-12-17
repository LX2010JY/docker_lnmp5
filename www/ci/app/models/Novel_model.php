<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/17
 * Time: 下午7:40
 */
class Novel_model extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    /**
     * 搜索小说结果
     * @param bool $q
     * @return mixed
     */
    public function search_novel($q = false) {
        if($q === false) {
            $query = $this->db->get('novels');
            return $query->result_array();
        } else {
            $query = $this->db->get_where('novels', array('title' => $q));
            return $query->result_array();
        }
    }
}