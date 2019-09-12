<!Doctype html>
<html>
<head lang="en">
	<title>Sales target management system</title>
	<link rel="stylesheet" type="text/css" href="first.css"/>
	<style type="text/css">
		
	</style>
</head>
<body>
		<div id="manager_body">
		<center>
			<h2 id="manager_h2">Product Selling Section<h2>
		</center>
			<form id="sell_form" action="sellproduct.php" method="post">
				<h3>Sell Product</h3>
				<hr/>
				
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
	
	$result=mysql_query("select * from campaign where employee_name='$name' and c_quantity>0");
	
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
	while($row=mysql_fetch_array($result))
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
	
	mysql_close($con);
?></center>
		<div>
			
	</div>
	<div id="footer"><?php include "footer.php";?></div>
</body>
</html>