<?php
function dirToArray($dir) {
  
   $result = array();

   $cdir = scandir($dir);
   foreach ($cdir as $value)
   {
      if (!in_array($value,array(".","..", ".vscode", "config", "common.php", "connect", "controller", "model", "templates", 
      "view", ".git", ".htaccess", "asset", "ckeditor", "db_page.sql", "test.php", "modal.php","result.php", "preview")))
      {
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value))
         {
            $result[] =  $value;
            $value = $dir . DIRECTORY_SEPARATOR . $value;
         }
         else
         {
            $result[] = $value;
         }
      }
   }
   

   return $result;
}

function mkdir_r($dirName, $rights=0777){
   $dirs = explode('/', $dirName);
   $dir='';
   foreach ($dirs as $part) {
       $dir.=$part.'/';
       if (!is_dir($dir) && strlen($dir)>0)
           mkdir($dir, $rights);
   }
}
?>