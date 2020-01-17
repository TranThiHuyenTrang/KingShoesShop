<?php
require "../Database/database.php";
require "../Model/User.php";
require "../Model/SportShoe.php";
require "../Model/Sandal.php";

if (isset($_POST["deleteAll"])) {
	$sql = "DELETE * from Cart";
	$db->query($sql);
	echo '<script language="javascript">alert("Pay sucessfull");</script>';
}

if (isset($_POST["Pay"])) {
	$name = $_POST["name"];
	$address = $_POST["address"];
	$phone = $_POST['phone'];
	$sql1 = "INSERT INTO Customer(name, address, phone) VALUES (" . "'" . $name . "'" . "," . "'" . $address . "'" . "," . $phone . ")";
	$db->query($sql1);
	echo '<script language="javascript">alert("Pay sucessfull");</script>';
}
if (isset($_POST["edit"])) {
	$de = $_POST["quantity"];
	$id = $_POST['id'];
	echo $id;
	$price = $_POST['oldprice'] * $de;
	$sql = "UPDATE Cart SET quantity=" . $de . ",total=" . $price . " WHERE id=" . $id;
	echo $sql;
	$db->query($sql);
}
if (isset($_POST["delete"])) {
	$de = $_POST["delete"];
	$sql = "DELETE from Cart where id = " . $de;
	$db->query($sql);
}

?>

<!DOCTYPE html>
<html>

<head>
	<title>Shoppy Cart</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="../Css/sty1.css">
	<link rel="stylesheet" type="text/css" href="../Css/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<style type="text/css">
		img {
			width: 100px;
			height: 100px;
		}

		th {
			margin-top: 20px;
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

		.sp {
			display: flex;
			justify-content: space-between;
			width: 800px;
			margin-left: 400px;
		}
	</style>
</head>

<body>
	<div class="topnav">
		<a class="active" href="../View/Userdisplay.php">Home</a>
		<a href="../Fearture/Cart.php">View card</a>
		<a href="../View/index.php">Logout</a>
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

			$result = mysqli_query($db, $sql);
			if (!$result) {
				echo $sql;
				die('error');
			} else {
				while ($row = mysqli_fetch_assoc($result)) {
			?>
					<tbody>
						<tr>
							<td>
								<h4><?php echo $row['id']; ?></h4>
							</td>
							<td><img src="<?php echo $row['image']; ?> "></td>
							<td><span><?php echo $row['proName']; ?></span></td>
							<td>
								<h4> <?php echo $row['price']; ?>VND</h4>
							</td>
							<td>
								<h4><?php echo $row['quantity']; ?></h4>
							</td>
							<td><span>
									<h4><?php echo $row['total'] ?></h4>
								</span></td>
							<td>
								<button value="<?php echo $row['id'] ?>" name="edit" onclick="document.getElementById('id02').style.display='block'" class="order">Edit</button>
								<div id="id02" class="modal">
									<form class="modal-content animate" action="#" method="post">
										<div class="imgcontainer">
											<span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
										</div>
										<div class="container">
											<h1>Edit</h1>
											<label for="psw"><b>Enter quantity</b></label>
											<input class="inputtext" type="text" placeholder="Enter Quantity" name="quantity" required></br>
											
											<button name="edit" >Edit</button></br>
											<input type="hidden" name="id"value="<?php echo $row['id'] ?>">
											<input type="hidden" name="oldprice" value="<?php echo $row['price']; ?>">
										</div>
										<div class="container" style="background-color:#f1f1f1">
											<button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
										</div>
									</form>
								</div>

							</td>
							<td>
								<form action="#" method="post">
									<button class="order" name="delete" value="<?php echo $row['id'] ?>">Delete</button>
								</form>
							</td>
						</tr>
					</tbody><?php }
					} ?>

			<button class="item-shoe-edit" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Next</button>
			<div id="id01" class="modal" style="background-color: lightgrey;margin-left: 400px;width: 600px;height: 500px;margin-top: 60px">
				<form class="modal-content animate" action="#" method="post">
					<div class="imgcontainer">
						<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
					</div>
					<div>
						<h1>Enter your Information</h1>
						<label for="psw"><b>Enter your name (*)</b></label>
						<input style="width:300px" type="text" placeholder="Enter your name" name="name" required></br>
						<label for="psw"><b>Enter your address (*)</b></label>
						<input style="width:300px" type="text" placeholder="Enter your address" name="address" required></br>
						<label for="psw"><b>Enter your phone(*)</b></label>
						<input style="width:300px" type="text" placeholder="Enter your phone" name="phone" required></br>
						<button name="Pay">Pay now</button></br>
					</div>
				</form>
			</div>
		</table>
	</center>
	</script>
</body>

</html>
<script>
	var modal = document.getElementById('id02');
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>

<script>
	var modal = document.getElementById('id01');
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}
</script>