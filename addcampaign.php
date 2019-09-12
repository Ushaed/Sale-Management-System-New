<?php
include_once "connection.php";

$result=mysqli_query($con, "select * from product where quantity > 0");
	
	echo "<table id='phptable1' border=1 cellpadding='10' width='900px'>
			<tr>
				<th colspan='5'>Current Product in Stock</th>
			</tr>
			<tr>
				<th>Product ID</th>
				<th>Product Name</th>
				<th>Quantity</th>
				<th>Buying Cost</th>
				<th>Selling Cost</th>
			</tr>";
	while($row=mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>".$row['product_id']."</td>";
		echo "<td>".$row['product_name']."</td>";		
		echo "<td>".$row['quantity']."</td>";
		echo "<td>".$row['per_buy_cost']."</td>";
		echo "<td>".$row['per_sell_cost']."</td>";
		echo "</tr>";
	}
	echo "</table>";
echo "<script>
var table = document.getElementById('phptable1'),rIndex;
for(var i=0; i<table.rows.length; i++)
{
table.rows[i].onclick = function()
{
 rindex = this.rowIndex;
 document.getElementById('c_p_id').value = this.cells[0].innerHTML;
 document.getElementById('cam_product_name').value = this.cells[1].innerHTML;
 document.getElementById('quantity').value = this.cells[2].innerHTML;
 document.getElementById('cam_selling_cost').value = this.cells[4].innerHTML;
}
}
</script>";

echo "<br/><br/>";

$result=mysqli_query($con, "select * from worker_info where designation='employee'");
	
	echo "<table id='phptable' border=1 cellpadding='10' width='900px'>
			<tr>
				<th colspan='5'>Employee List</th>
			</tr>
			<tr>
				<th>Employee ID</th>
				<th>Employee Name</th>
				<th>Designation</th>
				<th>Phone</th>
				<th>Branch</th>
			</tr>";
	while($row=mysqli_fetch_array($result))
	{
		echo "<tr>";
		echo "<td>".$row['worker_id']."</td>";
		echo "<td>".$row['worker_name']."</td>";		
		echo "<td>".$row['designation']."</td>";
		echo "<td>".$row['phone']."</td>";
		echo "<td>".$row['branch']."</td>";
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
 document.getElementById('employee_name').value = this.cells[1].innerHTML;
 document.getElementById('branch').value = this.cells[4].innerHTML;
}
}
</script>";
?>