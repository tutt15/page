<?php
	include_once dirname(__DIR__).'/config/config.php';

	$conn_id = ftp_connect(FTPHOST) or die("Couldn't connect to FTPHOST");

	ftp_login($conn_id, FTPUSER, FTPPASS);
?>
