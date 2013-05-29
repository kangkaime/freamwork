<?php
/*class error{
	
		register_shutdown_function('handle_fatal_error');
	    set_error_handler('custom_error');

	
	
	
	
	if ( ! function_exists('load'))
	{
	    function load($name, $type='model', $data=array())
	    {
	        static $loader = NULL;
	        if (is_null($loader))
	        {
	            include (ROOT.'/system/core/loader.php');
	            $loader = Loader::get_instance();
	        }
	
	        return $loader->$type($name, $data);
	    }
	}
	
	function handle_fatal_error()
	{
	    $error = error_get_last();
	    if ( ! empty($error))
	    {
	        show_error();
	    }
	}
	
	function custom_error($errno, $errstr, $errfile, $errline)
	{
	    $data = array(
	        'title' => "Custom error:</b> errno:[{$errno}]",
	        'message' => "{$errstr} Error on line {$errline} in {$errfile}"
	    );
	    show_error($data);
	}
	
	
	function show_error($data=array(), $code=404)
	{
	    if ($code === 404 )
	    {
	        header("HTTP/1.0 404 Not Found");
	        header("Status: 404 Not Found");
	    }
	
	    if ( ! isset($data['title']))
	    {
	        $data['title'] = 'error';
	    }
	
	    if ( ! isset($data['message']))
	    {
	        $error = error_get_last();
	        $data['message'] = "{$error['message']} in {$error['file']} on {$error['line']}";
	    }
	
	    load('error', 'view', $data);
	    exit;
	}
	
	$filename = strtolower($class);
	
	$file = ROOT . '/application/controllers/' . $filename . '.php';
	
	# 判断controller文件是否存在
	if ( ! file_exists($file))
	{
	    show_error(array('title'=>'url error', 'message'=>"controller: {$filename}.php is not exist"));
	}
	
	# 避免命名冲突
	if (class_exists($class))
	{
	    show_error(array('title'=>'error', 'message'=>"class {$class} is already exist"));
	}
	
	#加载进来
	include($file);
	#实例化
	$obj = new $class;
	
	if ( ! method_exists($obj, $func))
	{
	    show_error(array('title'=>'function error', 'message'=>"function {$func} is not exist"));
	}
		
	
}*/