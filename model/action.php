<?php

include dirname(__DIR__)."/connect/db.php"; 
include_once dirname(__DIR__).'/config/config.php';

class DataOperation extends Database
{
	//Create new page
	public function insertPage($title, $content){
		$sql ="INSERT INTO page (title,content) VALUES ('$title','$content')";
		$query = mysqli_query($this->con,$sql);
		if($query){
			return true;
		}
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
		$sql = "UPDATE page SET title = '$title', content = '$content' WHERE id = $id ";
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
			case "New":
				$status = "Public";
				break;
			case "Public":
				$status = "Edit";
				break;
			case "Edit":
			    $status = "Edit";
				break;
		}

		$sql = "UPDATE page SET status = '$status' WHERE id = $id ";
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}
}

	$obj = new DataOperation;


	if(isset($_POST["create"])){
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		if($obj->insertPage($title,$content)){
			header("location:".ROOT_PATH."/view/list.php?msg=Page Inserted");
		}
	}

	if(isset($_POST["edit"])){
		$id = $_POST["id"];
		$title = trim($_POST['title']);
		$content = trim($_POST['content']);
		if($obj->updatePage($id, $title, $content)){
			header("location:".ROOT_PATH."/view/list.php?msg=pageUpdated Successfully");
		}
	}
	if(isset($_GET["delete"])){
		session_start();
		if(!isset($_SESSION['username'])){
			header("location:login.php");
		}
		$id = $_GET["id"] ;
		if($obj->deletePage($id)){
			header("location:".ROOT_PATH."/view/list.php?msg=Page Deleted Successfully");
		}
	}

?>
