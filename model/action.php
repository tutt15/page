<?php

include dirname(__DIR__)."/connect/db.php"; 
include_once dirname(__DIR__).'/config/config.php';
class DataOperation extends Database
{
	public function insertPage($title, $content){
		$sql ="INSERT INTO page (title,content) VALUES ('$title','$content')";
		$query = mysqli_query($this->con,$sql);
		if($query){
			return true;
		}
	}
	public function listPage (){
		$sql = "SELECT * FROM page";
		$array = array();
		$query = mysqli_query($this->con,$sql);
		while($row = mysqli_fetch_assoc($query)){
			$array[] = $row;
		}
		return $array;
	}

	public function listPageId($id){
		$sql = "SELECT * FROM page WHERE id = $id";
		$query = mysqli_query($this->con,$sql);
		$row = mysqli_fetch_array($query);
		return $row;
	}

	public function updatePage($id, $title, $content){
		$sql = "UPDATE page SET title = '$title', content = '$content' WHERE id = $id ";
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}

	public function deletePage($id){
		$sql = "DELETE FROM page WHERE id = '$id'";
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}

	public function updateStatusPage($id){
		$page = $this->listPageId($id);
		switch ($page['status']) {
			case 0:
				$status = 1;
				break;
			case 1:
				$status = 2;
				break;
			case 2:
			    $status = 2;
				break;
		}

		$sql = "UPDATE page SET status = $status WHERE id = $id ";
		if(mysqli_query($this->con,$sql)){
			return true;
		}
	}
}

	$obj = new DataOperation;


	if(isset($_POST["create"])){
		$title = $_POST['title'];
		$content = $_POST['content'];
		if($obj->insertPage($title,$content)){
			header("location:".ROOT_PATH."/view/list.php?msg=Page Inserted");
		}
	}

	if(isset($_POST["edit"])){
		$id = $_POST["id"];
		$title = $_POST['title'];
		$content = $_POST['content'];
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