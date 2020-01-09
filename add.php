<?php
	require "database.php";	 	
	 	if (isset($_FILES["fileToUpload"])) {
	 		// $id=$_POST["id"];
        	$name=$_POST["ten"];
        	$price=$_POST["price"];
        	$color=$_POST["color"];
        	$type=$_POST["type"];
		    $target_dir = "img/";
		    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		    $uploadOk = 1;
		    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		    // Check if image file is a actual image or fake image
		    if(isset($_POST["submit"])) {
		        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		        if($check !== false){
		            echo "File is an image - " . $check["mime"] . ".";
		            $uploadOk = 1;
		            // added by me
		            $anh = $_FILES["fileToUpload"]["name"];
		            $sql1 = "INSERT INTO `SanPham`(`name`, `price`, `color`, `type`, `image`) VALUES ("."'".$name."'".",".$price.","."'".$color."'".","."'".$type."'".","."'"."img/".$anh."'".")";
		            $db->query($sql1);  
		            echo  $sql1;
		        } else {
		            echo "File is not an image.";
		            $uploadOk = 0;
		        }
			}
		}	
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="sty1.css">
	<style type="text/css">
		a{
			text-decoration: none;
			color: white;
		}
	</style>
</head>
<body style=" background-image: url('picture/back.jpg');">
	<center>
		<div class="text">
			<p><b>ENTER PRODUCT's INFORMATION</b></p>
			<form action="#" method="post" enctype="multipart/form-data">
			<!-- <input class="inputtext" type="text" placeholder="id" name="id"><br> -->
	        <input class="inputtext"type="text" placeholder="name" name="ten"><br>
	        <input class="inputtext"type="text" placeholder="price" name="price"><br>
	        <input class="inputtext"type="text" placeholder="color" name="color"><br>
	        <input class="inputtext"type="text" placeholder="type" name="type"><br>
		    <p><input type="file" name="fileToUpload" id="fileToUpload"></p>
		    <input class="but" type="submit" value="INSERT" name="submit">
	        <button class="but"><a href="Admin.php">BACK</a></button>
	    </form>
		</div>
	</center>
    </form>

</body>
</html>