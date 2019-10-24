<?php 
include dirname(__DIR__)."/controller/page.php";
include dirname(__DIR__)."/model/fs.php";
include dirname(__DIR__). "/connect/ftpconect.php";
//Check  upload
	if (isset($_POST['submit'])) {
		if (!empty($_POST['checkbox'])) {
			$fs = new FS;
			foreach ($_POST['checkbox'] as $key => $value) {
				// FTP Upload file to server
				//$page = $obj->listPageId($value);
				$page = $obj->listByValue('page',['id'=>$value]);
				$content = $fs->setContent($page);
				$file_pointer = dirname(__DIR__).'/'. 'page'. $value .'.html'; 
				file_put_contents($file_pointer, $content);
				
				$subject = file_get_contents(dirname(__DIR__).'/'. 'page'. $value .'.html');
				$update  = dirname(__DIR__).'/'. 'page'. $value .'.html';
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
				//ftp_pwd: return current folder name.
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
						//var_dump($path_info);die();
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
						$path_info_check = pathinfo($check);
						//var_dump($path_info_check);die();
						if($path_info_check['extension']!='hmtl'){
							$list_content[] = $path_info_check['basename'];
						}
					}

					//check images in folder page ftp have empty 
					if (!empty($img_using)) {
						$get_array_non_using = array_diff($list_content, $img_using);
						//var_dump($get_array_non_using);die();
						foreach($get_array_non_using as $remove) {
							@ftp_delete($conn_id, FTP_FILE.$dir_page . "/$remove");
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
								echo 'Error';
							}
						}
					}
				}
				$link_temp = 'file_temp.html';
				$ftp_file= '/'.$value.'/';
				$replace_up = str_replace('ckeditor/kcfinder/upload/images/',$ftp_file,file_get_contents($local_file));
				file_put_contents($link_temp,$replace_up);
				$upload = ftp_put($conn_id, $dir_page . "/page$value.html", $link_temp, FTP_ASCII);
				file_put_contents($link_temp, '');
				//$file_update = 'page'. $value .'.html';
				$dataOperation = new DataOperation();
				//var_dump($page_status);die();
				switch ($page['status']) {
					case STATUS_NEW:
						$status = STATUS_PUBLIC;
						break;
					case STATUS_PUBLIC:
						$status = STATUS_PUBLIC;
						break;
				}
				$dataOperation->update('page',['id'=>$value],['status'=>$status]);
				// Update link upload 
				$dataOperation->update('page',['id'=>$value],['upload'=>$ftp_path]);
				// Update status page
			}
			if ($upload) {
				$id_upload = implode('-', $arr_upload);
				echo "<div class='container alert alert-success'>Upload successfull $id_upload.</div>";
			}else{
				echo "<div class='container alert alert-danger'>Upload fails.</div>";
			}
		}
	}
