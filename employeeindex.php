<?php
session_start();
if(isset($_SESSION['username']))
{
	$username=$_SESSION['username'];
	$name=$_SESSION['name'];
}
else{
	header("location:login.php");
}
?>


<!Doctype html>
<html>
<head lang="en">
	<title>Sales target management system</title>
	<link rel="stylesheet" type="text/css" href="first.css"/>
	<style type="text/css">
		#manager_h2{
			margin-top: 50px;
			padding: 5px;
			background: #047a85;
			width: 600px;
			color: yellow;
		}
		#body_part{
			position: flexible;
			padding-bottom: 400px;
		}
		#footer{
			bottom: 0px;
			position: absolute;
		}
	</style>
</head>
<body>
	<div id="body_part">
		<?php include "employeeheader.php";?>
		
		<nav id="nav_bar">
			<ul>
				<li><a href="employeeindex.php">Home</a></li>
				<li><a href="sellproduct.php">Sell Product</a></li>
				<li><a href="employeeindex.php">Request Product</a></li>
				<li><a href="employeeview.php">View Report</a></li>
				<li><a href="employeeindex.php">View Stock</a></li>
				<li><a href="employeeindex.php">Account</a></li>
			</ul>
		</nav>
		
		<div id="manager_body">
		<center>
			<h2 id="manager_h2">Welcome <?php echo "$username";?>. This is your employee pannel<h2>
		</center>
		<div>
			
	</div>
	<div id="footer"><?php include "footer.php";?></div>
</body>
</html>