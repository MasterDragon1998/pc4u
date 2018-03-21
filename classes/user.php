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

	public function sync($conn){
		$result = $conn->query("SELECT * FROM user WHERE id = '$this->id'");
		if($result){
			$row = $result->fetch_assoc();
			$this->username = $row["gebruikersnaam"];
			$this->email = $row["email"];
			$this->first_name = $row["voornaam"];
			$this->last_name = $row["achternaam"];
			return true;
		}else{
			echo $conn->error;
			return false;
		}
	}
	public function update($conn){
		$result = $conn->query("UPDATE user SET gebruikersnaam = '$this->username', voornaam = '$this->first_name', achternaam = '$this->last_name', email = '$this->email' WHERE id = '$this->id'");
		if($result){
			return true;
		}else{
			echo $conn->error;
			return false;
		}
	}
}

function getUserById($conn,$id){
	$id = $conn->real_escape_string($id);
	$result = $conn->query("SELECT * FROM user WHERE id = '$id'");
	if($result){
		$row = $result->fetch_assoc();
		return new User($row["id"],$row["gebruikersnaam"],$row["wachtwoord"],$row["email"],$row["voornaam"],$row["achternaam"]);
	}else{
		return false;
	}
}

function getUserByUsername($conn,$username){
	$username = $conn->real_escape_string($username);
	$result = $conn->query("SELECT * FROM user WHERE gebruikersnaam = '$username'");
	if($result){
		$row = $result->fetch_assoc();
		return new User($row["id"],$row["gebruikersnaam"],$row["wachtwoord"],$row["email"],$row["voornaam"],$row["achternaam"]);
	}else{
		return false;
	}
}

?>