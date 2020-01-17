<?php
require "../Database/database.php";
require "../Model/User.php";
require "../Model/SportShoe.php";
require "../Model/Sandal.php";
if (isset($_POST["order"])) {
	$id = $_POST["order"];
	echo $id;
	$sql = "SELECT name,price,color,type,image FROM SanPham WHERE id = " . $id;
	$result = mysqli_query($db, $sql);
	if (!$result) {
		echo $sql;
		die('error');
	} else {
		while ($row = mysqli_fetch_assoc($result)) {
			$name = $row['name'];
			$price = $row['price'];
			$color = $row['color'];
			$type = $row['type'];
			$img = $row['image'];
			$quantity = 1;
			$total = $price * $quantity = 1;
			$db->query($sql);
			$sql1 = "INSERT INTO Cart(image,proName,price,quantity,total)VALUES (" . "'" . $img . "'" . "," . "'" . $name . "'" . "," . $price . "," . $quantity . "," . $total . ")";
			echo '<script language="javascript">alert("Order");</script>';
			$db->query($sql1);
			header("Location: ../Fearture/Cart.php");
		}
	}
}

$sql = "SELECT * from SanPham";
$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);
$shoes = array();
for ($i = 0; $i < count($result); $i++) {
	$shoe = $result[$i];
	if ($shoe['type'] == 'sport') {
		array_push($shoes, new SportShoe($shoe['id'], $shoe['name'], $shoe['price'], $shoe['color'], $shoe['image']));
	}
	if ($shoe['type'] == 'sandal') {
		array_push($shoes, new Sandal($shoe['id'], $shoe['name'], $shoe['price'], $shoe['color'], $shoe['image']));
	}
}
if (isset($_POST["search"])) {
	$show = $_POST["tim"];
	$sql = "SELECT * FROM SanPham WHERE name = '" . $show . "'";
	$result = mysqli_query($db, $sql);
	
?>
	<!DOCTYPE html>
	<html>

	<head>
		<title>Search</title>
		<link rel="stylesheet" type="text/css" href="../Css/sty1.css">
		<style type="text/css">
			.de {
				display: flex;
				justify-content: space-between;
				margin-left: 20px;
				width: 240px;
			}

			.topnav {
				overflow: hidden;
				background-color: #e9e9e9;
			}

			.topnav a {
				float: left;
				display: block;
				color: black;
				text-align: center;
				padding: 14px 16px;
				text-decoration: none;
				font-size: 17px;
			}

			.topnav a:hover {
				background-color: #ddd;
				color: black;
			}
		</style>
	</head>

	<body>
		<div class="topnav">
			<a class="active" href="../Fearture/Userdisplay.php">Home</a>
			<a href="../Fearture/Cart.php">View cart</a>
			<a href="../View/index.php">Logout</a>
		</div>
		<h1>LIST'S PRODUCT</h1>
		<div class="shoe-container">
			<?php
			for ($i = 0; $i < count($shoes); $i++) {
				if ($shoes[$i]->name == $show) { ?>
					<div class="pro" style="margin-left: 30px;">
						<img class="item-shoe-icon" src=<?php echo $shoes[$i]->getImagePath(); ?>>
						<h3 class="item-shoe-name"><?php echo $shoes[$i]->name ?></h3>
						<h3 class="item-shoe-type"><?php echo $shoes[$i]->getType() . "," . $shoes[$i]->color ?></h3>
						<h3 class="item-shoe-price"><?php echo $shoes[$i]->getDisplayPrice() ?></h3>
						<div class="de">
							<form action="../Fearture/Detail.php" method="post">
								<button name="Detail"value="<?php echo $shoes[$i]->id ?>"class="item-shoe-edit">Detail</button>
							</form>
							<form action="#" method="post">
								<button class="order" name="order" value="<?php echo $shoes[$i]->id ?>">Order</button>
							</form>
						</div>
					</div>
		<?php }
			}
		} ?>
		</div>
		<?php require "../View/Footer.php"; ?>
	</body>

	</html>