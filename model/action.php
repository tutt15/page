<?php

include dirname(__DIR__)."/connect/db.php"; 
include_once dirname(__DIR__).'/config/config.php';
include_once dirname(__DIR__).'/helpers/string_find.php';

class DataOperation extends Database
{
	//Create new page
	public function insertPage($title, $content){
		$stmt = $this->con->prepare('INSERT INTO page (title, content) VALUES (?,?)') ;
		$stmt->bind_param("ss", $title, $content);
		$row = $stmt->execute();
		if($row){
			return true;
		}else{
			return false;
		}
		$stmt->close(); 
	}


	public function getLastId(){
		$sql = "SELECT MAX(id) AS id FROM page LIMIT 1";
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_array($query);
		return $row['id'];
	}

	//Display all page
	public function listPage (){
		$sql = "SELECT * FROM page";
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while($row = mysqli_fetch_assoc($query)){
			$array[] = $row;
		}
		return $array;
	}

	//Display page follow id
	public function listPageId($id){
		$sql = "SELECT * FROM page WHERE id = $id";
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_array($query);
		return $row;
	}

	//Update page 
	public function updatePage($id, $title, $content){
		$sql = "UPDATE page SET title = '$title',content = '$content' WHERE id = $id ";
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}

	public function updateFile($id,$upload){
		$sql = "UPDATE page SET upload = '$upload' WHERE id = $id ";
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}

	//Delete page
	public function deletePage($id){
		$sql = "DELETE FROM page WHERE id = '$id'";
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}

	//Update status page
	public function updateStatusPage($id){
		$page = $this->listPageId($id);
		switch ($page['status']) {
			case STATUS_NEW:
				$status = STATUS_PUBLIC;
				break;
			case STATUS_PUBLIC:
				$status = STATUS_PUBLIC;
				break;
		}
		$sql = "UPDATE page SET status = '$status' WHERE id = $id ";
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}
}
	
?>
