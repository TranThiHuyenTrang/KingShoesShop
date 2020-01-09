<?php
	require "database.php";
	require "model/User.php";
	require "model/SportShoe.php";
	require "model/Sandal.php";

	$sql = "SELECT * from SanPham";
	$result = $db->query($sql)->fetch_all(MYSQLI_ASSOC);
	$shoes = array();
	for($i = 0; $i < count($result); $i++) {
		$shoe = $result[$i];
		if($shoe['type'] == 'sport'){
			array_push($shoes, new SportShoe($shoe['id'], $shoe['name'], $shoe['price'], $shoe['color'], $shoe['image']));
		}
		if($shoe['type'] == 'sandal'){
			array_push($shoes, new Sandal($shoe['id'], $shoe['name'], $shoe['price'], $shoe['color'], $shoe['image']));
		}
	}
	if(isset($_POST["search"])){
		$show= $_POST["tim"];
		$sql = "SELECT * FROM SanPham WHERE name = '".$show."'";
		$result = mysqli_query($db,$sql);
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="sty1.css">
	<style type="text/css">
		.de{
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
	  	<a class="active" href="Userdisplay.php">Home</a>
	  	<a href="Cart.php">View cart</a>
	  	<a href="index.php">Logout</a>
	</div>
	<h1>LIST'S PRODUCT</h1>
	<div class="shoe-container">
		<?php 
			for($i = 0; $i < count($shoes); $i++){
				if($shoes[$i]->name==$show)
				{ ?>
			<div class="pro" style="margin-left: 30px;">
				<img class="item-shoe-icon"src=<?php echo $shoes[$i]->getImagePath(); ?>>
				<h3 class="item-shoe-name"><?php echo $shoes[$i]->name ?></h3>
				<h3 class="item-shoe-type"><?php echo $shoes[$i]->getType().",".$shoes[$i]->color ?></h3>
				<h3 class="item-shoe-price"><?php echo $shoes[$i]->getDisplayPrice() ?></h3>
				<div class="de">
					<form action="Detail.php" method="post">
						<button class="item-shoe-edit"><a href="Detail.php?id=<?php echo $shoes[$i]->id ?>" >Detail</a></button>
					</form>	
					<form action="#" method="post">
						<button class="order" name="order" value="<?php echo $shoes[$i]->id ?>">Order</button>	
					</form>
				</div> 
			</div>					
		<?php } } }?>
	</div>
	<div class="footer">
		<div>
			<h4>TRỤ SỞ CHÍNH</h4>
			<h4>101B/38 LÊ HỮU TRÁC, QUẬN SƠN TRÀ,TP ĐÀ NẴNG</h4>
			<h4>0314.333.452 - 0914.343.345</h4>
			<h4>Xem bản đồ</h4>
		</div>
		<div>
			<h4>TRỤ SỞ CHÍNH</h4>
			<h4>101B/38 LÊ HỮU TRÁC, QUẬN SƠN TRÀ,TP ĐÀ NẴNG</h4>
			<h4>0314.333.452 - 0914.343.345</h4>
			<h4>Xem bản đồ</h4>
		</div>
		<div>
			<h4>TRỤ SỞ CHÍNH</h4>
			<h4>101B/38 LÊ HỮU TRÁC, QUẬN SƠN TRÀ,TP ĐÀ NẴNG</h4>
			<h4>0314.333.452 - 0914.343.345</h4>
			<h4>Xem bản đồ</h4>
		</div>
	</div>
</body>
</html>
