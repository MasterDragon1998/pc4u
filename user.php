<?php

require("scripts/connect.php");
require("scripts/spl_autoload.php");

$usermanager = new UserManager($connect);

if(!$usermanager->isLogedin){
	header("location:../home");
}
print_r($_GET);

?>
<!DOCTYPE html>
<html>
	<head>
		<title>PC4U</title>
	</head>
	<body>

	</body>
</html>