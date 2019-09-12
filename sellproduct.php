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
			width: 400px;
			color: yellow;
		}
		#body_part{
			clear: both;
			padding-bottom: 50px;
		}
		#footer{
			bottom: 0px;
			margin-top: 50px;
		}
		table{
			text-align: center;
		}
		
		form{
			width: 400px;
			margin: 50px auto;
		}
		form h3{
			text-align: center;
			background: green;
			margin-top: 20px;
			color: white;
			margin-bottom: 0px;
			padding: 5px;
		}
		form hr{
			margin-top: 0px;
		}
		#cell_content{
			background: #76b476;
			padding-top: 5px;
			padding-bottom: 5px;
			margin-top: -8px;
		}
		#cell_content p{
			color:black;
			margin-left: 65px;
			font-weight: bold;
		}
		#button{
			background: black;
			color:white;
			padding: 3px;
			-webkit-border-radius: 5px;
			margin-bottom: 5px;
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
			<h2 id="manager_h2">Product Selling Section<h2>
		</center>
			<form id="sell_form" action="sellproduct.php" method="post">
				<h3>Sell Product</h3>
				<hr/>
				
				<?php
					include "connection.php";
					$product_id="";
					$campaign_id="";
					$product_name="";
					$quantity = "";
					$cost_per_product = "";
					$total_cost="";
					if(isset($_POST['cost_calculation']))
					{
						$product_id=$_POST['id'];
						$campaign_id=$_POST['c_id'];
						$product_name=$_POST['p_id'];
						$quantity = $_POST['quantity'];
						$cost_per_product = $_POST['cost'];
						$total_cost = $quantity*$cost_per_product;
					}
					if(isset($_POST['sell']))
					{
						date_default_timezone_set("Asia/Dhaka");
						$d = date("Y-m-d");
						$product_name=$_POST['p_id'];
						$product_id=$_POST['id'];
						$campaign_id=$_POST['c_id'];
						$product_name=$_POST['p_id'];
						
						$product_sql = "select * from campaign where product_name='$product_name' and employee_name='$name' and c_quantity>0";
						$product_result = mysqli_query($con, $product_sql);
						$product_count = mysqli_num_rows($product_result);
						if($product_count!=0){						
						$view=mysqli_query($con, "select * from campaign where product_name='$product_name' and employee_name='$name' and product_id='$product_id'");
						while($row=mysqli_fetch_array($view, MYSQLI_ASSOC))
						{
						$quantity1 = $row['c_quantity'];						
						}
						
						$view=mysqli_query($con, "select * from product where product_name='$product_name' and product_id='$product_id'");
						while($row=mysqli_fetch_array($view, MYSQLI_ASSOC))
						{
						$buying_cost = $row['per_buy_cost'];
						}
						
						$q_view=mysqli_query($con, "select * from campaign where product_name='$product_name' and employee_name='$name' and product_id='$product_id'");
						while($row=mysqli_fetch_array($q_view, MYSQLI_ASSOC))
						{
						$previous_quantity = $row['c_quantity'];
						$deadline = $row['deadline'];
						}
						
						$quantity = $_POST['quantity'];						
						$selling_cost = $_POST['total_cost'];
						
						if($deadline>=$d)
						{
						$employee_comission = 10;
						$employee_salary = $selling_cost*.1;
						}else{						
						$employee_comission = 5;
						$employee_salary = $selling_cost*.05;
						}
						$total_buying_cost = $buying_cost * $quantity;
						$profit = $selling_cost-$total_buying_cost-$employee_salary;
						$new_quantity = $previous_quantity-$quantity;
						
						if($quantity<=$quantity1){
						if(mysqli_query($con, "insert into profit_report(product_name,quantity,buying_cost, selling_cost, employee_commission, employee_salary, profit, employee_name,sell_time) values('$product_name','$quantity','$total_buying_cost','$selling_cost','$employee_comission', '$employee_salary','$profit', '$name', '$d')"))
						{	

							mysqli_query($con, "update campaign set c_quantity='$new_quantity' where product_name='$product_name' and employee_name='$name'and c_quantity>0");
							
						echo "<center><font size='3' color=blue>Sell report submitted to manager</font></center>";
						}else{
						echo "<center><font size='3' color=red>Sorry, cell process not completed</font></center>";
						}
						}else{
							echo "<center><font size='3' color=yellow style='font-weight: bold; background: red'>Insufficiant product in stock</font></center>";
						}
						}else{
							echo "<center><font size='3' color=yellow style='font-weight: bold; background: red'>Invalid product name</font></center>";
						}
					}
					?>
				
				<div id="cell_content">
					<p>Campaign ID: &nbsp;<input type="text" name="c_id" id="c_id" value="<?php echo $campaign_id;?>"/></p>
					<p>Product Name: <input type="text" name="p_id" id="p_id" value="<?php echo $product_name;?>"/></p>
					<p>Quantity: &emsp;&emsp;&nbsp;<input type="number" name="quantity" id="quantity" size="5em" value="<?php echo $quantity;?>"/></p>
					<p>Cost Per Product:<input type="number" name="cost" id="cost" style="width: 11em;" value="<?php echo $cost_per_product;?>"/><input style="background:none;border:none;color:#76b476;" type="text" name="id" id="id" value="<?php echo $product_id;?>" size="1px"/></p>
					<p><input type="submit" value="Total Cost" name="cost_calculation"/><input style="margin-left: 30px;" type="number" name="total_cost" value="<?php echo $total_cost;?>"/></p>
					<center>
					<input id="button" type="submit" value="Sell Product" name="sell"/>
					<input id="button" type="submit" value="Update" name="update"/></center>
				</div>
				
			</form>
			<center><?php
			include "connection.php";
	
	$result=mysqli_query($con, "select * from campaign where employee_name='$name' and c_quantity>0");
	
	echo "<table id='phptable' border=1 cellpadding='10' width='900px'>
			<tr>
				<th colspan='6'>Your Current Running Campaign</th>
			</tr>
			<tr>
				<th>Campaign ID</th>
				<th>Product ID</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th> Per Product Selling Cost</th>
				<th>10% Promotion Deadline</th>
			</tr>";
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
	{
		echo "<tr>";		
		echo "<td>".$row['campaign_id']."</td>";
		echo "<td>".$row['product_id']."</td>";
		echo "<td>".$row['product_name']."</td>";		
		echo "<td>".$row['c_quantity']."</td>";
		echo "<td>".$row['c_price']."</td>";
		echo "<td>".$row['deadline']."</td>";
		echo "</tr>";
	}
	echo "</table>";
	
	echo "<script>
var table = document.getElementById('phptable'),rIndex;
for(var i=0; i<table.rows.length; i++)
{
table.rows[i].onclick = function()
{
 rindex = this.rowIndex;
 document.getElementById('c_id').value = this.cells[0].innerHTML;
 document.getElementById('id').value = this.cells[1].innerHTML;
 document.getElementById('p_id').value = this.cells[2].innerHTML;
 document.getElementById('quantity').value = this.cells[3].innerHTML;
 document.getElementById('cost').value = this.cells[4].innerHTML;
}
}
</script>";
	
	mysqli_close($con);
?></center>
		<div>
			
	</div>
	<div id="footer"><?php include "footer.php";?></div>
</body>
</html>