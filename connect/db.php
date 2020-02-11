<?php
 	include_once dirname(__DIR__).'/config/config.php';
class Database
{
	public $con;
	public function __construct(){
		$this->con = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
		if (!$this->con) {
			echo "Error in Connecting ".mysqli_connect_error();
		}
		mysqli_set_charset($this->con, "utf8");
	}
}

?>
