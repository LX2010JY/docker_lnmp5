<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/11/23
 * Time: 下午10:12
 */
class News_model extends CI_Model {

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

    public function set_news() {
        $this->load->helper('url');
        //url_title 这个方法由 URL 辅助函数 提供，用于将字符串 中的所有空格替换成连接符（-），并将所有字符转换为小写。 这样其实就生成了一个 slug ，可以很好的用于创建 URI 。
        $slug = url_title($this->input->post('title'), 'dash', True);
        $data = array(
            'title' => $this->input->post('title'),
            'slug'  => $slug,
            'text'  => $this->input->post('text')
        );

        return $this->db->insert('news', $data);
    }
}