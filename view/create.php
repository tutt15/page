<?php
	include dirname(__DIR__)."/model/action.php";
	include dirname(__DIR__)."/templates/page/header.php";

	include dirname(__DIR__)."/view/session.php";

	if(!isset($_SESSION['username'])){
		header("location:login.php");
	  }

 ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-success text-center mt-3 mb-4">CREATE PAGE </h2>
			<a href="list.php" class="btn btn-danger"><i class="fa fa-home"></i></a>
			<form method="post" action="<?php echo ROOT_PATH.'/model/action.php'?>">
				<table class="table table-hover">
					<tr>
						<td>Title</td>
						<td><input typeS="text" class="form-control" name="title" placeholder="Enter Title" required></td>
					</tr>
					<tr>
						<td>Content</td>
						<td>
							<textarea type="text" class="form-control ckeditor" id="content" name="content" placeholder="Enter Content" required="required"></textarea>
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
<script type="text/javascript" >
	$("form").submit( function(e) {
            var messageLength = CKEDITOR.instances['content'].getData().replace(/<[^>]*>/gi, '').length;
            if( !messageLength ) {
                alert( 'Please enter content' );
                e.preventDefault();
            }
        });
</script>
<?php 
	include dirname(__DIR__)."/templates/page/footer.php";
?>