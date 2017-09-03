<?php session_start(); ?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>secretinfo</title>
<link href="flow1.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php
	
	if (!empty($_SESSION['uid'])){
		echo 'Logged in as user '.$_SESSION['un'];
		echo '<br> Secret info here...';
		echo '<a class="logoutbutton" href="logout.php"> LOG OUT </a>';
	}
	else {
		echo 'Not logged in...';
	}
	
?>


</body>
</html>