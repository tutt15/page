<?php
	include dirname(__DIR__) . "/templates/page/header.php";
	include dirname(__DIR__) . "/controller/page.php";
	include dirname(__DIR__) . "/connect/ftpconect.php";
	include dirname(__DIR__) . "/controller/delete.php";
	include dirname(__DIR__) . "/controller/upload.php";


	if(isset($_GET['msg'])){
		echo "<div class='container alert alert-success'>Succeeded!</div>";
	}
	if (isset($_GET["page"])) {
		$page  = $_GET["page"]; 
	} 
	else{ 
		$page=1;
	} 
	$limit = 5; 
	$offset = ($page-1) * $limit;  
	
  
 ?>
 <body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a href="" class="btn btn-dark mt-3"><?php echo "Xin chào,".$_SESSION['username'];?></a>
				<a href="logout.php" class="btn btn-dark float-right mt-3">Logout</a>
				<h2 class=" text-center mt-3 mb-4">PAGE MANAGEMENT</h2>
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
							$list_all_page = $obj->listAllValue('page', ["ORDER BY `id` ASC LIMIT $offset, $limit"]);
							foreach ($list_all_page as $row) {
						?>
						<tr>
							<td><?php echo $row["id"]; ?></td>
							<td>
								<?php 
									if($row['status'] == "Public" ){
									?>
										<a href="ftp://<?php echo FTPHOST.'/'.$row['id'].$row['upload']; ?>" target="_blank" ><?php echo $row['title'];?></a>
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
					<div>
						<button class="btn btn-success float-right" type="submitDel" name="submitDel" onclick="return submitForm()"><i class="fa fa-trash"></i></button>
						<button class="btn btn-success float-right" type="submit"    name="submit"    onclick="return submitForm()"><i class="fa fa-upload"></i></button>
					</div>
					<?php  
						$result_db = $obj->listAllValueByClause('page', ['COUNT']);
						$total_records = $result_db[0];
						$total_pages = ceil($total_records / $limit); 
						$panigate = "<ul class='pagination'>";  
						for ($i=1; $i<=$total_pages; $i++) {
								$panigate .= "<li class='page-item'><a class='page-link' href='list.php?page=".$i."'>".$i."</a></li>";	
						}
						echo $panigate . "</ul>";  
?>
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