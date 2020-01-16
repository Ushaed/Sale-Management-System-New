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

<?php
include_once "connection.php";
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
			width: 350px;
			color: yellow;
		}
		
		#footer{
			bottom: 0;
		}
		table{
			text-align: center;
			background: white;
		}
	</style>
	
	<script type = "text/javascript">
         <!--
         //-->
      </script>
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
				<li><a href="manager_account.php">Account</a></li>
			</ul>
		</nav>
		
		<div id="manager_body">
		<center>
			<h2 id="manager_h2">Product Report<h2>
		</center>
		<center>
<?php
include "connection.php";
$buy_cost1 = "";	
$per_buy_cost1 = "";	
$quantity1 = "";	
$result = mysqli_query($con, "select * from product");
$total_buying_cost_whole= 0;
echo "<table id='phptable' border=1 cellpadding='10' width='1080px'>
		<tr>
			<th colspan='6'>Company Buying product Report</th>
		</tr>
		<tr>
			<th>Product ID</th>
			<th>Product Name</th>
			<th>Quantity</th>
			<th>Total Buying Cost</th>
			<th>Buying Cost</th>
			<th>Selling Cost</th>
		</tr>";
while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
{
	$buy_cost1 = $row['buy_cost'];						
	$per_buy_cost1 = $row['per_buy_cost'];	
	$quantity1 = $buy_cost1/$per_buy_cost1;
	$total_buying_cost_whole += $row['buy_cost'];	
	echo "<tr>";
	echo "<td>".$row['product_id']."</td>";
	echo "<td>".$row['product_name']."</td>";
	echo "<td>".$quantity1."</td>";		
	echo "<td>".$row['buy_cost']."</td>";
	echo "<td>".$row['per_buy_cost']."</td>";
	echo "<td>".$row['per_sell_cost']."</td>";
	echo "</tr>";
}
echo "<tr>
		<th colspan='6'>Total Buying Cost: ".$total_buying_cost_whole."</th>
	<tr>";
echo "</table>";



mysqli_close($con);
?>
 </center>
		
		<div>				
	</div>
	<div id="footer"><?php include "footer.php";?></div>
</body>
</html>