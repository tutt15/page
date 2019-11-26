<?php
    
    include dirname(__DIR__)."/config/config.php";
    include dirname(__DIR__)."/common.php";
    $path = $_POST['path'];
    $folder = LOCAL_FILE . '/' . $path;
    if(file_exists($folder)){
        echo "Fails";
    }
    else if(isset($path)){
        $path = dirname(__DIR__). '/' .$path;
        @mkdir($path, 0777, true);
    }
?>