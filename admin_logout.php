<?php
	session_start();
	
	unset($_SESSION['user_status']);
	unset($_SESSION['user_name']);
	unset($_SESSION['admin_status']);
	unset($_SESSION['admin_name']);
	
	session_destroy();
	
	header("location:admin_login.html");
?>