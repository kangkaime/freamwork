<?php

class loader
{
    private $_loaded_models = array();
    private $_loaded_librarys = array();
    private static $OBJ;

    # 单例模式，不允许new对象
    private function __construct()
    {

    }


    public static function get_instance()
    {
        if (is_null(self::$OBJ))
        {
            $class = __CLASS__;
            self::$OBJ = new $class;
        }
        
        return self::$OBJ;
    }

    public function model($model, $path = 'front',$data=array())
    {
        $model = strtolower($model);

        # 如果已经加载，则返回对象，避免重复加载
        if (isset($this->_loaded_models[$model]))
        {
            return $this->_loaded_models[$model];
        }

        # 否则加载文件
        include ROOT."/".$path."/class/{$model}.php";

        $class = ucfirst($model);
        # 实例化对象
        if (empty($data))
        {
            $instance = new $class;
        }
        else
        {
            $instance = new $class($data);
        }
        # 把对象cache起来
        $this->_loaded_models[$model] = $instance;

        return $instance;
    }


    public function library($library, $path = '',$data=array())
    {
        $library = strtolower($library);

        # 如果已经加载，则返回对象，避免重复加载
        if (isset($this->_loaded_librarys[$library]))
        {
            return $this->_loaded_librarys[$library];
        }

        # 否则加载文件
        include ROOT."/".$path."/librarys/{$library}.php";

        //$class = ucfirst($library);
        $class = $library;
        # 实例化对象
        if (empty($data))
        {
            $instance = new $class;
        }
        else
        {
            $instance = new $class($data);
        }
        
        # 把对象cache起来
        $this->_loaded_librarys[$library] = $instance;

        return $instance;
    }


    public function view($view,$path = 'front' ,$data=array())
    {
        $view = strtolower($view);

        extract($data);
        
        ob_clean();
        
        ob_start();
        # 否则加载文件
        include ROOT."/".$path."/view/{$view}.html";

        $content = ob_get_contents();
        @ob_end_clean();

        $pattern = array(
            '/<ifexist\s+(\w+)>/i',
            '/<for\s+(\w+)\s*=\s*(\w+)>/',
            '/<echo\s+(\w+)>/'
        );

        $replacement = array(
            '<?php if( ! empty($\\1)){ ?>',
            '<?php foreach($\\2 as $\\1){ ?>',
            '<?php echo $\\1 ?>'
        );

        $content = preg_replace($pattern, $replacement, $content);

        $search = array('<endexist>', '<endfor>');
        $content = str_replace($search, '<?php } ?>', $content);
      // echo $content;
        //$content = eval(' '.$content);
        
        if ( ! empty($data['do_not_display']))
        {
        	
            return $content;
            
        }

        echo $content;

        return TRUE;
    }
    public function sayme(){
    	
    	echo "i am loader class";
    }
	public static function  __isStatic(){
		
		return true;
	}


}



?>
