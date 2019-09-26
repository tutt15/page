<?php
	include "../model/action.php";
	include "../view/header.php";
	ob_start();
	$myrow = $obj->listPage("page");
	foreach ($myrow as $row) {
		$filename = $row['title'];
		$content  = $row['content'];
	?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $filename ?></title>
</head>
<body>
	<p><?php echo $content; ?></p>

</body>
</html>
<?php 
  	
	$file_pointer = "../example.html"; 
	$newfile = "../$filename.html";
	file_put_contents($file_pointer, ob_get_contents());
	copy($file_pointer,$newfile);
?>
<?php
	include '../connect/ftpconect.php';
	$file = 'example.html';
	$local_file = 'C:/xampp/htdocs/crudpapge/'.$file;
	$ftp_path = '/ex.html';
	$upload = ftp_put($conn_id, $ftp_path, $local_file, FTP_ASCII);
	 
	ftp_close($conn_id);
?>
<?php
ob_end_clean();
 } 

 ?>