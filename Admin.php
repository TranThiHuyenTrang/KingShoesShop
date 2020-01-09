<?php
	require "database.php";
	require "model/User.php";
	require "model/SportShoe.php";
	require "model/Sandal.php";
	session_start();

	if(isset($_POST["delete"])){
		$de = $_POST["delete"];
		$sql = "DELETE from SanPham where id = ".$de;
		$db->query($sql);
		echo '<script language="javascript">alert("Đã xóa");</script>';
	}
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
?>

<!DOCTYPE html>
<html>
<head>
	<title>My Shoe</title>
	<link rel="stylesheet" type="text/css" href="sty1.css">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<script type="text/javascript">
	var slide = ["img/hive.jpg","img/sandal-x.jpg","logo.jpg"];
       var position = 0;
        setInterval(function(){document.getElementById('myId').src= slide[position++];
      if (position==3)
      {
        position=0;
      }
      },3000);
        function them(){

        }
</script>
<body>
	<div class="topnav">
	  	<a class="active" href="Admin.php">Home</a>
	  	<a href="add.php">Add product</a>
	  	<a href="index.php">Logout</a>
	</div>
	<div style="margin-top: 30px;display: flex;justify-content: space-between;margin-left: 150px;" id="slide">
      <div>
        <img src="logo.jpg" width="300" height="350">
      </div>
      <div style="margin-right: 150px;">
          <img  id="myId" src="img/fine.jpg" width="600" height="350">
      </div>
 	 </div>
	<div id ="product">
	<p><h1>LIST'S PRODUCTS</h1></p>
</div>
	<div class="shoe-container">
		<?php 
			for($i = 0; $i < count($shoes); $i++){
		?>
			<div class="pro" style="margin-left: 30px;">
				<img class="item-shoe-icon"src=<?php echo $shoes[$i]->getImagePath(); ?>>
				<h3 class="item-shoe-name"><?php echo $shoes[$i]->name ?></h3>
				<h3 class="item-shoe-type"><?php echo $shoes[$i]->getType().",".$shoes[$i]->color ?></h3>
				<h3 class="item-shoe-price"><?php echo $shoes[$i]->getDisplayPrice() ?></h3>
				<div class="de">
					<form action="Update.php" method="post">
						<button class="item-shoe-edit"><a href="Update.php?id=<?php echo $shoes[$i]->id ?>" >Edit</a></button>
					</form>	
					<form action="#" method="post">
						<button class="order" name="delete" value="<?php echo $shoes[$i]->id ?>">Delete</button>	
					</form>
				</div>		
			</div>			
		<?php
			}
		?>	
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
