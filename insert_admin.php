<?php
	$pname = $_REQUEST['pname'];
	$ptype = $_REQUEST['ptype'];
	$pbrand = $_REQUEST['pbrand'];
	$pdesc = $_REQUEST['pdesc'];
	$pcost = $_REQUEST['pcost'];	
	$pimage = $_FILES["pimage"]["name"];
	
	if((($_FILES["pimage"]["type"] == "image/gif")
	||($_FILES["pimage"]["type"] == "image/jpeg")
	||($_FILES["pimage"]["type"] == "image/pjpeg")))
	{
		if($_FILES["pimage"]["error"] > 0){
			echo"Insert a valid Image.";
			include_once("admin_panel.html");
			exit();
		}
		else{ //Insert record into database
			move_uploaded_file($_FILES["pimage"]["tmp_name"],"images/".$_FILES["pimage"]["name"]);

			$conn = mysqli_connect('localhost','root','');
			
			if(!$conn){
				die("Unable to connect to database server: ".mysqli_connect_error($conn));
			}
			
			if(!mysqli_select_db($conn,'ecommerce')){
				die("Failed to select Database: ".mysqli_error($conn));
			}
			
			$sql = "insert into product(product_name,product_type,brand_type,image,description,cost) values('$pname','$ptype','$pbrand','$pimage','$pdesc',$pcost);";
			
			if(!mysqli_query($conn,$sql)){
				echo "<center><div style='background-color:pink'>Failed to insert record</div></center><br><br>";
				include_once("admin_panel.html");
				exit();				
			}
			else{
				echo "<center><div style='background-color:yellow'>Product inserted</div></center><br><br>";
				include_once("admin_panel.html");
				exit();				
			}
			
		}
	}
	else{
		echo "<center><div style='background-color:pink'>Upload valid image file</div></center><br><br>";
			include_once("admin_panel.html");
			exit();
	}
?>