<?php
  include_once dirname(__DIR__).'/model/action.php';
  $obj = new DataOperation;
  $con = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
  if(isset($_POST["title"])){
    $title = $_POST['title'];
    $query = "SELECT * FROM `page` WHERE BINARY title ='$title'";
    $result = mysqli_query($con,$query);
    $record = mysqli_num_rows($result);
    echo $record;
  }
   
?> 