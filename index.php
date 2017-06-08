<?php
	session_start();
	if(isset($_SESSION['user_name'])){
		include_once("head_loggedin.html");
	}
	else{
		include_once("head_loggedout.html");
	}
	$conn = mysqli_connect('localhost','root','');
	
	if(!$conn){
		die("Unable to connect to database server: ".mysqli_connect_error($conn));
	}
	
	if(!mysqli_select_db($conn,'ecommerce')){
		die("Failed to select Database: ".mysqli_error($conn));
	}
	
	$sql = "select id,image,product_name from product;";
	
	$result = mysqli_query($conn,$sql);
	$row_count = mysqli_num_rows($result);
	
	$num_rows = $row_count / 4;
	$x=0;
	echo "<html><body>";
	echo"<table align=center>";
	
		for($i=1;$i<=$num_rows;$i++){
			echo"<tr>";
				for($j=1;$j<=4;$j++){
					++$x;
					mysqli_data_seek($result,$x);
					$row=mysqli_fetch_assoc($result);
					echo"<td><div style='width:300px; height:300px; float:left'>";
						echo"<img src='images/".$row["image"]."' width='150' height='250'> <br>";
						echo "<a href='desc.php?id=".$row["id"]."'>".$row["product_name"]."</a>";
					echo"</div></td>";
				}
			echo"</tr>";
		}
	
	echo"</table>";
	echo"</body></html>";
?>