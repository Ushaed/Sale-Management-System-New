<?php
session_start();
?>

<!Doctype html>
<html>
<head lang="en">
	<title>Sales target management system</title>
	<link rel="stylesheet" type="text/css" href="first.css"/>
	<style type="text/css">
		#form_part{			
			width:1100px;
			height: 600px;
			background: #9fc69a;
			margin:20px auto;
			margin-top: 0px;
			margin-bottom: 0px;
		}		
		form{
			width: 350px;
			border: 2px dotted blue;
			-webkit-border-radius: 10px;
			margin-top: 120px;
			margin-bottom: 150px;
		}
		form h3{
			text-align: center;
			margin-top: -5px;
		}
		form hr{
			margin-top: -10px;
		}
		form p{
			color: black;
			font-weight: bold;
		}
		form #account{
			margin-left: -65px;
		}
		form #login_button{
			background: #064501;
			padding: 4px;
			color: white;
			font-weight: bold;
			-webkit-border-radius: 5px;
			margin-bottom: 15px;
			margin-left: -50px;
		}
		#login_message{
			color: red;
			font-weight: bold;
		}
	</style>
</head>
<body>
	<div id="form_part">
		<?php include "header.php";?>
		
		<nav id="nav_bar">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li>Employee</li>
				<li>Product</li>
				<li>Report</li>
				<li>Support</li>
			</ul>
		</nav>
		
		
		<center>
		<form action="" method="post">
		<p><h3>User Login Panel</h3></p>
		<hr/>
		
		<div id="login_message">
			<?php 
			include "connection.php";
			if(isset($_POST['login']))
			{
				$username = $_POST['username'];
				$password = $_POST['password'];
				$account = $_POST['account'];
				
				$sql = "select * from worker_info where username='$username' and password = '$password' and designation = '$account'";
				$result = mysqli_query($con, $sql);
				//$count = mysqli_num_rows($result);
				if(mysqli_num_rows($result) == 1)
				{
					$row = mysqli_fetch_array($result);
					$_SESSION['username'] = $row['username'];
					$_SESSION['name'] = $row['worker_name'];
					
					if($account == "manager")
					{
						header("location:managerindex.php");
					}elseif($account == "employee"){
						header("location:employeeindex.php");
					}
				}else{
					echo "Invalid username or password";
				}
			}
			
			?>
		</div>		
				
			<p>Username: <input type="text" name="username" required="1" /></p>
			<p>Password: &nbsp;<input type="password" name="password" required="1" /></p>
			<p id="account">Account:&nbsp;&nbsp;<select name="account" >
			<option disabled >Account type</option>
			<option value="manager">Manager</option>
			<option value="employee" def>Employee</option>
			</select></p>
			<input id="login_button" type="submit" value="Login" name="login"/>
		</form>
		</center>
		<?php include "footer.php";?>		
	</div>
</body>
</html>