<?php
class sysfunc{
	
		
	public static  function sayme(){
		
		echo "i am static class</br>";
	}
	/**
	 * 转到xxx.control.php页面
	 *
	 * @param string $baseDirectory 基本路径
	 * @param string $fileName 控制层文件名
	 */
	public static function redirectToC( $baseDirectory = '' , $fileName = ''){
		
		if( file_exist( $baseDirectory.'/control/'.$fileName.'.c.php' ) ){
			
			include $baseDirectory.'/control/'.$fileName.'.c.php';
			
		}else{
			
			exit('error');
		}
		
	}
	
	
	public static function  __isStatic(){
		
		return true;
	}
	
	public static 	function show_error($data=array(), $code=404)
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
	
	public static	function handle_fatal_error()
	{
	    $error = error_get_last();
	    if ( ! empty($error))
	    {
	        self::show_error();
	    }
	}
	
	public static 	function custom_error($errno, $errstr, $errfile, $errline)
	{
	    $data = array(
	        'title' => "Custom error:</b> errno:[{$errno}]",
	        'message' => "{$errstr} Error on line {$errline} in {$errfile}"
	    );
	    self::show_error($data);
	}
	
	
}