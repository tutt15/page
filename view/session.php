<?php
	
	session_start();
	$servername = "localhost";
	$database = "db_page";
	$username = "root";
	$password = "";
	$conn = mysqli_connect($servername, $username, $password, $database);

	$username=$_SESSION['username'];

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
