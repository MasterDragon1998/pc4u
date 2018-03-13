<?php

Class User{
	public $id;
	public $username;
	public $email;
	public $first_name;
	public $last_name;
	private $password;

	public function __construct($id,$username,$password,$email,$first_name,$last_name){
		$this->id = $id;
		$this->username = $username;
		$this->email = $email;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->password = $password;
	}
}

?>