<?php
include_once dirname(__DIR__).'/config/config.php';
include_once dirname(__DIR__).'/connect/db.php';
$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
$pageid = $_POST['page_id'];
$sql = "select title, content from page where id=".$pageid;
$result = mysqli_query($conn,$sql);
$response = "<table border='0' width='100%'>";
while( $row = mysqli_fetch_array($result) ){
    $title = $row['title'];
    $content = $row['content'];
    
    $response .= "<tr>";
    $response .= "<td></td><td class='text-center mb-5' style='color:red;font-size:25px'>".$title."</td>";
    $response .= "</tr>";

    $response .= "<tr>";
    $response .= "<td></td><td>".$content."</td>";
    $response .= "</tr>";

}
$response .= "</table>";

echo $response;
exit;