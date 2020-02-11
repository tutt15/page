<?php
	include_once dirname(__DIR__).'/model/action.php';
	$obj = new DataOperation;
	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	mysqli_set_charset($conn , "utf8");
	if(isset($_POST["create"])){
		$title = mysqli_real_escape_string($conn, $_POST['title'] );
		$content = mysqli_real_escape_string($conn, $_POST['editor1']);
		$templ = mysqli_real_escape_string($conn, $_POST['templ']);
		$path = mysqli_real_escape_string($conn, $_POST['path-save']);

		$fields = array(
			"title"   => htmlspecialchars(trim($title)),
			"content" => $content,
			"template_id" => $templ,
			"path"    => $path,
        );
    	
    	if($obj->insert("page",$fields)){
			header("location:/view/list.php");
		}
	}
	//update page
	if(isset($_POST["edit"])){
		$id = $_POST["id"];
		$title = mysqli_real_escape_string($conn, $_POST['title'] );
		$content = mysqli_real_escape_string($conn, $_POST['editor1']);
		$templ = mysqli_real_escape_string($conn, $_POST['templ']);
		$status = $_POST['status'];
		$fields = array(
			"title" => htmlspecialchars(trim($title)),
			"content" => $content,
			"template_id" => $templ,
		);
		$where = array(
			"id"=>$id
		);
		$row = $obj->listByValue("page", $where);
		if($row['status'] == "3"){
			$obj->update("page", $where, ["status"=>"2"]);
		}
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


	if(isset($_POST['add-templ'])){
		$name = mysqli_real_escape_string($conn, $_POST['name']);
		$filehtml  = $_FILES['filehtml']['name']; 
		$filezip  = $_FILES['filezip']['name']; 

		// $a = $_FILES["filezip"]["size"] ;
		$fields = array(
			"template_name"   => htmlspecialchars(trim($name)),
			"template_src" => $filehtml,
			"template_css" => $filezip,
        );
        if(isset($_FILES['filehtml']) && ($_FILES['filehtml']['size'] > 0))
		{
		    $path = dirname(__DIR__)."/cat_template/";
		    $path = $path . basename( $_FILES['filehtml']['name']);
		    move_uploaded_file($_FILES['filehtml']['tmp_name'], $path);
		}else{
			echo "<div class='container alert alert-danger'>Fails.</div>";
		}

		if(isset($_FILES['filezip']) && ($_FILES['filezip']['size'] > 0))
		{
		    $path = dirname(__DIR__)."/cat_template/".$name;
		    mkdir($path, 0777, true);
		    $filename = $_FILES['filezip']['name'];
		    $size_file = $_FILES['filezip']['size'];
		    $path_zip = $path;
		    $saved_file_location = $path_zip . $filename;
		    if(move_uploaded_file($_FILES['filezip']['tmp_name'], $saved_file_location)){
		    	global $path_zip;
			    $zip = new ZipArchive();
			    $x = $zip->open($saved_file_location);
			    if($x === true) {
			        $zip->extractTo($path_zip);
			        $zip->close();
			        unlink($saved_file_location);
			    } else {
			        echo "<div class='container alert alert-danger'>Add fails.</div>";
			    }
		    }else {
		        echo "<div class='container alert alert-danger'>Add fails.</div>";
		    }
		}
		if($obj->insert("template",$fields)){
			header("location:/view/list_template.php");
		}
	}

	if(isset($_POST['del-templ'])){
		foreach ($_POST['checkbox'] as $key => $value) {
			$templ = $obj->listByValue('template',['id'=>$value]);
			$templ_name = $templ['template_name'];
			$templ_src = $templ['template_src'];
			$link_templ_local  = dirname(__DIR__).'/cat_template/'. $templ_src ;
			$path_src_zip = dirname(__DIR__).'/cat_template/'.$templ_name;

			$templ_page = $obj->delete('template',['id'=> $value]);
                //delete page in local 
            if(isset($link_templ_local)){
           	 	$teml_db = @unlink($link_templ_local);
            }
            if (is_dir($path_src_zip)) {
            	rmdir($path_src_zip);
            }
            
		}
		if($templ_page == true &&  $teml_db == true){
			header('location:/view/list_template.php');
		}
	}
