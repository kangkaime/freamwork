<?php

class index
{
	public $obj= array();
    function __construct( $obj )
    {
    	$this->obj = $obj;
    	$this->hello = sysfunc::load('hello','model', 'front');
    	
    }

    function welcome()
    {
        $result['title'] = '这里是welcome页面';
        $result['content'] = 'hello world'; 

        sysfunc::load('index', 'view','front' ,$result);

    }


    function not_display()
    {
    	

        $result['title'] = '这里是not_display页面';
        $result['content'] = '不要输出'; 
        $result['arr'] = array(0,1,2,3,4,5,6);
        
        # 如果设置不显示，则返回html内容
        $result['do_not_display'] = true;
        $content1 = sysfunc::load('index', 'view','front', $result);
        
        $MY = sysfunc::instance($oIn);
       $this->hello->say('kk');
         var_dump( $this->obj->db_mysql->tables());
    }



    function test()
    {
        $result['title'] = '这里是not_display页面';
        $result['content'] = '不要输出'; 
        $result['arr'] = array(0,1,2,3,4,5,6);

        $content = sysfunc::load('index_2', 'view', 'front',$result);
    }


}


?>
