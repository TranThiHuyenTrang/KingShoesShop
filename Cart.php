<?php
	require "database.php";
	require "model/User.php";
	require "model/SportShoe.php";
	require "model/Sandal.php";

	if(isset($_POST["update"])){
		$de = $_POST["update"];
		$sql = "UPDATE SanPham SET quantity=".$price." WHERE id=".$de;
		$db->query($sql);
		echo '<script language="javascript">alert("Đã chinh sua");</script>';
	}
	if(isset($_POST["delete"])){
		$de = $_POST["delete"];
		$sql = "DELETE from Cart where id = ".$de;
		$db->query($sql);
		echo '<script language="javascript">alert("Đã xóa");</script>';
	}
	if(isset($_POST["deleteAll"])){
		$sql = "DELETE * from Cart";
		$db->query($sql);
		echo $sql;
		echo '<script language="javascript">alert("Ban da thanh toan thanh cong");</script>';
	}
?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="sty1.css">
	<style type="text/css">
		img{
			width: 100px;
			height: 100px;
		}
		th{
			margin-top:  20px ;
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
		.sp{
			display: flex;
			justify-content: space-between;
			width: 800px;
			margin-left: 400px;
		}
	</style>
</head>
<body>
	<div class="topnav">
	  	<a class="active" href="Userdisplay.php">Home</a>
	  	<a href="Cart.php">View card</a>
	  	<a href="index.php">Logout</a>
	</div>
	<h1>Shoppy Card</h1>
<center>
<table class="table table-bordered" style="text-align: center; width: 500px; margin-top: 40px;">
    <thead style="background-color: lightblue">
        <tr>
          	<th>ID</th>
          	<th>Image</th>
          	<th>Name</th>
          	<th>Price</th>
          	<th>Quantity</th>
         	<th>Total</th>
         	<th>Edit</th>
         	<th>Delete</th>
        </tr>
    </thead>
       <?php
			$sql = "SELECT * FROM Cart";

			$result = mysqli_query($db,$sql);
			if(!$result){
				echo $sql;
				die('error');
			}else {
				while ($row = mysqli_fetch_assoc($result)) {
		?>
    <tbody>
        <tr>
          	<td><h4><?php echo $row['id']; ?></h4></td>
          	<td><img src="<?php echo $row['image']; ?> " ></td>
         	<td><span><?php echo $row['proName']; ?></span></td>
         	<td><h4> <?php echo $row['price']; ?>VND</h4></td>
         	<td><h4><?php echo $row['quantity']; ?></h4></td>
         	<td><span><h4><?php echo $row['total']?></h4></span></td>
          	<td>
	          	<form action="#" method="post">
					<button class="order" name="update" value="<?php echo $row['id'] ?> ">Edit</button>	
				</form>	
			</td>
          	<td>
          		<form action="#" method="post">
					<button class="order" name="delete" value="<?php echo $row['id'] ?>">Delete</button>	
				</form>
			</td>
       	</tr>
    </tbody><?php }}?>
    	<form  action="#" method="post">
    		<button class="item-shoe-edit" name="deleteAll">Pay now</button>
    	</form>
    	
</table>
  
</center>
</script>
</body>
</html>