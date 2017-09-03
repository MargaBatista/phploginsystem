<?php

session_start();
//user is logged out from the system and redirect to the login page
if(session_destroy())
{
header("Location: login.php");
}
?>