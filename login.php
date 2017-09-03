<?php session_start(); ?>
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

	$sql = 'SELECT id, pwhash FROM users WHERE username=?';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('s', $un);
	$stmt->execute();
	$stmt->bind_result($uid, $pwhash);

	while ($stmt->fetch()) {} // fill result variables
	
	//user loggedin in the system
	if (password_verify($pw, $pwhash)){
		echo 'logged in as user '.$uid;
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