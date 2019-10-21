<?php
	include_once dirname(__DIR__)."/connect/db.php";

	$username=$_SESSION['username'];
	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	$sql_login = new DataOperation();
	$sql = $sql_login ->listPageById("user", ["username" => $username],["username"]);

	if(!isset($_SESSION['username'])){
	  header("location:login.php");
	}
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	mysqli_close($conn);

 ?>
