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
				<li><a href="record.php">Account</a></li>
			</ul>
		</nav>
		
		<div id="manager_body">
		<center>
			<h2 id="manager_h2">Company Whole Status Report<h2>
		</center>
		<center><form action="viewreport.php" method="post">
		<?php
						$value = mysqli_query($con, "select * from worker_info where designation='employee'");
						?>

						<select id="employee_name" name="cam_employee_name">
						<option value="">Select Employee</option>
						<?php while($row = mysqli_fetch_array($value, MYSQLI_ASSOC))
						{
						echo "<option value='{$row['worker_name']}'>{$row['worker_name']}</option>";
						}
						?>
						</select>
						
						<input type="date" name="date1"/><input type="date" name="date2"/>
						
						<input type="submit" name="search" value="Search"/><input type = "button" value = "Print" onclick = "window.print()" />
		</form></center>
		<center><?php
			include "connection.php";
	
	if(isset($_POST['search']))
	{
	$employee_name = $_POST['cam_employee_name'];
	$date1=$_POST['date1'];
	$date2=$_POST['date2'];
	$result=mysqli_query($con, "select * from profit_report where employee_name = '$employee_name' or sell_time between '$date1' and '$date2'");
	$query = "SELECT * FROM profit_report where employee_name = '$employee_name' or sell_time between '$date1' and '$date2'";
	$query_run = mysqli_query($con, $query);

	$e_salary= 0;
	$profit=0;
	while ($num = mysqli_fetch_assoc($query_run)) {
		$e_salary += $num['employee_salary'];
		$profit += $num['profit'];
	}	
	
	echo "<table id='phptable' border=1 cellpadding='10' width='1080px'>
			<tr>
				<th colspan='9'>Employee Salary and Company Profit Report</th>
			</tr>
			<tr>
				<th>Employee Name</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Buying Cost</th>
				<th>Selling Cost</th>
				<th>Commission</th>
				<th>Employee Salary</th>
				<th>Profit</th>
				<th>Date</th>
			</tr>";
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo "<tr>";
		echo "<td>".$row['employee_name']."</td>";
		echo "<td>".$row['product_name']."</td>";
		echo "<td>".$row['quantity']."</td>";		
		echo "<td>".$row['buying_cost']."</td>";
		echo "<td>".$row['selling_cost']."</td>";
		echo "<td>".$row['employee_commission']."%</td>";
		echo "<td>".$row['employee_salary']."</td>";
		echo "<td>".$row['profit']."</td>";
		echo "<td>".$row['sell_time']."</td>";
		echo "</tr>";
	}
	
	echo "<tr>
		<th colspan='9'>Employee Salary: ".$e_salary."&emsp;Company Profit: ".$profit."</th>
	<tr>";
	
	echo "</table>";	
	}else{
		
	$result=mysqli_query($con, "select * from profit_report");
	
	$query = "SELECT * FROM profit_report";
	$query_run = mysqli_query($con, $query);

	$e_salary= 0;
	$profit=0;
	while ($num = mysqli_fetch_assoc($query_run)) {
		$e_salary += $num['employee_salary'];
		$profit += $num['profit'];
	}	
	
	echo "<table id='phptable' border=1 cellpadding='10' width='1080px'>
			<tr>
				<th colspan='9'>Employee Salary and Company Profit Report</th>
			</tr>
			<tr>
				<th>Employee Name</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Buying Cost</th>
				<th>Selling Cost</th>
				<th>Commission</th>
				<th>Employee Salary</th>
				<th>Profit</th>
				<th>Date</th>
			</tr>";
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo "<tr>";
		echo "<td>".$row['employee_name']."</td>";
		echo "<td>".$row['product_name']."</td>";
		echo "<td>".$row['quantity']."</td>";		
		echo "<td>".$row['buying_cost']."</td>";
		echo "<td>".$row['selling_cost']."</td>";
		echo "<td>".$row['employee_commission']."%</td>";
		echo "<td>".$row['employee_salary']."</td>";
		echo "<td>".$row['profit']."</td>";
		echo "<td>".$row['sell_time']."</td>";
		echo "</tr>";
	}
	
	echo "<tr>
		<th colspan='9'>Employee Salary: ".$e_salary."&emsp;Company Profit: ".$profit."</th>
	<tr>";
	
	echo "</table>";
	}
	
	
	mysqli_close($con);
?>
		
		<div>				
	</div>
	<div id="footer"><?php include "footer.php";?></div>
</body>
</html>