<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/16
 * Time: 下午10:32
 */
use Medoo\Medoo;

class Novel {
    private $db;
    public function __construct() {
        require_once CONFIGPATH.'/database.php';
        $this->db = new Medoo($db_config);
    }

    /**
     * 检查是否已经被下载
     * @param $m
     * @param string $table
     * @return bool
     */
    public function check_have_save_data($m, $table = 'novel') {
        $where = [];
        foreach ($m as $k => $v) {
            $k = "{$k}";
            $where[$k] = $v;
        }
        var_dump($where);
        $r = $this->db->select($table, ['*'], $where);
        if($r) return true;
        return false;
    }
    /**添加一本小说
     * @param $arr
     */
    public function add_novel($arr) {
        $r = $this->db->insert('novels', $arr);
        return $this->db->id();
    }

    /**
     * 添加一章小说内容
     * @param $arr
     * @return bool|int
     */
    public function add_novel_chapter($arr) {
        $cp_id = $this->db->insert('novel_chapter', $arr);
        return $cp_id;
    }

}