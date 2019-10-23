<?php
	session_start();
	$user = $_SESSION['user_name'];
	session_destroy();
	session_start();
	
	$_SESSION['msg'] = "<div class='success'>".$user." successfully logged out</div>";
	header("Location:index.php");
?>