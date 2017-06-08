<?php
	session_start();
	if(isset($_SESSION['user_name'])){
		include_once("head_loggedin.html");
	}
	else{
		include_once("head_loggedout.html");
	}

	$pid = $_REQUEST['id'];

	$conn = mysqli_connect('localhost','root','');	
	if(!$conn){
		die("Unable to connect to database server: ".mysqli_connect_error($conn));
	}	
	if(!mysqli_select_db($conn,'ecommerce')){
		die("Failed to select Database: ".mysqli_error($conn));
	}
	
	$sql = "select * from product where id=$pid;";
	
	$result = mysqli_query($conn,$sql);
	
	$row = mysqli_fetch_assoc($result);
	
	echo"<html><body>";
		echo "<form action='add_to_cart.php' method='POST'>";
		echo"<div style='width:400px; height:500px; float:left; padding-top:40px; padding-left:20px'>";
		echo"<img src='images/".$row["image"]."' width='250' height='450'></div>";
		echo"<div style='padding-top:40px; font-size:30'>";
		echo $row["product_name"]."<br><br>";
		echo $row["description"]."<br><br>";
		echo "Brand: ".$row["brand_type"]."<br><br>";
		echo "Price: ".$row["cost"]."<br><br>";
		echo "<input type='hidden' value='".$row["id"]."' name='pid'><br><br>";
		echo "<input type='submit' value='Add To Cart'>";
		echo "</div>";
		echo "</form>";
		echo"</body></html>";
?>