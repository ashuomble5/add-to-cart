<?php
	session_start();

	if(isset($_SESSION['user_name'])){
		include_once("head_loggedin.html");
	}
	else{
		include_once("head_loggedout.html");
	}

	
	if(isset($_SESSION['user_name'])){
		$pid = $_REQUEST['pid'];
		$username=$_SESSION['user_name'];
		$conn = mysqli_connect('localhost','root','');
	
		if(!$conn){
			die("Unable to connect to database server: ".mysqli_connect_error($conn));
		}
		
		if(!mysqli_select_db($conn,'ecommerce')){
			die("Failed to select Database: ".mysqli_error($conn));
		}
		
		$sql = "insert into cart(p_id,username) values($pid,'$username');";
		
		if(!mysqli_query($conn,$sql)){
			die("Failed to select Database: ".mysqli_error($conn));
		}
		else{
			header("location:cart_disp.php");
		}
	}
	else{
		echo "<center><div style='background-color:pink'>First Login</div></center><br><br>";
		include_once("user_login.html");
	}
?>