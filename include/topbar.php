<div class="topbar">
	<h1><a class="title" href="index.php">PC4U</a></h1>
	<?php if($usermanager->isLogedin){ ?>
	<h2 class="welcomeText">Welcome, <a class="welcomeName" href="user.php?username=<?php echo $usermanager->user->username; ?>"><?php echo $usermanager->user->first_name; ?> <?php echo $usermanager->user->last_name; ?></a></h2>
	<form action="" method="POST">
		<button class="logoutButton" type="submit" name="logout" value="true">Logout</button>
	</form>
	<?php } ?>
</div>