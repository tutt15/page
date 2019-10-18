<?php
	include dirname(__DIR__)."/controller/page.php";
	include dirname(__DIR__)."/templates/page/header.php";
 ?>
 <style>
	.error{
		color:red;
	}
 </style>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-success text-center mt-3 mb-4">CREATE PAGE </h2>
			<a href="list.php" class="btn btn-danger"><i class="fa fa-home"></i></a>
			<form method="POST" id="frmCreate" action="<?php dirname(__DIR__) ?>/controller/page.php">
				<table class="table table-hover">
					<tr>
						<td>Title</td>
						<td><input type="text" class="form-control" name="title" id = "title" placeholder="Enter Title" ></td>
					</tr>
					<tr>
						<td>Content</td>
						<td>
							<textarea type="text" class="form-control ckeditor" id="content" name="content" placeholder="Enter Content"></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" text-align="center"><input type="submit" name="create" class="btn btn-primary"  value="Add"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" src="/asset/js/validate_form_create.js"></script>
<?php include dirname(__DIR__)."/templates/page/footer.php";?>
