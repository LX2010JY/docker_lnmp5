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
        $this->load->helper(array('form', 'url'));
        //加载session
        $this->load->library('session');
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
     * 基准测试
     * http://codeigniter.org.cn/user_guide/libraries/benchmark.html
     * TODO 不懂怎么办到的，好奇内容
     */
    public function jizhun_ceshi() {
        //这个方法不能在控制器使用，只能在视图层使用
        //显示从运行开始到结束花费时间
//        echo $this->benchmark->elapsed_time();
        //显示内存占用
//        echo $this->benchmark->memory_usage();
        $this->load->view('test/ceshi');
    }

    /**
     * 缓存驱动
     * TODO 重点学习内容
     */
    public function cache() {
        //redis 连接配置在application/config/redis.php
        $this->load->driver('cache', array('adapter' => 'redis', 'backup' => 'file'));
        if(!$foo = $this->cache->get('foo')) {
            echo 'Saving to the Cache!<br>';
            $foo = 'foobarbaz!';
            $this->cache->save('foo', $foo, 300);
        }
        echo $foo;
    }

    /**
     * 使用memcached缓存
     */
    public function cache2() {
        /**
         * memcached连接配置在 application/config/memcached.php
         */
        $this->load->driver('cache');
        if( !$foo = $this->cache->memcached->get('foo') ) {
            echo 'Saving to the memcached cache!<br>';
            $foo = 'foomem';
            $this->cache->memcached->save('foo', $foo, 300);
        }
        echo $foo;
    }

    /**
     * 日历类 不知道有什么用
     */
    public function calendar() {
        $this->load->library('calendar');
        echo $this->calendar->generate();
    }

    /**
     * 加密算法，目前缺少php扩展，不能用
     * @param $word
     */
    public function encrypt($word) {
        $this->load->library('encrypt');
        echo "your word is :" . $word;
        $word = $this->encrypt->encode($word);
        echo '<br>this is encrypt word:' . $word;
        echo $this->encrypt->decode($word);
    }

    /**
     * 通用静态页面
     */
    public function pages() {
        $this->load->view('templates/header');
        $this->load->view('test/pages', array('error'=> ' '));
        $this->load->view('templates/footer');
    }

    /**
     * 上传文件
     * TODO
     */
    public function do_upload() {
        $config['upload_path'] = './upload/';
        $config['allowed_types'] = 'gif|jpg|png|mp3';
        $config['max_size'] = 100;
        $config['max_width'] = 1024;
        $config['max_height'] = 768;

        $this->load->library('upload', $config);
        if(!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());
            $this->load->view('test/pages', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());
            var_dump($data);
            $this->load->view('test/pages', array('error' => '成功了'));
        }
    }

    /**
     * session测试
     * TODO very important
     */
    public function session2() {
        var_dump($this->session);
    }
    /**
     * 定义挂钩点执行方法
     */
    public function hooks($param) {
    }
}