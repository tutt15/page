<?php

include dirname(__DIR__)."/connect/db.php"; 
include_once dirname(__DIR__).'/config/config.php';

class DataOperation extends Database
{
	
	//Display all page
	public function listAllValue($table, $where = array(), $fields = array(), $search = array() ){
		if ($table == '') {
			return false;
		}
		$colums = '*';
		if (!empty($fields)) {
			$colums = implode(',',$fields);
		}
		//clause query after from table 
		$clause = '';
		if(!empty($where)){
			$clause = implode(',',$where);
		}
		$search = '';
		$array = array();
		$sql = 'SELECT  '.$colums.' FROM '.$table.' WHERE  '.$clause;
		$results = mysqli_query($this->con,$sql);
		while($row = mysqli_fetch_assoc($results)){
		 		$array[] = $row;
	 	}
		return $array;

	}
	//Display values according to the input fields with the condition
	public function listByValue($table, $where = array(), $fields = array()){
		if($table == ''){
			return false;
		}
		$colums = '*';
		$condition = '';
		if (!empty($fields)) {
			$colums = implode(',',$fields);
		}
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$condition .= $key . "='" . $value . "' AND ";
			}
		}
		$condition = substr($condition, 0 , -4);
		$sql = 'SELECT '.$colums.' FROM '.$table.' WHERE '.$condition ;
		//var_dump($sql);die();
		$query = mysqli_query($this->con,$sql);
		// if (!$query) {
		// 	printf("Error: %s\n", mysqli_error($this->con));
		// 	exit();
		$result = mysqli_fetch_array($query);
		return $result;
	}

	public function list($table, $where = array(), $fields = array()){
		if($table == ''){
			return false;
		}
		$colums = '*';
		$condition = '';
		if (!empty($fields)) {
			$colums = implode(',',$fields);
		}
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$condition .= $value ;
			}
		}
		$condition = substr($condition, 0 , -4);
		$sql = 'SELECT '.$colums.' FROM '.$table.' WHERE '.$condition ;
		$query = mysqli_query($this->con,$sql);
		// if (!$query) {
		// 	printf("Error: %s\n", mysqli_error($this->con));
		// 	exit();
		$result = mysqli_fetch_array($query);
		return $result;
	}
	
	//Display values according to the clauses: (ex: COUNT(), MAX(), MIN(), AVG(), SUM())
	public function listAllValueByClause($table, $where = array(), $fields = array() ){
		if ($table == '') {
			return false;
		}
		$colums = '*';
		if (!empty($fields)) {
			$colums = implode(',',$fields);
		}
		//clause query after from table 
		$clause = '';
		if(!empty($where)){
			$clause = implode(',',$where);
		}
		$array = array();
		$sql = 'SELECT '.$clause.'('.$colums.')'.' FROM '.$table;
		
		//var_dump($sql);die();
		$results = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_row($results);  
		return $row;
 
	}

	//Create new page
	public function insert($table, $fields = array()){
		if($table == ''){
			return false;
		}
		$sql = 'INSERT INTO '.$table;
		$sql .= '('.implode(',',array_keys($fields)).') VALUES';
		$sql .= "('".implode("','", array_values($fields))."')";
		$result = mysqli_query($this->con,$sql);
		if($result){
			return true;
		}
		return false;
	}

	//Update page 
	public function update($table, $where = array() , $fields = array()){
		if($table == ''){
			return false;
		}
		$colums = '';
		$condition = '';
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$condition .= $key . " = '" . $value . "' AND ";
			}
		}
		$condition = substr($condition, 0, -4);
		if(!empty($fields)){
			foreach ($fields as $key => $value) {
				$colums .= $key . " = '" .$value. "',";
			}
		}
		$colums = substr($colums, 0 , -1);
		$sql = 'UPDATE '.$table.' SET '.$colums.' WHERE '.$condition;
		$result = mysqli_query($this->con,$sql);
		if($result){
			return true;
		}
		return false;
	}

	public function delete($table, $where = array()){
		if ($table == '') {
			return false;
		}
		$condition = '';
		if(!empty($where)){
			foreach ($where as $key => $value) {
				$condition .= $key . "='" . $value . "'AND";
			}
		}
		$condition = substr($condition, 0 , -3);
		$sql = 'DELETE FROM '.$table.'  WHERE '.$condition;
		if(mysqli_query($this->con,$sql)){
			return true;
		}
		return false;
	}

}
?>
