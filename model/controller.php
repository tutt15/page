<?php
include_once dirname(__DIR__).'/model/action.php';
$obj = new DataOperation;

if(isset($_POST["create"])){
		$title = $_POST['title'];
		$title = htmlspecialchars(trim($title));
		$content = htmlspecialchars_decode( $_POST['content']);
		
		if($obj->insertPage($title,$content)){
			$imgArr = strFindImg($content);
			// get last id
			var_dump($obj->getLastId());
			// save img for page Id : $id
			// 
			header("location:../view/list.php?msg=Page Inserted");
		}
	}

if(isset($_POST["edit"])){
	$id = $_POST["id"];
	$title = htmlspecialchars($_POST['title']);
	$content = addslashes($_POST['content']);

	if($obj->updatePage($id, $title, $content)){
		header("location:../view/list.php?msg=Updated Successfully");
	}
}
if(isset($_GET["delete"])){
	$id = $_GET["id"] ;
	if($obj->deletePage($id)){
		header("location:../view/list.php?msg=Page Deleted Successfully");
	}
}
