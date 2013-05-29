<?php
//后台系统
$admin_path = 'admin';
	
//公有
$public_path = 'public';
//前台系统
$front_path = 'front';
//index.php
define('SELF', pathinfo(__FILE__, 2));

//index页路径
define('BASEPATH', str_replace("\\", "/", ""));
//定义根目录
define('ROOT', trim(__DIR__,'/'));
//绝对路径
define('FCPATH', str_replace(SELF, '', __FILE__));

define('SYSDIR', trim(strrchr(trim(BASEPATH, '/'), '/'), '/'));

//定义前台路径

if (is_dir($front_path))
{
	define('FRONTPATH', $front_path.'/');
}
else
{
	if ( ! is_dir(BASEPATH.$front_path.'/'))
	{
		exit("Your FRONT folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
	}

	define('FRONTPATH', BASEPATH.$front_path.'/');
}



if (is_dir($admin_path))
{
	define('ADMINPATH', $admin_path.'/');
}
else
{
	if ( ! is_dir(BASEPATH.$admin_path.'/'))
	{
		exit("Your ADMIN folder path does not appear to be set correctly. Please open the following file and correct this: ".SELF);
	}

	define('ADMINPATH', BASEPATH.$admin_path.'/');
}

# 定义application路径
define('APPPATH', trim(__DIR__,'/'));

# 获得请求地址
$root = $_SERVER['SCRIPT_NAME'];
$request = $_SERVER['REQUEST_URI'];

$URI = array();

# 获得index.php 后面的地址
$url = trim(str_replace($root, '', $request), '/');



require_once BASEPATH.'core/workflow.php';