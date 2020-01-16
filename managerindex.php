<?php
session_start();
if(isset($_SESSION['username']))
{
	$name=$_SESSION['username'];
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
			background: #4d0202;
			width: 500px;
			color: yellow;
		}
		#body_part{
			height: 600px;
		}
		#footer{
			bottom: 0;
			position: absolute;
		}
	</style>
</head>
<body>
	<div id="body_part">
		<?php include "managerheader.php";?>
		
		<nav id="nav_bar">
			<ul>
				<li><a href="managerindex.php">Home</a></li>
				<li><a href="addbymanager.php">Add Product</a></li>
				<li><a href="addbymanager.php">New Campaign</a></li>
				<li><a href="addbymanager.php">Add Employee</a></li>
				<li><a href="viewreport.php">View Report</a></li>
                <li><a href="record.php">View Product</a></li>
                <li><a href="employee_account.php">Account</a></li>
			</ul>
		</nav>
		
		<div id="manager_body">
		<center>
			<h2 id="manager_h2">Welcome <?php echo "$name";?>. This is your manager pannel<h2>
		</center>
		<div>				
	</div>
	<div id="footer"><?php include "footer.php";?></div>
</body>
</html>