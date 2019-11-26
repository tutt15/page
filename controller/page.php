<?php
	include_once dirname(__DIR__).'/model/action.php';
	$obj = new DataOperation;
	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	
	if(isset($_POST["create"])){
		$title = mysqli_real_escape_string($conn, $_POST['title'] );
		$content = mysqli_real_escape_string($conn, $_POST['content']);
		$path = mysqli_real_escape_string($conn, $_POST['path']);
		$fields = array(
			"title"   => htmlspecialchars(trim($title)),
			"content" => $content,
			"path"    => $path,
        );
        $title = $_REQUEST['title'];
		$query = "select * from page where title ='" . $title . "' ";
        $sql = mysqli_query($conn,$query);
        $record = mysqli_num_rows($sql);
    
        if ($record) {
            header("location:/view/create.php?error_title");
        }else{
			if($obj->insert("page",$fields)){
				header("location:/view/list.php");
			}
        }
	}
	//update page
	if(isset($_POST["edit"])){
		$id = $_POST["id"];
		$title = mysqli_real_escape_string($conn, $_POST['title'] );
		$content = mysqli_real_escape_string($conn, $_POST['content']);
		$fields = array(
			"title" => htmlspecialchars($title),
			"content" => $content,
		);
		$where = array(
			"id"=>$id
		);
		
		if($obj->update("page",$where,$fields)){
			header("location:/view/list.php");
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

