<?php
	include dirname(__DIR__) . "/templates/page/header.php";
	include dirname(__DIR__)."/model/controller.php";
	include dirname(__DIR__)."/model/fs.php";
	include dirname(__DIR__) . "/view/session.php";
	include dirname(__DIR__). "/connect/ftpconect.php";
	include dirname(__DIR__). "/view/upload.php";
 ?>
<?php 
//Check  upload
	if (isset($_POST['submit'])) {
		if (!empty($_POST['checkbox'])) {
			$fs = new FS;
			foreach ($_POST['checkbox'] as $key => $value) {
				// FTP Upload file to server
				$page = $obj->listPageId($value);
				$content = $fs->setContent($page);
				$file_pointer = dirname(__DIR__).'/'. 'page'. $value .'.html'; 
				file_put_contents($file_pointer, $content);
				
				$subject = file_get_contents(dirname(__DIR__).'/'. 'page'. $value .'.html');
				$update = dirname(__DIR__).'/'. 'page'. $value .'.html';
				$pattern = "/\/ckeditor/";
				$replace = 'ckeditor';
				file_put_contents($update,preg_replace($pattern, $replace, $subject));
				
				$arr_upload[] =  $value;
				$local_file = dirname(__DIR__).'/'.'page'. $value .'.html';
				$ftp_path = '/'.'page'. $value .'.html';

				//get string in scr= ""
				$regex = '/src="([^"]+)"/'; 
				//return all result link folder image.
				preg_match_all($regex, $content, $matches, PREG_SET_ORDER, 0);
				//folder ftp page.
				$dir_page = ftp_pwd($conn_id).$value;
				//return all folder in folder root ftp
				$content_ftp = ftp_nlist($conn_id,ftp_pwd($conn_id));
				//Check if the public folder is in the ftp directory .
				if(in_array($dir_page,$content_ftp)){

					foreach($matches as $val){
						//get path of images  in the local directory.
						$get_link_img = LOCAL_FILE.$val[1];
						//pathinfo: get infomation path tranmission.
						$path_info = pathinfo($get_link_img);
						//return name image.
						$get_img_name = $path_info['basename'];
						//path folder contain images 
						$link_path = $dir_page.'/'.$get_img_name;
						//using ftp_put transfer images  to folder ftp contain page 
						if(ftp_put($conn_id,$link_path,$get_link_img,FTP_BINARY)){
							$img_using[] = $get_img_name;
						}
					}
					//check the content in folder ftp 
					$check_content_child_folder = ftp_nlist($conn_id, $dir_page);

					foreach($check_content_child_folder as $check){
						var_dump($check_content_child_folder);die();
						$path_info_check = pathinfo($check);
						if($path_info_check['extension']!='hmtl'){
							$list_content[] = $path_info_check['basename'];
							//var_dump($list_content);die();
						}
					}

					//check images in folder page ftp have empty 
					if (!empty($img_using)) {
						$get_array_non_using = array_diff($list_content, $img_using);
						foreach($get_array_non_using as $remove) {
							if (!ftp_delete($conn_id, $dir_page . "/$remove")) {
								echo "Cant delete this file $remove cause file not exist or deleted.";
							}
						}
					}
				}else{
					//If the page directory is not already in the ftp 
					if (ftp_mkdir($conn_id,$dir_page)) {
						foreach($matches as $val){
							$get_link_img = LOCAL_FILE.$val[1];
							$path_info = pathinfo($get_link_img);
							$get_img_name = $path_info['basename'];
							$link_path = $dir_page.'/'.$get_img_name;
							if(!ftp_put($conn_id,$link_path,$get_link_img,FTP_BINARY)){
								echo "Error";
							}
						}
					}
				}
				$link_temp = "file_temp.html";
				$ftp_file= "/".$value."/";
				$replace_up = str_replace("ckeditor/kcfinder/upload/images/",$ftp_file,file_get_contents($local_file));
				file_put_contents($link_temp,$replace_up);
				$upload = ftp_put($conn_id, $dir_page . "/page$value.html", $link_temp, FTP_ASCII);
				file_put_contents($link_temp, "");
				$file_update = 'page'. $value .'.html';
				$dataOperation = new DataOperation();
				// Update link upload 
				$dataOperation->updateFile($value,$ftp_path);
				// Update status page
				 $dataOperation->updateStatusPage($value);
			}
			if ($upload) {
				$id_upload = implode('-', $arr_upload);
				echo "<div class='container alert alert-success'>Upload successfull $id_upload.</div>";
			}else{
				echo "<div class='container alert alert-danger'>Upload fails.</div>";
			}
		}
	}

	//Delete page
	if (isset($_POST['submitDel'])) {
			foreach ($_POST['checkbox'] as $key => $value) {
				//Address page on local 
				$link  = dirname(__DIR__).'/'.'page'. $value .'.html';
				//return list page in folder on FTP server
				$contents_on_server = ftp_nlist($conn_id,'.');
				//name folder page
				$folder_page_ftp = $value;
				//check folder page already in ftp .
				if (in_array($folder_page_ftp, $contents_on_server)) {
					$arDel[] = $value;
					//delete page in database
					$page = $obj->deletePage($value);
					//delete page in local 
					unlink($link);
					//check content inside in folder page.
					$content_folder = ftp_nlist($conn_id, $folder_page_ftp . "/");
					foreach ($content_folder as $need_remove) {
						$need_remove ="/".$need_remove;
						//Delete content in folder page ftp
						if (!ftp_delete($conn_id, $need_remove)) {
							echo "Cant delete content inside folder $value.";
							break;
						}
					}
					$name_folder_page = "/". $folder_page_ftp;
					//delete folder page.
					if (!ftp_rmdir($conn_id, $name_folder_page)) {
						echo "Cant remove this folder $value at it's address: $folder_page_ftp";
						break;
					}
				}else{
					$arDel[] = $value;
					$page = $obj->deletePage($value);
				}
			}
			if(isset($arDel)){
				$del = implode('-', $arDel);
				echo "<div class='container alert alert-success'>Delete success pages $del</div>";
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
								<a href="update.php?update=1&id=<?php echo $row["id"]; ?>" class="btn btn-info"><i class="far fa-edit"></i></a>
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
						<button class="btn btn-success" type="submit" name="submit"onclick="return submitForm()" >Upload</button>
						<button class="btn btn-success" type="submitDel" name="submitDel" onclick="return submitForm()">Delete</button>
					</div>
				</form>	
			</div>
		</div>
	</div>
 </body>
 <script type="text/javascript" src="/asset/js/validate-checkbox.js"></script>
