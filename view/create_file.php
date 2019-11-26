<?php
    
    include dirname(__DIR__)."/config/config.php";
    include dirname(__DIR__)."/common.php";
    $path = $_POST['path'];
    $file = LOCAL_FILE . '/' . $path;
    if(file_exists($file)){
        echo "Fails";
    }else{
        $fp = fopen(($file.'.html'), 'w');
        fwrite($fp, "");
        fclose($fp);
    }
?>