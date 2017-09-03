<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<link href="flow1.css" rel="stylesheet" type="text/css">
<title>Untitled Document</title>
</head>

<body>

<?php

if(!empty(filter_input(INPUT_POST, 'submit'))) {
	
	require_once('db_con.php');
	
	$un = filter_input(INPUT_POST, 'un') 
		or die('Missing/illegal name parameter');
	$pw = filter_input(INPUT_POST, 'pw') 
		or die('Missing/illegal password parameter');

	// hash and salt the password
	$pw = password_hash($pw, PASSWORD_DEFAULT); 
	
//	echo 'Creating user: '.$un.' => '.$pw;
	
	$sql = 'INSERT INTO users (username, pwhash) VALUES (?,?)';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('ss', $un, $pw);
	$stmt->execute();


	if ($stmt->affected_rows >0){
		header("location: loggedin.php");
		echo 'user ['.$un.'] is added :-)';
		echo ("<script>location.href = 'loggedin.php'; </script>");
	}
	else {
		echo 'Error adding user ['.$un.'] does this user already exist?';
	}
}
?>

<p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Add new user</legend>
    	<input name="un" type="text" placeholder="Username" required /><br>
    	<input name="pw" type="password" placeholder="Password"  required/><br>
    	<input type="submit" name="submit" value="Create user" />
	</fieldset>
</form>
</p>



</body>
</html>