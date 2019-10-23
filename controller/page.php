<?php
	include_once dirname(__DIR__).'/model/action.php';
	$obj = new DataOperation;

	if(isset($_POST["create"])){
		$fields = array(
			"title"   => htmlspecialchars(trim($_POST['title'])),
			"content" => $_POST['content'],
		);
		if($obj->insert("page",$fields)){
			header("location:/view/list.php?msg");
		}
	}
	//update page
	if(isset($_POST["edit"])){
		$id = $_POST["id"];
		$fields = array(
			"title" => htmlspecialchars($_POST["title"]),
			"content" => addslashes($_POST["content"]) 
		);
		$where = array(
			"id"=>$id
		);
		
		if($obj->update("page",$where,$fields)){
			header("location:/view/list.php?msg");
		}
	}

	if(isset($_GET["delete"])){
		$id = $_GET["id"] ;
		$where = array(
			"id" => $id,
		);
		if($obj->delete("page", $where)){
			header("location:/view/list.php");
		}
	}
