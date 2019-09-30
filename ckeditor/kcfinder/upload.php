<?php

define("FTPHOST", "169.254.214.253");
define("FTPUSER","tututu");
define("FTPPASS","12345678");
define("ROOT_PATH","/page-master");

$conn_id = ftp_connect(FTPHOST) or die("Couldn't connect to $ftpHost");
ftp_login($conn_id, FTPUSER, FTPPASS);

/** This file is part of KCFinder project
  *
  *      @desc Upload calling script
  *   @package KCFinder
  *   @version 2.51
  *    @author Pavel Tzonkov <pavelc@users.sourceforge.net>
  * @copyright 2010, 2011 KCFinder Project
  *   @license http://www.opensource.org/licenses/gpl-2.0.php GPLv2
  *   @license http://www.opensource.org/licenses/lgpl-2.1.php LGPLv2
  *      @link http://kcfinder.sunhater.com
  */

require "core/autoload.php";

$uploader = new uploader();
$uploader->upload();

$urlReturn = $uploader->filePath;


// $urlLocal = str_replace("%20", " ", $urlReturn);

$localPath = "C:/xampp/htdocs" . $urlReturn;

$ftp_path = str_replace(ROOT_PATH, "", $urlReturn);

// $ftp_path = "/test.jpg";


$upload = ftp_put($conn_id, $ftp_path, $localPath, FTP_BINARY);

?>