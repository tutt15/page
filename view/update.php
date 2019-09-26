<?php
include dirname(__DIR__). "/model/action.php";
include dirname(__DIR__). "/view/header.php";
if(isset($_GET["update"])){
	$id = $_GET["id"] ?? null;
	$where = array("id"=>$id,);
	$row = $obj->listPageId("page",$where);
}
?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<h2 class="text-success text-center mt-3 mb-4">UPDATE PAGE </h2>
			<a href="list.php" class="btn btn-danger"><i class="fa fa-home"></i></a>
			<form method="post" action="<?php echo $ROOT_PATH.'/model/action.php'?>">
				<table class="table table-hover">
					<tr class="hidden">
						<td><input type="hidden" name="id" value="<?php echo $id; ?>"></td>
					</tr>
					<tr>
						<td>Title</td>
						<td><input type="text" class="form-control" value="<?php echo $row["title"]; ?>" name="title" placeholder="Enter Title"></td>
					</tr>
					<tr>
						<td>Content</td>
						<td>
							<textarea type="text" class="form-control" name="content"  placeholder="Enter Content"><?php echo $row["content"]; ?></textarea>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" class="btn btn-primary" name="edit" value="Update"></td>
					</tr>
				</table>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript" >
	CKEDITOR.replace('content');
</script>