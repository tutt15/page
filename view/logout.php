<?php
   include dirname(__DIR__) . "/templates/page/header.php";
   session_start();
   if(session_destroy())
   {
      header("Location: login.php");
   }
?>