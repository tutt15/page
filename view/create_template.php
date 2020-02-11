<?php 
	session_start();
	if(!isset($_SESSION['username'])){
		header("location:login.php");die();
	}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Create template</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0" />
	<link rel="icon" type="image/png" href="/asset/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/asset/css/style.css">
	<link rel="stylesheet" href="/asset/bootstrap/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
	<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-success text-center mt-3 mb-4">CREATE TEMPLATE </h2>
			<a href="list_template.php" class="btn btn-danger"><i class="fa fa-home"></i></a>
			<form enctype = "multipart/form-data" id="frmtempl"  action="<?php dirname(__DIR__) ?>/controller/page.php" method="POST">
				<table class="table table-hover">
					<tr>
						<td>Name</td>
						<td>
							<input type="text" class="form-control" name="name" id = "name"  placeholder="Nhập tên" >
						</td>
					</tr>
					<tr>
						<td>Html</td>
						<td>
							<input type="file"  id="filehtml" name="filehtml" accept="text/html">
						</td>
					</tr>
					<tr>
						<td>File css</td>
						<td>
							<input type="file"  id="filezip" name="filezip" accept=".zip"/>
						</td>
					</tr>
					<tr>
						<td colspan="2" text-align="center">
							<input type="submit" name="add-templ" id = "add-templ" class="btn btn-primary" value="Add">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/asset/js/popper.min.js"></script>
<script src="/asset/bootstrap/js/bootstrap.min.js"></script>
<script src="/ckeditor/ckeditor.js"></script>
<script src="/asset/js/a076d05399.js"></script>
<script src="/asset/js/validate.min.js"></script>
<script src="/asset/js/validate.js"></script>
<script src="/asset/js/additional-methods.js"></script>
<script type="text/javascript" >
	$(document).ready(function(){
		$('#frmtempl').validate({
        ignore: [],
        debug: false,
        rules:{
            name:{
                required: true,
                maxlength: 10
            },
            filehtml:{
                required: true,
                accept: "text/html"
            },
            filezip:{
                required: true,
                accept: "application/octet-stream,application/zip,application/x-zip,application/x-zip-compressed"
            }
        },
        messages:{
            name:{
                required: "Vui lòng nhập tên template",
                maxlength: "Vui lòng nhập tên không quá 10 kí tự"
            },
            filehtml:{
                required: "Vui lòng upload file html",
                accept: "Vui lòng upload file html"
            },
            filezip:{
                required: "Vui lòng upload file zip",
                accept: "Vui lòng upload file zip"
            }
        }
    });
});
	
</script>
</body>
</html>