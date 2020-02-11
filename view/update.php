<?php
	include dirname(__DIR__). "/templates/page/header.php";
	include dirname(__DIR__). "/controller/page.php";
	include dirname(__DIR__)."/view/session.php";

	if(isset($_GET["id"])){
		$id = $_GET["id"] ?? null;
		$where = array(
			"id"=>$id,
		);
		$row = $obj->listByValue("page", $where);
	}
?>

<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-success text-center mt-3 mb-4">UPDATE PAGE </h2>
			<a href="list.php" class="btn btn-danger"><i class="fa fa-home"></i></a>
			<form method="post" id="frmpage" class="updform" action="<?php dirname(__DIR__) ?>/controller/page.php">
				<table class="table table-hover">
					<input type="hidden" name="id" value="<?php echo $id; ?>">
					<tr>
						<td>Title</td>
						<td>
							<input type="text" class="form-control" value="<?php echo $row["title"]; ?>" id="title" name="title" placeholder="Enter Title" required>
						</td>
					</tr>
					<tr>
						<td>Content</td>
						<td>
							<textarea type="text" class="form-control" name="content" id="content" placeholder="Enter Content"><?php echo htmlspecialchars($row["content"]); ?></textarea>
						</td>
					</tr>
					<tr>
						<td>Path</td>
						<td><input type="text" class="form-control" name="path" id = "path" placeholder="Enter Path" value="<?php echo $row["path"]; ?>" disabled ></td>
					</tr>
					<tr>
						<td colspan="2" text-align="center">
							<!-- <button class="btn btn-outline-warning" type="button" data-toggle="modal" title="Preview page"  data-target="#readPage " name="submitPreview" ><i class="material-icons">&#xe560;</i></button> -->
							<button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="material-icons">&#xe560;</i></button>
							<input type="submit" class="btn btn-primary" name="edit" value="Update">
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
			$('#pre_title').text(title);
			$('#pre_content').html(content);
		}); 

	}); 
</script>
<script type="text/javascript" src="/asset/js/validate_form.js"></script>
<?php 
	include dirname(__DIR__)."/view/modal_preview_page.php";
	include dirname(__DIR__)."/templates/page/footer.php";
?>
