<?php

require("scripts/spl_autoload.php");

Class UserManager{
	private $db_connection;
	private $usercookiename = "uic";
	private $salt_before = "rnd";
	private $salt_after = "amd";
	public $isLogedin = false;
	public $user = null;

	public function __construct($conn){
		$this->db_connection = $conn;
		$this->startSession();
		if(isset($_SESSION["user"])){
			$this->isLogedin = true;
			$this->user = unserialize($_SESSION["user"]);
			$this->user->sync($conn);
		}
		$this->checkHeaders();
	}
	public function login($username,$password){
		$username = $this->db_connection->real_escape_string($username);
		$password = $this->db_connection->real_escape_string($password);

		$result = $this->db_connection->query("SELECT * FROM `user` WHERE gebruikersnaam = '$username'");
		if($result){
			$row = $result->fetch_assoc();
			if(PASSWORD_VERIFY($this->salt_before.$password.$this->salt_after,$row["wachtwoord"])){
				$this->startSession();
				$user = new User($row["id"],$row["gebruikersnaam"],$row["wachtwoord"],$row["email"],$row["voornaam"],$row["achternaam"]);
				$_SESSION["user"] = serialize($user);
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}
	public function register($username,$first_name,$last_name,$email,$password,$passwordconfirm = null){
		if($passwordconfirm!=null){
			if($password!=$passwordconfirm){
				return false;
			}
		}
		$username = $this->db_connection->real_escape_string($username);
		$first_name = $this->db_connection->real_escape_string($first_name);
		$last_name = $this->db_connection->real_escape_string($last_name);
		$email = $this->db_connection->real_escape_string($email);
		$normalpassword = $password;
		$password = PASSWORD_HASH($this->salt_before.$password.$this->salt_after,PASSWORD_DEFAULT);
		
		$result = $this->db_connection->query("SELECT * FROM `user` WHERE gebruikersnaam = '$username'");
		if($result->num_rows==0){
			$result = $this->db_connection->query("INSERT INTO `user` (gebruikersnaam,voornaam,achternaam,email,wachtwoord) VALUES ('$username','$first_name','$last_name','$email','$password')");
		}else{
			return false;
		}
		if($result){
			$this->login($username,$normalpassword);
			return true;
		}else{
			return false;
		}
	}
	public function logout(){
		$this->user = null;
		$this->startSession();
		unset($_SESSION["user"]);
		$this->isLogedin = false;
		return true;
	}

	private function startSession(){
		SESSION_NAME($this->usercookiename);
		if(session_id()==null){
			SESSION_START();
		}
	}
	private function checkHeaders(){
		if(isset($_POST["login"])){
			if($this->login($_POST["username"],$_POST["password"])){
				echo "Loged in succesfully";
				header("location:index.php");
			}else{
				echo "Login Failed";
			}
		}

		if(isset($_POST["register"])){
			if($_POST["passwordConfirm"]!=null){
				if($this->register($_POST["username"],$_POST["first_name"],$_POST["last_name"],$_POST["email"],$_POST["password"],$_POST["passwordConfirm"])){
					echo "registered";
					header("location:index.php");
				}else{
					echo "Registration failed";
				}
			}else{
				echo "fill in password confirmation";
			}
		}

		if(isset($_POST["logout"])){
			if($this->logout()){
				header("location:index.php");
			}
		}
	}
}

?>