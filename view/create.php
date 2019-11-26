<?php	
	include dirname(__DIR__)."/templates/page/header.php";
	include dirname(__DIR__)."/model/action.php";
	$obj = new DataOperation;
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-success text-center mt-3 mb-4">CREATE PAGE </h2>
			<a href="list.php" class="btn btn-danger"><i class="fa fa-home"></i></a>
			<form method="POST" id="frmpage" action="<?php dirname(__DIR__) ?>/controller/page.php">
				<table class="table table-hover">
					<tr>
						<td>Title</td>
						<td>
							<input type="text" class="form-control" name="title" id = "title"  placeholder="Enter Title" >
							<?php 
								if (isset($_GET['error_title'])) {
									echo "<div class='container alert alert-danger'>Title name already exist</div>";
								}
							?>
						</td>
					</tr>
					<tr>
						<td>Content</td>
						<td>
							<textarea type="text" class="form-control ckeditor" id="content" name="content" placeholder="Enter Content"></textarea>
						</td>
					</tr>
					<tr>
						<td>
							<button type="button" class="btn btn-success" data-toggle="modal" data-target="#myModal" >Path</button>
						</td>
						<td>
							<input type="text" class="form-control ckeditor" id="path_name" name="path" placeholder="Enter Path">
						</td>
					</tr>
					<tr>
						<td colspan="2" text-align="center">
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="material-icons">&#xe560;</i></button>
							<input type="submit" name="create" id = "create" class="btn btn-primary"   value="Add">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() { 

		$("button").click(function() { 
			var title = $("#title").val();  
			var content = CKEDITOR.instances['content'].getData();

			document.getElementById("pre_title").innerHTML = title; 
			document.getElementById("pre_content").innerHTML = content; 
		}); 

	}); 
</script>
<script type="text/javascript" src="/asset/js/validate_form.js"></script>
<?php include dirname(__DIR__)."/view/modal_path.php";?>
<?php include dirname(__DIR__)."/view/modal_preview_page.php";?>
<?php include dirname(__DIR__)."/templates/page/footer.php";?>
