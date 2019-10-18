<?php

include dirname(__DIR__)."/connect/db.php"; 
include_once dirname(__DIR__).'/config/config.php';

class DataOperation extends Database
{
	//Create new page
	public function insert($table, $fields = array()){
		if($table == ""){
			return false;
		}
		$sql = "";
		$sql .= "INSERT INTO ".$table;
		$sql .= "(".implode(",",array_keys($fields)).") VALUES";
		$sql .= "('".implode("','", array_values($fields))."')";
		$result = mysqli_query($this->con,$sql);
		if($result){
			return true;
		}
	}

	//Display all page
	public function listPage ($table){
		if($table == ""){
			return false;
		}
		$sql = "SELECT * FROM ".$table;
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while($row = mysqli_fetch_assoc($query)){
			$array[] = $row;
		}
		return $array;
	}

	public function listPageById($table, $where = array()){
		if($table == ""){
			return false;
		}
		$colums = "*";
		$condition = "";
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$condition .= $key . "='" . $value . "'AND";
			}
		}
		$condition = substr($condition, 0 , -3);
		$sql = "SELECT $colums FROM $table WHERE $condition ";
		$query = mysqli_query($this->con,$sql);
		$result = mysqli_fetch_array($query);
		return $result;
	}

	//Update page 
	public function update($table, $where = array() , $fields = array()){
		if($table == ""){
			return false;
		}
		$colums = "";
		$condition = "";
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$condition .= $key . "='" . $value . "'AND";
			}
		}
		$condition = substr($condition, 0, -3);
		if(!empty($fields)){
			foreach ($fields as $key => $value) {
				$colums .= $key . "='" .$value. "',";
			}
		}
		$colums = substr($colums, 0 , -1);
		$sql = "UPDATE $table SET $colums WHERE $condition ";
		//var_dump($sql);die();
		$result = mysqli_query($this->con,$sql);
		if($result){
			return true;
		}
	}

	public function delete($table, $where = array()){
		if ($table == "") {
			return false;
		}
		$condition = "";
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$condition .= $key . "='" . $value . "'AND";
			}
		}
		$condition = substr($condition, 0 , -3);
		$sql = "DELETE FROM $table  WHERE $condition";
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}

}
?>
