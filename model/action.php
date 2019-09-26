<?php

include dirname(__DIR__)."/connect/db.php"; 
$ROOT_PATH = "http://localhost/page-master";

class DataOperation extends Database
{
	public function insertPage($table,$fileds){
		$sql = "";
		$sql .= "INSERT INTO ".$table;
		$sql .= " (".implode(",", array_keys($fileds)).") VALUES ";
		$sql .= "('".implode("','", array_values($fileds))."')";
		$query = mysqli_query($this->con,$sql);
		if($query){
			return true;
		}

	}
	public function listPage ($table){
		$sql = "SELECT * FROM ".$table;
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while($row = mysqli_fetch_assoc($query)){
			$array[] = $row;
		}
		return $array;
	}
	public function listPageId($table,$where){
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value . "' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql .= "SELECT * FROM ".$table." WHERE ".$condition;
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_array($query);
		return $row;
	}
	public function updatePage($table,$where,$fields){
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value . "' AND ";
		}
		$condition = substr($condition, 0, -5);
		foreach ($fields as $key => $value) {
			$sql .= $key . "='".$value."', ";
		}
		$sql = substr($sql, 0,-2);
		$sql = "UPDATE ".$table." SET ".$sql." WHERE ".$condition;
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}
	public function deletePage($table,$where){
		$sql = "";
		$condition = "";
		foreach ($where as $key => $value) {
			$condition .= $key . "='" . $value . "' AND ";
		}
		$condition = substr($condition, 0, -5);
		$sql = "DELETE FROM ".$table." WHERE ".$condition;
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}
}

	$obj = new DataOperation;


	if(isset($_POST["create"])){
		$myArray = array(
			"title" => $_POST["title"],
			"content" => $_POST["content"] 
		);
		if($obj->insertPage("page",$myArray)){
			header("location:$ROOT_PATH/view/list.php?msg=Page Inserted");
		}
	}

	if(isset($_POST["edit"])){
		$id = $_POST["id"];
		$where = array("id"=>$id);
		$myArray = array(
			"title" => $_POST["title"],
			"content" => $_POST["content"] 
		);
		if($obj->updatePage("page",$where,$myArray)){
			header("location:$ROOT_PATH/view/list.php?msg=pageUpdated Successfully");
		}

	}

	if(isset($_GET["delete"])){
		$id = $_GET["id"] ?? null;
		$where = array("id"=>$id);
		if($obj->deletePage("page",$where)){
			header("location:$ROOT_PATH/view/list.php?msg=Page Deleted Successfully");
		}
	}

?>