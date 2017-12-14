<?php
/**
 * Created by PhpStorm.
 * Author      : Lxiao
 * CreateTime  : 2017/12/7 14:31
 * Description :
 */
class TestHook {
    public function __construct() {
//        echo 'hook loaded';
    }
    public function printf($a = 10) {
        while ((int)$a > 0) {
            print "{$a}: load number";
            print "<br>";
            $a--;
        }
    }
}