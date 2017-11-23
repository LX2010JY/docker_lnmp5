<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/11/23
 * Time: 下午10:12
 */
class news_model extends CI_Model {

    public function __construct() {
        $this->load->database();
    }

    /**
     * 获取新闻
     * @param bool $slug
     * @return mixed
     */
    public function get_news($slug = false) {
        if($slug === false) {
            $query = $this->db->get('news');
            return $query->result_array();
        }
        $query = $this->db->get_where("news", array('slug' => $slug));
        return $query->row_array();
    }
}