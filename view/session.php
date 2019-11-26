<?php
	include_once dirname(__DIR__)."/connect/db.php";
	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	$sql_login = new DataOperation();
	$username=$_SESSION['username'];
	$sql = $sql_login ->listByValue("user", ["username" => $username],["username"]);

	if(!isset($_SESSION['username'])){
	  header("location:login.php");
	}
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	mysqli_close($conn);

 ?>
