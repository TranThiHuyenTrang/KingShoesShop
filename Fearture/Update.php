<?php
require "../Database/database.php";
if (isset($_FILES["fileToUpload"])) {
	$name = $_POST["ten"];
	$price = $_POST["price"];
	$color = $_POST["color"];
	$type = $_POST["type"];
	$target_dir = "../Img/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if (isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if ($check !== false) {
			$uploadOk = 1;
			// added by me
			$anh = $_FILES["fileToUpload"]["name"];
			$sql1 = "UPDATE SanPham SET name='" . $name . "', price=" . $price . ", color='" . $color . "', type='" . $type . "', image='" . "../Img/" . $anh . "' WHERE id=" . $_GET['id'];
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
	<title>Update</title>
	<link rel="stylesheet" type="text/css" href="../Css/sty1.css">
	<style type="text/css">
		a {
			text-decoration: none;
			color: white;
		}
	</style>
</head>

<body style=" background-image: url('picture/back.jpg');">
	<center>
		<div class="text">
			<p><b>UPDATE PRODUCT's INFORMATION</b></p>
			<form action="#" method="post" enctype="multipart/form-data">
				<input class="inputtext" type="text" placeholder="name" name="ten"><br>
				<input class="inputtext" type="text" placeholder="price" name="price"><br>
				<input class="inputtext" type="text" placeholder="color" name="color"><br>
				<input class="inputtext" type="text" placeholder="type" name="type"><br>
				<p><input type="file" name="fileToUpload" id="fileToUpload"></p>
				<input class="but" type="submit" value="UPDATE" name="submit">
				<button class="but"><a href="../View/Admin.php">BACK</a></button>
			</form>
		</div>
	</center>
	</form>

</body>

</html>