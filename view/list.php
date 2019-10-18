<?php
	include dirname(__DIR__) . "/templates/page/header.php";
	include dirname(__DIR__)."/controller/page.php";
	include dirname(__DIR__). "/connect/ftpconect.php";
	include dirname(__DIR__). "/controller/delete.php";
	include dirname(__DIR__). "/controller/upload.php";

	if(isset($_GET['msg'])){
		echo "<div class='container alert alert-success'>Succeeded!</div>";
	}
 ?>
 <body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a href="" class="btn btn-dark mt-3"><?php echo "Xin chào,".$_SESSION['username'];?></a>
				<a href="logout.php" class="btn btn-dark float-right mt-3">Logout</a>
				<h2 class="text-success text-center mt-3 mb-4">PAGE MANAGEMENT</h2>
				<a href="create.php" class="btn btn-primary float-right mb-3"><i class="fa fa-plus"></i></a>
				<form action="" method="POST" name="frmList" id="sbform">
					<table class="table table-bordered">
						<tr>
							<th>STT</th>
							<th>Title</th>
							<th>Edit</th>
							<th>Status</th>
							<th>
								<input type="checkbox" id="select_all"/>
							</th>
						</tr>
						<?php
							$myrow = $obj->listPage("page");
							foreach ($myrow as $row) {
						?>
						<tr>
							<td><?php echo $row["id"]; ?></td>
							<td>
								<?php 
									if($row['status'] == "Public" ){
									?>
										<a href="ftp://169.254.214.253<?php echo '/'.$row['id'].$row['upload']; ?>" target="_blank" ><?php echo $row['title'];?></a>
									<?php
									}else{
										 echo $row['title'];
									}
								 ?>
							</td>
							<td>
								<a href="update.php?id=<?php echo $row["id"]; ?>" class="btn btn-info"><i class="far fa-edit"></i></a>
							</td>
							<td>
								<p type="text"  name="status" value="" ><?php echo $row['status']; ?></p>
							</td>
							<td>
								<input type="checkbox" class="checkbox"  name="checkbox[]" value="<?php echo $row["id"] ;?>">
							</td>
						</tr>
						<?php
							}
						?> 
					</table>
					<div class="text-center">
						<button class="btn btn-success" type="submit" name="submit" onclick="return submitForm()" >Upload</button>
						<button class="btn btn-success" type="submitDel" name="submitDel" onclick="return submitForm()">Delete</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
 </body>
 <script type="text/javascript" src="/asset/js/validate-checkbox.js"></script>

<script>
	$(document).ready(function() {
    setTimeout(function() {
        $(".alert").alert('close');
    }, 1500);
});
</script>
