<?php
function dirToArray($dir)
{

   $result = array();
   $cdir = scandir($dir);

   foreach ($cdir as $value) {
      if (!in_array($value, array(
         ".", "..", ".vscode", "config", "common.php", "connect", "controller", "model", "templates",
         "view", ".git", ".htaccess", "asset", "ckeditor", "db_page.sql", "test.php", "modal.php", "result.php", "preview", "search.php", "test.php", "cat_template"
      ))) {
         if (is_dir($dir . DIRECTORY_SEPARATOR . $value)) {
             $result[] =  $value;
             natcasesort($result);
            // dirToArray($dir . DIRECTORY_SEPARATOR . $value);
            $value = $dir . DIRECTORY_SEPARATOR . $value;
         } else {
            $result[] = $value;
         }
      }
   }

   // foreach($result as $ff => $subfolderDir)
   //  {
   //      dirToArray($subfolderDir.DIRECTORY_SEPARATOR. $ff);
   //  }

   return $result;
}
function multi_strpos($haystack, $needles, $offset = 0) {
 
   foreach ($needles as $n) {
          if (strpos($haystack, $n, $offset) !== false)   
                return strpos($haystack, $n, $offset);
   }
   return false;
}
