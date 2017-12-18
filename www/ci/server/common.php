<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/16
 * Time: 下午10:34
 */
require_once LIBRARYPATH.'/spider.php';
define('MESSAGE_ERROR', 1);
define("MESSAGE_OK", 0);

function &load_class($class, $param = null)
{
    static $_classes = array();

    // Does the class exist? If so, we're done...
    if (isset($_classes[$class]))
    {
        return $_classes[$class];
    }

    $name = $class;

    // Look for the class first in the local application/libraries folder
    // then in the native system/libraries folder
    foreach (array(MODELPATH, SPIDERPATH) as $path)
    {
        if (file_exists(rtrim($path, '/').'/'.$class.'.php'))
        {
            if (class_exists($name, FALSE) === FALSE)
            {
                require_once(rtrim($path, '/').'/'.$class.'.php');
            }

            break;
        }
    }
    $_classes[$class] = isset($param)
        ? new $name($param)
        : new $name();
    return $_classes[$class];
}

/**
 * websocket 发送给客户端消息结构 构造
 * @param $status 成功还是失败
 * @param $mt 消息类型
 * @array $content 消息主体内容 数组格式
 * @return string
 */
function websocket_message_struct($status, $mt,array $content) {
    $arr = array(
        'status' => $status,
        'message_type' => $mt,
        'content' => $content
    );
    return json_encode($arr);
}