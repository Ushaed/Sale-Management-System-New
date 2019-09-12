<?php
$con = mysqli_connect("localhost","root","","sale");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
//mysqli_select_db("sale",$con);
?>