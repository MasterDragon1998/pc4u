<?php

require("scripts/connect.php");
require("scripts/spl_autoload.php");

$usermanager = new UserManager($connect);

if(!$usermanager->isLogedin){
	header("location:index.php");
}
if(isset($_GET["updateUser"])&&isset($_GET["userid"])){
	if($usermanager->user->id!=$_GET["userid"]){
		$cuser = getUserById($connect,$_GET["userid"]);
		header("location:user.php?username=$cuser->username");
		return false;
	}

	$cuser = getUserById($connect,$_GET["userid"]);
	$cuser->username = $_POST["username"];
	$cuser->email = $_POST["email"];
	$cuser->first_name = $_POST["first_name"];
	$cuser->last_name = $_POST["last_name"];
	if($cuser->update($connect)){
		header("location:user.php?username=".$_POST["username"]);
	}
}

$user = getUserByUsername($connect,$_GET["username"]);

if($usermanager->user->id==$user->id){
	$changeAuth = true;
}else{
	$changeAuth = false;
}

?>
<!DOCTYPE html>
<html>
	<head>
		<title>PC4U</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
	</head>
	<body>

		<?php include("include/topbar.php"); ?>

		<div class="userpanel">
			<h1>Username: <?php echo $user->username; ?></h1>
			<h2>Profile Data</h2>
			<form action="user.php?updateUser=true&userid=<?php echo $user->id; ?>" method="POST">
				<table border="1" class="userinfoTable">
					<tr>
						<td>Username</td>
						<td><?php if($changeAuth){ ?>
							<input type="text" name="username" value="<?php echo $user->username; ?>">
							<?php }else{ echo $user->username; } ?>
						</td>
					</tr>
					<tr>
						<td>E-Mail</td>
						<td>
							<?php if($changeAuth){ ?>
							<input type="text" name="email" value="<?php echo $user->email; ?>">
							<?php }else{ echo $user->email; } ?>
						</td>
					</tr>
					<tr>
						<td>Voornaam</td>
						<td>
							<?php if($changeAuth){ ?>
							<input type="text" name="first_name" value="<?php echo $user->first_name; ?>">
							<?php }else{ echo $user->first_name; } ?>
						</td>
					</tr>
					<tr>
						<td>Achternaam</td>
						<td>
							<?php if($changeAuth){ ?>
							<input type="text" name="last_name" value="<?php echo $user->last_name; ?>">
							<?php }else{ echo $user->last_name; } ?>
						</td>
					</tr>
				</table>
				<?php if($changeAuth){ ?><button style="width:100%;" type="submit">Save Changes</button><?php } ?>
			</form>
		</div>

	</body>
</html>