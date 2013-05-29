<?php


 
class in{
	
	    protected $ClaDirectorys = array('sys/sys_class','admin/class','front/class');
	    
	    protected $ConDirectorys = array('admin/function','front/function');
	    /**
	     * 构造类初始化
	     * 
	     * @param  $clasNameArr 类参数数组  key为类名称 value 为相应类的参数数组
	     * *********************************************************************
	     *  如同 :array('sys'=>'kk,123','db_mysql'=>$db_config,'sysfunc'=>'')
	     * *********************************************************************
	     */
	    public function __construct( $clasNameArr ){
	    	
	    	foreach( $clasNameArr as $className => $classParam ){
	    		   
					$this->__autoload( $className ,$classParam);
					
	    	}
	    	
	    	
	    } 
	    /**
	     * 建立映射类  返回是否为存在静态类
	     * 同一规定在建立类文件的同时 声明方法  public  __isStatic()  返回 ture  or false
	     * @param string $className 类名称
	     * @param string $methodName  方法名 默认为 缺省参数 __isStatic
	     */
	    private function hasStaticMethod( $className , $methodName = '__isStatic'){
	    	
	        $ref = new ReflectionClass($className);
    		if ($ref->hasMethod( $methodName ) && $ref->getMethod( $methodName )->isStatic()) {
    			
        		return true;
        		
    			}
    		return false;
	    	
	    }
	    /**
	     * 自动加载类文件 
	     *   如果类是静态类则加载文件  ,如果是不是静态则加载文件并初始化实例  实例名为className
	     * @param   string $className  类文件名
 	     * @param   string $classParam 参数
	     */
	    
		public function __autoload( $className ,$classParam ) {
			
				foreach ($this->ClaDirectorys as $directory ){
					
			      if ( file_exists( $directory.'/'.$className . '.php' ) ) {
			      	
			          require_once $directory.'/'.$className . '.php';
			          
			          if( class_exists( $className )  &&  (!$this->hasStaticMethod( $className )) ){
			          	
			          	if( $classParam ){
			          		if( is_string( $classParam ) ){
			          			
			          			$tmpClassParam = explode(',' ,$classParam);
			          			
			          			$this->$className = $this->newInst($className, $tmpClassParam);
			          			
			          		}elseif( is_array( $classParam ) ){
			          			$this->$className = $this->newInst($className, $classParam);
			          			
			          		}else{
			          			
			          			exit(" class Param  is not right");
			          			
			          		}
			          		
			          	}else{
			          		
			          		$this->$className  = new $className();
			          	}
			          	
			          }else{
			          	
			          	sysfunc::show_error(array('title'=>'error', 'message'=>"class {$className} is already exist "));
			          }
			          
			      }
			      
			}
		}
		/**
		 * 实例化类   参数不确定的
		 * 
		 * @param string $className 类名称
		 * @param array $arguments  参数数组
		 */
		private function newInst($className ,$arguments ){
			
			    
   				
    			$class = new ReflectionClass( $className );
    			
                return $class->newInstanceArgs( $arguments );
			
			
		}
		/**
		 * 通过反射的方法获取实例对象中 某个函数的参数个数
		 * 
		 * @param object $obj  对象实例
		 * @param  string  $funcName 对象内方法名称
		 */
	    private function getNumbers( $obj ,$funcName) {
	    
			    
			    $func = new  ReflectionMethod($obj , $funcName);
			    
			    return count( $func->getParameters() );
			    
			} 
			
		/**
		 * 运行用户请求页面
		 * Enter description here ...
		 * @param string $className
		 * @param string $func
		 * @param array $var
		 */	
		public function run($className ,$func ,$var){
			
			if ( ! method_exists($this->$className, $func)){
				
				    show_error(array('title'=>'function error', 'message'=>"function {$func} is not exist"));
				    
				}
				
			call_user_func_array(
								    # 调用内部function
								    array($this->$className,$func), 
								    # 传递参数
								    $var
								);
			
		}
	
	
}