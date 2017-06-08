<?php
	session_start();

	if(isset($_SESSION['user_name'])){
		include_once("head_loggedin.html");
	}
	else{
		include_once("head_loggedout.html");
	}

	if(isset($_SESSION['user_name'])){
		$username=$_SESSION['user_name'];
		$conn = mysqli_connect('localhost','root','');
	
		if(!$conn){
			die("Unable to connect to database server: ".mysqli_connect_error($conn));
		}
		
		if(!mysqli_select_db($conn,'ecommerce')){
			die("Failed to select Database: ".mysqli_error($conn));
		}
		
		$sql="select * from product where id in (select p_id from cart where username='$username')";
		
		$result = mysqli_query($conn,$sql);
		
		echo"<html><body>";
			while($row=mysqli_fetch_assoc($result)){
				echo"<div style='width:300px; height:300px;'>";
				echo"<img src='images/".$row["image"]."' width='150' height='250'> <br>";
//				echo"<input type='hidden' name='pid' value='".$row["id"] ."'>";
				echo "<a href='desc.php?id=".$row["id"]."'>".$row["product_name"]."</a>";
				echo"<span style='float:right'><a href='remove_from_cart.php?pid=".$row["id"]."'>Remove</a>";
				echo"</span>";
				echo"</div>";
			}
		echo"</body></html>";
	}
	else{
		echo "<center><div style='background-color:pink'>First Login</div></center><br><br>";
		include_once("user_login.html");		
	}
?>