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
			margin: 20px auto;
			text-align: center;
			margin-top: 50px;
			padding: 5px;
			background: #4d0202;
			width: 700px;
			color: yellow;
		}		
		#add_section form{
			float: left;
			width: 320px;
			border: 2px solid green;
			-webkit-border-radius: 10px;
			margin-left: 33px;		
			margin-bottom: 30px;
		}
		#add_section form h3{
			text-align: center;
			margin: 0px;
			background: green;
			color: #e2dcdc;		
			-webkit-border-radius: 10px 10px 00px 0px;
			padding: 5px;
		}
		#add_section form hr{
			margin: 0px;
		}
		#form_element_name p{
			color: black;
			font-weight:bold;
			margin-left: 10px;
			line-height: 60%;
			padding: 0;
		}
		#form_element_button input{
			margin: 0px 10px 10px 10px;
			background: black;
			color: white;
			font-weight: bold;
			-webkit-border-radius: 6px;
		}
		#notification{
			padding-bottom: 20px;
		}
		table{
            text-align: center;
		    background: white; 
		    font:black;
        }		
		#footer{
			bottom: 0;
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
                <li><a href="manager_account.php">Account</a></li>
			</ul>
		</nav>
		
		<div id="manager_body">
			<h2 id="manager_h2">Add Section of New Product, Campaign and Employee</h2>
			
			<div id="add_section">
				<form id="product_form" action="addbymanager.php" method="post">
					<h3>Add New Product</h3>
					<hr/>
					<?php
					include "connection.php";
					$product_name = "";
					$quantity = "";
					$buy_cost = "";
					$per_selling_cost = "";
					$per_buying_cost = "";
					if(isset($_POST['calculation']))
					{
						$product_name = $_POST['product_name'];
						$quantity = $_POST['product_quantity'];
						$buy_cost = $_POST['buying_cost'];
						$per_buying_cost = $buy_cost/$quantity;
						$selling_cost = $buy_cost*.4+$buy_cost;
						$per_selling_cost = $selling_cost/$quantity;
					}
					if(isset($_POST['add_product']))
					{
						$product_name = $_POST['product_name'];
						$quantity = $_POST['product_quantity'];
						$buy_cost = $_POST['buying_cost'];
						$per_buying_cost = $buy_cost/$quantity;
						$selling_cost = $buy_cost*.4+$buy_cost;
						$per_selling_cost = $selling_cost/$quantity;
						
						$product_sql = "select * from product where product_name='$product_name' and quantity!='0'";
						$product_result = mysqli_query($con, $product_sql);
						$product_count = mysqli_num_rows($product_result);
						if($product_count!=0)
						{
						echo "<center><font size='3' color=yellow style='font-weight: bold; background: red'>This product already in stock. You can add it after finish from current stock. Add another product</font></center>";
						}else{
						if(mysqli_query($con,"insert into product(product_name,quantity,buy_cost, per_buy_cost, per_sell_cost) values('$product_name','$quantity','$buy_cost','$per_buying_cost','$per_selling_cost') "))
						{
						echo "<center><font size='3' color=blue>Product add successfully</font></center>";
						}else{
						echo "<center><font size='3' color=red>Sorry, product not added</font></center>";
						}
						}
					
					}
					?>
					<div id="form_element_name">
						<p>Product id: &emsp;&nbsp;&nbsp;&nbsp;<input disabled type="text" name="product_id"/></p>
						<p>Product Name:* <input type="text" name="product_name" value="<?php echo $product_name;?>"/></p>
						<p>Quantity:* &emsp;&emsp;&nbsp;<input type="number" name="product_quantity" style="width: 5em;" min="1" value="<?php echo $quantity;?>"/></p>
						<p>Buying Cost:* &emsp;<input type="text" name="buying_cost" value="<?php echo $buy_cost;?>"/></p>
						<p><input type="submit" value="Calculate" name="calculation"/></p>
						<p>Per Product Buying Cost: <input type="text" value="<?php echo $per_buying_cost;?>" name="per_buying_cost" size="10px"/></p>
						<p>Per Product Selling Cost: &nbsp;<input type="text" value="<?php echo $per_selling_cost;?>" name="per_selling_cost" size="10px"/></p>
					</div>	
					
					<div id="form_element_button">
						<input type="submit" value="Save" name="add_product"/>
						<input type="reset" value="Clear" name="clear"/>
						<input type="submit" value="Delete" name="delete_product"/>
						<input type="submit" value="View" name="view_product" formnovalidate />
					</div>	
					
				</form>
				<form id="campaign_form" action="addbymanager.php" method="post">
					<h3>Add New Campaign</h3>
					<hr/>
					<?php
					include "connection.php";
					$quantity1="";
					if(isset($_POST['add_campaign']))
					{
						$product_id = $_POST['c_p_id'];
						$product_name = $_POST['product_name'];
						$quantity = $_POST['cam_product_quantity'];
						
						$view=mysqli_query($con, "select * from product where product_id='$product_id'");
						while($row=mysqli_fetch_array($view,MYSQLI_ASSOC))
						{
						$quantity1 = $row['quantity'];						
						}
						
						$selling_cost = $_POST['cam_selling_cost'];
						$promotion = $_POST['deadline'];
						$employee_name = $_POST['cam_employee_name'];
						$employee_branch = $_POST['cam_branch'];
												
						$product_sql = "select * from product where product_name='$product_name' and quantity>0";
						$product_result = mysqli_query($con,$product_sql);
						$product_count = mysqli_num_rows($product_result);
						if($product_count!=0){
							$cam_sql = "select * from campaign where product_id='$product_id' and employee_name='$employee_name' and c_quantity >0";
							$cam_result = mysqli_query($con, $cam_sql);
							$cam_count = mysqli_num_rows($cam_result);
							if($cam_count != 0){
							echo "<center><font size='3' color=yellow style='font-weight: bold; background: red'>This employee already run a campaign on this product. Change employee or product</font></center>";
						}else{
							
							$view=mysqli_query($con, "select * from product where product_name='$product_name' and product_id='$product_id'");
							while($row=mysqli_fetch_array($view,MYSQLI_ASSOC))
							{
							$previous_quantity = $row['quantity'];						
							}
							$last_quantity = $previous_quantity - $quantity;
							
						if($quantity<=$quantity1){
						if(mysqli_query($con, "insert into campaign(product_id, product_name,c_quantity,c_price, deadline, employee_name, employee_branch) values('$product_id', '$product_name','$quantity','$selling_cost','$promotion','$employee_name','$employee_branch')"))
						{							
						echo "<center><font size='3' color=blue>New Campaign add successfully</font></center>";
						}else{
						echo "<center><font size='3' color=red>Sorry, campaign not added</font></center>";
						}						
						mysqli_query($con, "update product set quantity='$last_quantity' where product_name='$product_name'");
						}else{
							echo "<center><font size='3' color=yellow style='font-weight: bold; background: red'>Insufficiant product in stock</font></center>";
						}
					}
					}else{
						echo "<center><font size='3' color=yellow style='font-weight: bold; background: red'>Invalid product name</font></center>";
					}
					}
					?>
					<div id="form_element_name">
						<p>Campaign id: &nbsp;&nbsp;&nbsp;<input disabled type="text" name="cam_id"/></p>
						<p>Product Name:&nbsp;<input type="text" name="product_name" id="cam_product_name"/></p>
						<p>Quantity: &emsp;&emsp;&nbsp;<input id="quantity" type="number" name="cam_product_quantity" min="1" max="<?php echo $quantity1; ?>"/></p>
						<p>Selling Price:&emsp;<input type="text" name="cam_selling_cost" id="cam_selling_cost"/></p>
						<p>Promotion Deadline:<input id="deadline" type="date" name="deadline" /></p>
						<p>Employee Name: &emsp;
						<?php
						$value = mysqli_query($con, "select * from worker_info where designation='employee'");
						?>

						<select id="employee_name" name="cam_employee_name">
						<option value="">Select Employee</option>
						<?php while($row = mysqli_fetch_array($value, MYSQLI_ASSOC))
						{
						echo "<option value='{$row['worker_name']}'>{$row['worker_name']}</option>";
						}
						?><input type="text" style="background:none;border:none;color:#9fc69a;" name="c_p_id" id="c_p_id" size="1px"/>
						</select>
						</p>
						<p>Employee Branch: &nbsp;&nbsp;<input id="branch" type="text" name="cam_branch" size="15"/>
						</p>
					</div>	
					
					<div id="form_element_button">
						<input type="submit" value="Save" name="add_campaign"/>
						<input type="submit" value="Update" name="update_campaign"/>
						<input type="submit" value="Delete" name="delete_campaign"/>
						<input type="submit" value="View" name="view_campaign"/>
					</div>	
				</form>
				<form id="employee_form" action="addbymanager.php" method="post">
					<h3>Add New Employee</h3>
					<hr/>
					
					<?php
						include "connection.php";
						// $product_name = "";
						// $quantity = "";
						// $quantity = "";
						// $buy_cost = "";
						// $per_selling_cost = "";
						// $per_buying_cost = "";
						if(isset($_POST['add_employee']))
						{							
							$employee_name = $_POST['employee_name'];
							$designation = $_POST['designation'];
							$branch = $_POST['branch'];
							$phone = $_POST['phone'];
							$username = $_POST['username'];
							$password = $_POST['password'];
							
							$emp_sql = "select * from worker_info where worker_name='$employee_name' or username = '$username'";
							$emp_result = mysqli_query($con, $emp_sql);
							$emp_count = mysqli_num_rows($emp_result);
							if($emp_count!=0)
							{
								echo "<center><font size='3' color=yellow style='font-weight: bold; background: red'>Employee name or username already exist. Check employee list and try another</font></center>";
							}else{
							if(mysqli_query($con, "insert into worker_info(worker_name,designation,phone, username, password, branch) values('$employee_name','$designation','$phone','$username','$password','$branch')"))
							{							
							echo "<center><font size='3' color=blue>Employee added successfully</font></center>";
							}else{
							echo "<center><font size='3' color=red>Sorry, employee not added</font></center>";
							}
							}
						}			
						mysqli_close($con);						
				?>
					
					<div id="form_element_name">
						<p>Employee id: &emsp;&nbsp;&nbsp;&nbsp;<input disabled type="text" name="employee_id"/></p>
						<p>Employee Name: <input id="employee_name" type="text" name="employee_name"/></p>
						<p>Designation: &emsp;&emsp;<select name="designation">
															<option value="" disabled>Select</option>
															<option value="employee" defult>Employee</option>
															<option value="manager">Manager</option>
															
													</select>
						</p>
						<p>Branch: &emsp;&emsp;&emsp;&emsp;<input id="branch" type="text" name="branch"/></p>
						<p>phone: &emsp;&emsp;&emsp;&emsp;&nbsp;&nbsp;<input type="text" name="phone"/></p>
						<p>Username: &emsp;&emsp;&nbsp;&nbsp;&nbsp;<input type="text" name="username"/></p>
						<p>Password: &emsp;&emsp;&emsp;<input type="text" name="password"/></p>
					</div>	
					
					<div id="form_element_button">
						<input type="submit" value="Save" name="add_employee"/>
						<input type="submit" value="Clear" name="update_employee"/>
						<input type="submit" value="Delete" name="delete_employee"/>
						<input type="submit" value="View" name="view_employee"/>
					</div>	
				</form>			
				<div id="notification">
				
				</div>
				
				<center>
				<?php
				include "connection.php";
				if(isset($_POST['view_product']))
{
$result=mysqli_query($con, "select * from product where quantity>0");
	
	echo "<table id='phptable' border=1 cellpadding='10' width='900px'>
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
var table = document.getElementById('phptable'),rIndex;
for(var i=0; i<table.rows.length; i++)
{
table.rows[i].onclick = function()
{
 rindex = this.rowIndex;
 document.getElementById('product_name').value = this.cells[1].innerHTML;
 document.getElementById('quantity').value = this.cells[2].innerHTML;
 document.getElementById('cam_selling_cost').value = this.cells[4].innerHTML;
}
}
</script>";
}				


if(isset($_POST['view_employee']))
{
$result=mysqli_query($con, "select * from worker_info");
	
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
	while($row=mysqli_fetch_array($result, MYSQLI_ASSOC))
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
}			

if(isset($_POST['view_campaign']))
{
include "addcampaign.php";
}
				?>
				</center>
			</div>		
        </div>			
			
	</div>	
	<div id="footer" style="margin-left:64px; "><?php include "footer.php"; ?></div>
</body>
</html>