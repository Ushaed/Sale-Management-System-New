<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
} else {
    header("location:login.php");
}
?>


<!Doctype html>
<html>
<head lang="en">
    <title>Sales target management system</title>
    <link rel="stylesheet" type="text/css" href="first.css"/>
    <style type="text/css">
        #manager_h2 {
            margin-top: 50px;
            padding: 5px;
            background: #047a85;
            width: 400px;
            color: yellow;
        }

        #body_part {
            clear: both;
            padding-bottom: 50px;
        }

        #footer {
            bottom: 0px;
            margin-top: 50px;
        }

        table {
            text-align: center;
        }

        form {
            width: 400px;
            margin: 50px auto;
        }

        form h3 {
            text-align: center;
            background: green;
            margin-top: 20px;
            color: white;
            margin-bottom: 0px;
            padding: 5px;
        }

        form hr {
            margin-top: 0px;
        }

        #cell_content {
            background: #76b476;
            padding-top: 5px;
            padding-bottom: 5px;
            margin-top: -8px;
        }

        #cell_content p {
            color: black;
            margin-left: 65px;
            font-weight: bold;
        }

        #button {
            background: black;
            color: white;
            padding: 3px;
            -webkit-border-radius: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<div id="body_part">
    <?php include "employeeheader.php"; ?>

    <nav id="nav_bar">
        <ul>
            <li><a href="employeeindex.php">Home</a></li>
            <li><a href="sellproduct.php">Sell Product</a></li>
<!--            <li><a href="employeeindex.php">Request Product</a></li>-->
            <li><a href="employeeview.php">View Report</a></li>
            <li><a href="viewstock.php">View Stock</a></li>
            <li><a href="employee_account.php">Account</a></li>
        </ul>
    </nav>

    <div id="manager_body">
        <center>
            <h2 id="manager_h2">Product Selling Stock<h2>
        </center>
        <center>
            <?php
            include "connection.php";

            $result = mysqli_query($con, "select * from campaign where employee_name='$name' and c_quantity>0");

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
            while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                echo "<tr>";
                echo "<td>" . $row['campaign_id'] . "</td>";
                echo "<td>" . $row['product_id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['c_quantity'] . "</td>";
                echo "<td>" . $row['c_price'] . "</td>";
                echo "<td>" . $row['deadline'] . "</td>";
                echo "</tr>";
            }
            echo "</table>";
            mysqli_close($con);
            ?>
        </center>
        <div>

        </div>
        <div id="footer"><?php include "footer.php"; ?></div>
</body>
</html>