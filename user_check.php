<?php
	$username=$_REQUEST['usrname'];
	$password=$_REQUEST['usrpwd'];

	$conn = mysqli_connect('localhost','root','');
	
	if(!$conn){
		die("Unable to connect to database server: ".mysqli_connect_error($conn));
	}
	
	if(!mysqli_select_db($conn,'ecommerce')){
		die("Failed to select Database: ".mysqli_error($conn));
	}
	
	$sql = "select * from userlogin where username='$username' and password='$password';";
	
	$result = mysqli_query($conn,$sql);
	$num_rec = mysqli_num_rows($result);
	
	if($num_rec > 0){
		session_start();
		$_SESSION['user_status']='loggedin';
		$_SESSION['user_name'] = $username;
		header("location:index.php");		
	}
	else{
		echo "<center><div style='background-color:pink'>Invalid Username or Password</div></center><br><br>";
		include_once("user_login.html");
	}
?>