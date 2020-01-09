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
	if (isset($_POST['register_btn'])){
	   register();
	}
	function register(){
	   global $db;
		$username = $_POST["username"];
		$full = $_POST["fullname"];
		$password = $_POST["password"];
		$role = $_POST["role"];
	    $query = "INSERT INTO user1 (username,password,fullName,role) 
	            VALUES('$username','$password','$full','$role')";
	            echo  $query;
	    mysqli_query($db, $query); 
	}

	session_start();                                        
    if (isset($_POST["username"]) && isset($_POST["password"])){                                      
        $username = $_POST['username'];                                      
        $password = $_POST['password'];                                                              
        $sql = "SELECT * from user1 where username='".$username."' and password='".$password."'";
        $user = $db->query($sql)->fetch_object("User");      
        var_dump($user);                      
        
            if($user && $user->canManageShoe()){
                $_SESSION['admin'] = new User($user->id, null, $user->fullName, null, null, null);
                header("location:Admin.php");
            }
            if($user && $user->canBuyShoe()) {
                $_SESSION['user'] = new User($user->id, null, $user->fullName, null, null, null);
                header("location:Userdisplay.php");
            }
            else if($username== "" || $password == ""){
                echo "<script> alert(' Please enter full information!'); </script>";
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
	<meta name="viewport" content="width=device-width, initial-scale=1">
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
	  	<a class="active" href="index.php">Home</a>
	  	<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Login</button>
	  	<button onclick="document.getElementById('id02').style.display='block'" style="width:auto;">Register</button>
	</div>
	<div style="margin-top: 30px;display: flex;justify-content: space-between;margin-left: 150px;" id="slide">
      <div>
        <img src="logo.jpg" width="300" height="350">
      </div>
      <div style="margin-right: 150px;">
          <img  id="myId" src="img/fine.jpg" width="600" height="350">
      </div>
 	 </div>
	<p><h1>PRODUCTS</h1></p>
	<div class="shoe-container">
		<?php 
			for($i = 0; $i < count($shoes); $i++){
		?>
			<div class="pro" style="margin-left: 30px;">
				<img class="item-shoe-icon"src=<?php echo $shoes[$i]->getImagePath(); ?>>
				<h3 class="item-shoe-name"><?php echo $shoes[$i]->name ?></h3>
				<h3 class="item-shoe-type"><?php echo $shoes[$i]->getType().",".$shoes[$i]->color ?></h3>
				<h3 class="item-shoe-price"><?php echo $shoes[$i]->getDisplayPrice() ?></h3>	
			</div>			
		<?php
			}
		?>	
	</div>
</body>
</html>
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
<div id="id01" class="modal">
	<form class="modal-content animate" action="index.php" method="post">
	    <div class="imgcontainer">
	      	<span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
	    </div>
	    <div class="container">
	    	<h1>Login</h1>
	      	<label for="uname"><b>Username</b></label>
	      	<input class="inputtext" type="text" placeholder="Enter Username" name="username" required></br>
	      	<label for="psw"><b>Password</b></label>
	      	<input class="inputtext" type="password" placeholder="Enter Password" name="password" required>
	      	<button>Login</button></br>
	        <input type="checkbox" checked="checked" name="remember"> Remember me
	    </div>
	    <div class="container" style="background-color:#f1f1f1">
	      <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
	    </div>
	</form>
</div>
<script>
	var modal = document.getElementById('id01');
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	}
</script>

<div id="id02" class="modal">
	  	<form class="modal-content animate" action="index.php" method="post">
		    <div class="imgcontainer">
		      <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">&times;</span>
		    </div>
	    <div class="container">
	    	<h1>Register</h1>
	      	<label for="uname"><b>Username</b></label>
	      	<input class="inputtext" type="text" placeholder="Enter Username" name="username" required></br>
	      	<label for="psw"><b>Full name</b></label>
	      	<input class="inputtext" type="text" placeholder="Enter Password" name="fullname" required></br>
	     	<label for="psw"><b>Password</b></label>
	      	<input class="inputtext" type="password" placeholder="Enter Password" name="password" required></br>
	      	<label for="psw"><b>Role</b></label>
	      	<input class="inputtext" type="text" placeholder="Enter Password" name="role" required></br>
	      	<button name="register_btn">Register</button></br>
	        <input type="checkbox" checked="checked" name="remember"> Remember me
	    </div>
	    <div class="container" style="background-color:#f1f1f1">
	      <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Cancel</button>
	    </div>
  	</form>
</div>
<script>
	var modal = document.getElementById('id02');
	window.onclick = function(event) {
	    if (event.target == modal) {
	        modal.style.display = "none";
	    }
	}
</script>