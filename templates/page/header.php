<?php 
	session_start();
	include_once dirname(__DIR__,2).'/config/config.php';
	if(!isset($_SESSION['username'])){
		header("location:login.php");
	  }
?>
<!DOCTYPE html>
<html>
<head>
	<title>PAGE</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0" />
	<link rel="icon" type="image/png" href="/asset/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/asset/css/style.css">
	<link rel="stylesheet" href="/asset/bootstrap/css/bootstrap.min.css">
	<script src="/asset/js/jquery.js"></script>
	<script src="/asset/js/popper.min.js"></script>
	<script src="/asset/bootstrap/js/bootstrap.min.js"></script>
	<script src="/ckeditor/ckeditor.js"></script>
	<script src="/asset/js/a076d05399.js"></script>
	<script src="/asset/js/validate.min.js"></script>
</head>
