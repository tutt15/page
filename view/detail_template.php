<?php
	include dirname(__DIR__). "/controller/page.php";

	if(isset($_GET["id"])){
		$id = $_GET["id"] ?? null;
		$where = array(
			"id"=>$id,
		);
		$row = $obj->listByValue("template", $where);
		$templ = $row['template_src'];
		$content_templ = file_get_contents(dirname(__DIR__).'/cat_template/'.$templ);
		echo $content_templ;
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Detail template</title>
</head>
<style type="text/css">
	 .btn1{
        position: fixed;
        top: 300px;
        left: 10px;
        border-radius: 30px;
        border: none;
        width: 50px;
        height: 50px;
        text-align: center;
        font-size: 13px;
    }
</style>
<body>
	<a href="list_template.php" class="btn1 btn-danger btn-circle text-decoration-none" style="padding: 13px 0px">Home</a>
</body>
</html>