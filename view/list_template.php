<!DOCTYPE html>
<html>
<head>
	<title>List template</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" name="viewport" content="width=device-width,initial-scale=1.0" />
	<link rel="icon" type="image/png" href="/asset/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/asset/css/style.css">
	<link rel="stylesheet" href="/asset/bootstrap/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body style="background-color: #e9ecef;">
	<div class="container mt-5">
		<div class="mana-templ">
			<h3 class="text-center">TEMPLATE MANAGEMENT</h3>
		</div>
		<form  id="sbform" action="<?php dirname(__DIR__) ?>/controller/page.php" method="post" class="mt-4" >
			<div class="action mb-4">
				<a href="list.php" class="btn btn-danger btn-sm" style="margin-top: 33px"><i class="fa fa-fw fa-home"></i>Home</a>
				<a href="create_template.php" class="btn btn-dark btn-sm" style="margin-top: 33px"><i class="fa fa-fw fa-plus-circle"></i>Add</a>
				<button  class="btn btn-dark btn-sm" name="del-templ" onclick="return submitForm()" style="margin-top: 33px"><i class="fa fa-fw fa-trash-alt"></i>Del</button>
			</div>
		
			<table class="w3-table-all w3-card-4 table-bordered">
				<thead>
					<tr class="bg-info" style="display: table-row;">
						<th class="text-center">
							<input type="checkbox" id="select_all" />
						</th>
						<th scope="col" class="text-center">Name</th>
						<th scope="col" class="text-center">Src</th>
						<th scope="col" class="text-center">Detail</th>
					</tr>
				<?php
					include dirname(__DIR__). "/model/action.php";
					$obj = new DataOperation;
					$list_all_templ = $obj->listAllValue("template");
				 ?>
				<tbody>
					<?php foreach ($list_all_templ as $key => $templ) { ?>
					<tr>
						<td class="text-center">
							<input type="checkbox" class="checkbox" name="checkbox[]" value="<?php echo $templ["id"]; ?>">
						</td>
						<td class="text-center"><?php echo $templ['template_name']?></td>
						<td class="text-center"><?php echo $templ['template_src']?></td>
						<td class="text-center">
							<a href="detail_template.php?id=<?php echo $templ['id'] ?>">
								<i class="fa fa-info-circle" aria-hidden="true" style="color: green"></i>
							</a>
						</td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
		</form>
	</div>
</body>
<script src="/asset/js/jquery.js"></script>
<script src="/asset/js/popper.min.js"></script>
<script src="/asset/bootstrap/js/bootstrap.min.js"></script>
<script src="/asset/js/a076d05399.js"></script>
<script src="/asset/js/validate.min.js"></script>
<script src="/asset/js/validate.js"></script>
<script src="/asset/js/additional-methods.js"></script>
<script src="/asset/js/validate-checkbox.js"></script>
</html>