<?php
    
    include dirname(__DIR__)."/config/config.php";
    include dirname(__DIR__)."/common.php";
    $path = trim($_POST['path']);
    $file = LOCAL_FILE . '/' . $path;
    $check_file = LOCAL_FILE . '/' . $path.'.html';
    if(file_exists($check_file)){
        echo "exists";
    }else{
        $fp = fopen(($file.'.html'), 'w');
        fwrite($fp, "");
        fclose($fp);    
    }
?>