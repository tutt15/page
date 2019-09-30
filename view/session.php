<?php
	include_once dirname(__DIR__)."/connect/db.php";
	session_start();
	$username=$_SESSION['username'];
	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	$sql=mysqli_query($conn,"select username from user where username='$username' ");

	$row=mysqli_fetch_array($sql,MYSQLI_ASSOC);

	$login=$row['username'];

	if(!isset($_SESSION['username'])){
	  header("location:login.php");
	}
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}
	mysqli_close($conn);


	

 ?>
