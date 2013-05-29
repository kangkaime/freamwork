<?php
class sys{
	
	public $name = '';
	
	public $age = '';
	
	public function __construct($name , $age ){
		
		$this->name = $name;
		
		$this->age = $age;
		
	}
	
	public function say(){
		
		echo "i am sys class</br>";
		echo "我叫".$this->name."</br>我".$this->age."岁了";
	}
}