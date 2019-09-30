<?php
	include dirname(__DIR__) . "/templates/page/header.php";
	include dirname(__DIR__)."/model/action.php";
	include dirname(__DIR__)."/model/fs.php";
	include dirname(__DIR__) . "/view/session.php";
	include dirname(__DIR__). "/connect/ftpconect.php";
	if(!isset($_SESSION['username'])){
		header("location:login.php");
	  }
 ?>
  <?php 
 if (empty($_POST['checkbox'])) {
		if (isset($_POST['submit'])){
			echo "<div class='alert alert-success'>Please choose page upload</div>";
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


				$local_file = 'C:/xampp/htdocs/page-master/'.'page'. $value .'.html';
				$ftp_path = '/'.'page'. $value .'.html';
				$upload = ftp_put($conn_id, $ftp_path, $local_file, FTP_ASCII);

				// Update status page
				$dataOperation = new DataOperation();
				$dataOperation->updateStatusPage($value);

				if ($upload) {
					echo "<div class='alert alert-success'>Upload successfull.</div>";
				}else{
					echo "<div class='alert alert-success'>Upload fails.</div>";
				}
			}
		}
		
	}
	?>

 <body>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<a href="logout.php" class="btn btn-dark"><?php echo "Xin chào,".$_SESSION['username'];?></a>
				<h2 class="text-success text-center mt-3 mb-4">PAGE MANAGEMENT</h2>
				<a href="create.php" class="btn btn-primary float-right mb-3"><i class="fa fa-plus"></i></a>
				<form action="" method="POST">
					<table class="table table-bordered">
						<tr class="bg-success text-center">
							<th>STT</th>
							<th>Title</th>
							<th>Edit</th>
							<th>Delete</th>
							<th>Public</th>
							<th>Status</th>
						</tr>
						<?php
							$myrow = $obj->listPage("page");
							foreach ($myrow as $row) {
						?>
						<tr>
							<td><?php echo $row["id"]; ?></td>
							<td><?php echo $row["title"]; ?></td>
							<td>
								<a href="update.php?update=1&id=<?php echo $row["id"]; ?>" class="btn btn-info"><i class="far fa-edit"></i></a>
							</td>
							<td>
								<a href="<?php  echo ROOT_PATH.'/model/action.php'?>?delete=1&id=<?php echo $row["id"]; ?>" onclick='return confirm("Are you sure you want to delete?");' class="btn btn-danger"><i class="fas fa-trash"></i></a>
							</td>
							<td>
								<input type="checkbox"  name="checkbox[]" value="<?php echo $row["id"] ;?>">
							</td>
							<td>
								<p type="text"  name="status" value="" ><?php echo $row['status']; ?></p>
							</td>
						</tr>
						<?php
							}
						?> 
					</table>
					<div class="text-center">
						<button class="btn btn-success" type="submit" name="submit">Upload</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
 </body>


