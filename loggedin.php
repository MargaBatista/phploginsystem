<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
<link href="flow1.css" rel="stylesheet" type="text/css">
</head>

<body>

<?php

// Checking submission of the form, the user is already logged in
if(!empty(filter_input(INPUT_POST, 'submit'))) {

	//Connection with database, php login through mysql
	require_once('db_con.php');
	
	//Getting the external variables, username and password
	$un = filter_input(INPUT_POST, 'un') 
		or die('Missing/illegal name parameter');
	$pw = filter_input(INPUT_POST, 'pw') 
		or die('Missing/illegal password parameter');

	//MySQL check if username and password matches in database
	$sql = 'SELECT id, pwhash FROM users WHERE username=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $pwhash);

	while ($stmt->fetch()) {} // filling result variables
	
	//password validation
	if (password_verify($pw, $pwhash)){
		echo 'logged in as user '.$un;
		//user is ready to access the secret information
		$_SESSION['uid'] = $uid; header("location: secretinfo.php");
		$_SESSION['un'] = $un;
		//echo that redirects directly to the desired page
		echo ("<script>location.href = 'secretinfo.php'; </script>");
	}
	else {
		echo 'illegal username/password combination';
	}
}
?>

<p>
	<p> User successfully created!</p>
<form action="<?= $_SERVER['PHP_SELF'] ?>" method="post">
	<fieldset>
    	<legend>Login</legend>
    	<input name="un" type="text" placeholder="Username" required /><br>
    	<input name="pw" type="password" placeholder="Password"  required/><br>
    	<input type="submit" name="submit" value="Login" />
	</fieldset>
</form>
</p>

</body>
</html>