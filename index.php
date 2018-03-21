<?php

require("scripts/connect.php");
require("scripts/spl_autoload.php");

$usermanager = new UserManager($connect);

?>

<!DOCTYPE html>
<html>
	<head>
		<title>PC4U</title>
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script src="javascript/modal.js" type="text/javascript"></script>
	</head>
	<body id="body">

		<?php include("include/topbar.php"); ?>

		<?php if(!$usermanager->isLogedin){ ?>
		<div class="loginPanel">
			<form action="" method="POST">
				<table>
					<tbody>
						<tr>
							<td><label for="username">Username: </label></td>
							<td><input type="text" name="username" placeholder="USERNAME"></td>
						</tr>
						<tr>
							<td><label for="password">Password: </label></td>
							<td><input type="password" name="password" placeholder="PASSWORD"></td>
						</tr>
						<tr>
							<td colspan="2"><button type="submit" name="login" value="true">Login</button></td>
						</tr>
						<tr>
							<td colspan="2"><button type="button" onclick="modal.open('registerPanel');">Register</button></td>
						</tr>
					</tbody>
				</table>
			</form>
		</div>
		<?php } ?>

		<div id="modal">
			<div class="registerPanel">
				<form action="" method="POST">
					<table>
						<tr>
							<td><label for="username">Username:</label></td>
							<td><input type="text" name="username" placeholder="USERNAME"></td>
						</tr>
						<tr>
							<td><label for="first_name">Voornaam:</label></td>
							<td><input type="text" name="first_name" placeholder="VOORNAAM"></td>
						</tr>
						<tr>
							<td><label for="last_name">Achternaam:</label></td>
							<td><input type="text" name="last_name" placeholder="ACHTERNAAM"></td>
						</tr>
						<tr>
							<td><label for="email">E-Mail:</label></td>
							<td><input type="email" name="email" placeholder="E-MAIL"></td>
						</tr>
						<tr>
							<td><label for="password">Wachtwoord:</label></td>
							<td><input type="password" name="password" placeholder="WACHTWOORD"></td>
						</tr>
						<tr>
							<td><label for="passwordConfirm">Wachtwoord Bevestigen</label></td>
							<td><input type="password" name="passwordConfirm" placeholder="WACHTWOORD BEVESTIGEN"></td>
						</tr>
						<tr>
							<td colspan="2"><button type="submit" name="register" value="true">Regristreren</button></td>
						</tr>
					</table>
				</form>
			</div>
		</div>
	</body>
</html>