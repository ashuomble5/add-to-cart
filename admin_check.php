<?php
	$username=$_REQUEST['adnuname'];
	$password=$_REQUEST['adnpwd'];

	$conn = mysqli_connect('localhost','root','');
	
	if(!$conn){
		die("Unable to connect to database server: ".mysqli_connect_error($conn));
	}
	
	if(!mysqli_select_db($conn,'ecommerce')){
		die("Failed to select Database: ".mysqli_error($conn));
	}
	
	$sql = "select * from admin where username='$username' and password='$password';";
	
	$result = mysqli_query($conn,$sql);
	$num_rec = mysqli_num_rows($result);
	
	if($num_rec > 0){
		header("Location:admin_panel.html");
	}
	else{
		echo "<center><div style='background-color:pink'>Invalid Username or Password</div></center><br><br>";
		include_once("admin_login.html");
	}
?>