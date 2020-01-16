<?php
session_start();
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $name = $_SESSION['name'];
} else {
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
        #manager_h2 {
            margin-top: 50px;
            padding: 5px;
            background: #4d0202;
            width: 500px;
            color: yellow;
        }

        #footer {
            bottom: 0;
        }

        table {
            text-align: center;
            background: white;
        }
    </style>

    <script type="text/javascript">
        <!--
        //-->
    </script>
</head>
<body>
<div id="body_part">
    <?php include "managerheader.php"; ?>
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
            <h2 id="manager_h2">Welcome <?php echo "$name"; ?>. Personal Information<h2>
        </center>
        <center>
            <?php
            include "connection.php";
            $result = mysqli_query($con, "SELECT * FROM `worker_info` WHERE `username` = '$username' and `worker_name` = '$name'");
            $row = mysqli_fetch_assoc($result);

            echo '<section id="article_section">
                    <article id="pera_1" >
                    <header>'.$row["worker_name"].'</header>
                        <p style="text-align: left">User Name: '.$row["username"].'</p>
                        <p style="text-align: left">Phone: '.$row["phone"].'</p>
                        <p style="text-align: left">Branch: '.$row["branch"].'</p>
                        <p style="text-align: left">Designation: '.$row["designation"].'</p>
                    </article>
                    </section>';
            echo '<br>';
            mysqli_close($con);
            ?>
        </center>
        <div id="footer"><?php include "footer.php"; ?></div>
</body>
</html>
