<?php
include_once dirname(__DIR__).'/config/config.php';
include_once dirname(__DIR__).'/connect/db.php';
$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
mysqli_set_charset($conn, "utf8");
$radio_val = $_POST['radio_val'];
$sql = "select template_src from template where id=".$radio_val;
$result = mysqli_query($conn,$sql);
$row = mysqli_fetch_array($result) ;
echo '/cat_template/'.$row['template_src'];

exit;