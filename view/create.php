<?php
	include dirname(__DIR__)."/model/controller.php";
	include dirname(__DIR__)."/templates/page/header.php";
	
 ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-success text-center mt-3 mb-4">CREATE PAGE </h2>
			<a href="list.php" class="btn btn-danger"><i class="fa fa-home"></i></a>
			<form method="POST" id="frmCreate" action="../model/controller.php">
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
<script type=text/javascript>
	$(document).ready(function(){
		$('#frmCreate').validate({
			ignore: [],
			debug: false,
			rules:{
				title:{
					required: true,
				},
				content:{
					required: function(textarea) {
						CKEDITOR.instances[textarea.id].updateElement(); // update textarea
						var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); // strip tags
						return editorcontent.length === 0;
					}
				},
			},
			messages:{
				title:{
					required: "Please enter title",
				},	
				content:{
					required: "Please enter content",
				}
			}
		});
	});
</script>
<?php 
	include dirname(__DIR__)."/templates/page/footer.php";
?>
