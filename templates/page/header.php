<?php 
	ob_start();
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:login.php");die();
	}
	include_once dirname(__DIR__,2).'/config/config.php';
	include_once dirname(__DIR__,2).'/common.php';
	
?>
<!DOCTYPE html>
<html>
<head>
	<title>PAGE</title>
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
	<link rel="icon" type="image/png" href="/asset/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/asset/css/style.css">
  <link rel="stylesheet" type="text/css" href="/asset/css/list.css">
	<link rel="stylesheet" href="/asset/bootstrap/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>
</head>

