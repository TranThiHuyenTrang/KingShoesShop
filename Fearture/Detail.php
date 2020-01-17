<?php
require "../Database/database.php";
require "../Model/User.php";
require "../Model/SportShoe.php";
require "../Model/Sandal.php";
?>
<!DOCTYPE html>
<html>

<head>
	<title>PRODUCT'S DETAIL</title>
	<link rel="stylesheet" type="text/css" href="../Css/sty1.css">
	<link rel="stylesheet" type="text/css" href="../Css/style.css">
	<style type="text/css">
		.sp {
			display: flex;
			justify-content: space-between;
			width: 800px;
			margin-left: 400px;
		}

		img {
			width: 300px;
			height: 300px;
		}
	</style>
</head>

<body>
	<div class="topnav">
		<a class="active" href="../View/Userdisplay.php">Home</a>
		<a href="../Fearture/Cart.php">View cart</a>
		<a href="../View/index.php">Logout</a>
	</div>
	<center>
		<h1>PRODUCT'S DETAIL</h1>
	</center>
	<div class="shoe-container">
		<?php
		if (isset($_POST["Detail"])){
			$id = $_POST["Detail"];
			$sql = "SELECT * FROM SanPham WHERE id = ".$id;
			$result = mysqli_query($db, $sql);
			if ($result == false) {
				echo $sql;
				// die('error');
			} else {
				while ($row = mysqli_fetch_assoc($result)) {
			?>
					<div class="sp">
						<img src="<?php echo $row['image']; ?>">
						<div>
							<h3 style="color: red">
								<span><?php echo $row['name']; ?></span><br>
							</h3>
							<h4>TYPE : <?php echo $row['type']; ?></h4>
							<h4>COLOR : <?php echo $row['color']; ?></h4>
							<p>
								<span>
									<h4>PRICE : <?php echo $row['price']; ?>VND</h4>
								</span>
							</p>
						</div>
					</div>
			<?php
				}
			}
		} ?>
	</div>
</body>
<?php require "../View/Footer.php"; ?>

</html>