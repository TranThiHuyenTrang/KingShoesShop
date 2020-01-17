<?php
require "../Database/database.php";
if (isset($_FILES["fileToUpload"])) {
	// $id=$_POST["id"];
	$name = $_POST["ten"];
	$price = $_POST["price"];
	$color = $_POST["color"];
	$type = $_POST["type"];
	$target_dir = "Img/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if ($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
			// added by me
			$anh = $_FILES["fileToUpload"]["name"];
			$sql1 = "INSERT INTO `SanPham`(`name`, `price`, `color`, `type`, `image`) VALUES (" . "'" . $name . "'" . "," . $price . "," . "'" . $color . "'" . "," . "'" . $type . "'" . "," . "'" . "../Img/" . $anh . "'" . ")";
			$db->query($sql1);
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
	<title>Add Product</title>

	<style type="text/css">
		a {
			text-decoration: none;
			color: white;
		}

		.inputtext {
			margin-top: 10px;
			width: 400px;
			height: 40px;
			border: 2px solid red;
			border-radius: 2px;
		}

		.text {
			margin-top: 60px;
			border-radius: 10px;
			border: 8px solid lightgrey;
			width: 500px;
			height: 440px;
		}

		.but {
			border-radius: 2px;
			border: 2px solid brown;
			background: brown;
			width: 100px;
			height: 30px;
			color: white;
		}
	</style>
</head>

<body>
	<center>
		<div class="text">
			<p><b>ENTER PRODUCT's INFORMATION</b></p>
			<form action="#" method="post" enctype="multipart/form-data">
				<!-- <input class="inputtext" type="text" placeholder="id" name="id"><br> -->
				<input class="inputtext" type="text" placeholder="Name" name="ten"><br>
				<input class="inputtext" type="text" placeholder="Price" name="price"><br>
				<input class="inputtext" type="text" placeholder="Color" name="color"><br>
				<input class="inputtext" type="text" placeholder="Type only Sport or Sandal" name="type"><br>
				<p><input type="file" name="fileToUpload" id="fileToUpload"></p>
				<input class="but" type="submit" value="INSERT" name="submit">
				<button class="but"><a href="../View/Admin.php">BACK</a></button>
			</form>
		</div>
	</center>
</body>

</html>