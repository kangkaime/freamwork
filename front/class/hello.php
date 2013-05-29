<?php
class hello{
	
	public $name = '';
	public function __construct($name = ''){
		
		$this->name = $name;
		
	}
	public function say( $name = ''){
		
		if( $name )
			echo 'my name is'.$name.' hhah';
	    else
	        echo 'hello stranger!';
	    
	}
	public function index(){
		
		
		echo 'hello world';
	}
}