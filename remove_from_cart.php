<?php
	session_start();
	
	if(isset($_SESSION['user_name'])){
		$username=$_SESSION['user_name'];
		$pid=$_REQUEST['pid'];
		$conn = mysqli_connect('localhost','root','');
		
		if(!$conn){
			die("Unable to connect to database server: ".mysqli_connect_error($conn));
		}
		
		if(!mysqli_select_db($conn,'ecommerce')){
			die("Failed to select Database: ".mysqli_error($conn));
		}
		echo $pid."<br>".$username;
		$sql="delete from cart where p_id='$pid' and username='$username'";		
		if(!mysqli_query($conn,$sql)){
			die("Faild to remove product from cart");
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