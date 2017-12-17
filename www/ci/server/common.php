<?php
/**
 * Created by PhpStorm.
 * User: lxiao
 * Date: 2017/12/16
 * Time: 下午10:34
 */
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
