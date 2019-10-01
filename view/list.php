<?php
	include dirname(__DIR__) . "/templates/page/header.php";
	include dirname(__DIR__)."/model/action.php";
	include dirname(__DIR__)."/model/fs.php";
	include dirname(__DIR__) . "/view/session.php";
	include dirname(__DIR__). "/connect/ftpconect.php";
	include dirname(__DIR__). "/view/upload.php";
	//Check $_SESSION['username'] 
	if(!isset($_SESSION['username'])){
		header("location:login.php");
	  }
 ?>
<?php 
//Check  upload
 if (empty($_POST['checkbox'])) {
		if (isset($_POST['submit'])){
			echo "<div class='container alert alert-info'>Please choose page upload</div>";
		}
	}
	elseif (isset($_POST['submit'])) {
		if (!empty($_POST['checkbox'])) {
			$fs = new FS;
			foreach ($_POST['checkbox'] as $key => $value) {
				// FTP Upload file to server
				$page = $obj->listPageId($value);
				$content = $fs->setContent($page);
				$file_pointer = '../'. 'page'. $value .'.html'; 
				file_put_contents($file_pointer, $content);

				$subject = file_get_contents('../'. 'page'. $value .'.html');
				$update = '../'. 'page'. $value .'.html';
				$pattern = "/\/page-master\//";
				$replace = '';
				file_put_contents($update,preg_replace($pattern, $replace, $subject));

				$local_file = ROOT_PATH.'/'.'page'. $value .'.html';
				$ftp_path = '/'.'page'. $value .'.html';
				$upload = ftp_put($conn_id, $ftp_path, $local_file, FTP_ASCII);

				// Update status page
				$dataOperation = new DataOperation();
				$dataOperation->updateStatusPage($value);
			}
			if ($upload) {
				echo "<div class='container alert alert-success'>Upload successfull.</div>";
			}else{
				echo "<div class='container alert alert-danger'>Upload fails.</div>";
			}
		}
	}
	//Delete page
	if (isset($_POST['submitDel'])) {
		if (!empty($_POST['delete'])) {
			foreach ($_POST['delete'] as $key => $value) {
				//Delete one page
				$page = $obj->deletePage($value);
				$link  = dirname(__DIR__).'/'.'page'. $value .'.html';
				$ftp_path = '/'.'page'. $value .'.html';

				$file = 'page'. $value .'.html';
				$contents_on_server = ftp_nlist($conn_id, '.');
                if (in_array($file, $contents_on_server) && ($file != NULL)) {
					unlink($link);
					if(ftp_delete($conn_id, $ftp_path)){
						echo "<div class='container alert alert-success'>Delete successfull.</div>";
					}else{
						echo "<div class='container alert alert-danger'>Delete fails.</div>";
					}
                }
			}
		}
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
				<form action="" method="POST">
					<table class="table table-bordered">
						<tr class=" text-center">
							<th>STT</th>
							<th>Title</th>
							<th>Edit</th>
							<th>Delete</th>
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
								<?php echo $row["title"]; ?>
							</td>
							<td>
								<a href="update.php?update=1&id=<?php echo $row["id"]; ?>" class="btn btn-info"><i class="far fa-edit"></i></a>
							</td>
							<td>
								<!-- <a href="<?php  echo ROOT_PATH.'/model/action.php'?>?delete=1&id=<?php echo $row["id"]; ?>" name="delete" onclick='return confirm("Are you sure you want to delete?");' class="btn btn-danger"><i class="fas fa-trash"></i></a> -->
								<input type="checkbox" class="checkbox_delete"  name="delete[]" value="<?php echo $row["id"] ;?>">
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
						<button class="btn btn-success" type="submit" name="submit">Upload</button>
						<button class="btn btn-success" type="submitDel" name="submitDel">Delete</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
 </body>
 <script type="text/javascript">
	var select_all = document.getElementById("select_all"); //select all checkbox
	var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

	//select all checkboxes
	select_all.addEventListener("change", function(e){
		for (i = 0; i < checkboxes.length; i++) { 
			checkboxes[i].checked = select_all.checked;
		}
	});

	for (var i = 0; i < checkboxes.length; i++) {
		checkboxes[i].addEventListener('change', function(e){ //".checkbox" change 
			//uncheck "select all", if one of the listed checkbox item is unchecked
			if(this.checked == false){
				select_all.checked = false;
			}
			//check "select all" if all checkbox items are checked
			if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
				select_all.checked = true;
			}
		});
	}
 </script>



