<?php
    // $a = 'aa';
    $a = $_POST['file'];
    include dirname(__DIR__)."/config/config.php";
    include dirname(__DIR__)."/common.php";
    $file = LOCAL_FILE . '/' . $a;
    $list_file =  dirToArray($file);
    echo json_encode($list_file);
?>