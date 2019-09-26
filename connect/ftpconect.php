<?php
	$ftp_host   = '169.254.214.253';
	$ftp_user = 'tututu';
	$ftp_pass = '12345678';

	$conn_id = ftp_connect($ftp_host) or die("Couldn't connect to $ftpHost");

	ftp_login($conn_id, $ftp_user, $ftp_pass);
?>