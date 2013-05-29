<?php

require '/sys/sys_class/sysfunc.php';

register_shutdown_function('sysfunc::handle_fatal_error');


set_error_handler('sysfunc::custom_error');


if ( ! function_exists('load'))
{
    function load($name, $type='model', $data=array())
    {
        static $loader = NULL;
        if (is_null($loader))
        {
            include ('/loader.php');
            
            $loader = Loader::get_instance();
        }

        return $loader->$type($name, $data);
    }
}


//分析url请求
# 如果为空，则是访问根地址
if (empty($url))
{
    # 默认控制器和默认方法
    $class = 'index';
    $func = 'welcome';
}else{
    $URI = explode('/', $url);
    var_dump($URI);
    # 如果function为空 则默认访问index
    if (count($URI) < 2)
    {
        $class = $URI[0];
        $func = 'index';
    }
    else
    {
        //$class = ucfirst($URI[0]);
        $class = $URI[0];
        $func = $URI[1];
    }
}

require BASEPATH.'/sys/sys_in.php';

require 'config.php';

$oIn =  new in( array('sys'=>'kk,123','db_mysql'=>$db_config,$class=>'kk'));

$var = array_slice($URI, 2);
echo $func;
$oIn->run($class, $func, $var);

unset($oIn);
//前台转向

//后台转向