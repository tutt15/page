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
				$page = $obj->listByValue('page',['id'=>$value]);
				$content = $fs->setContent($page);
				$file_pointer = dirname(__DIR__).'/'. 'page'. $value .'.html'; 
				file_put_contents($file_pointer, $content);
				

				$path_local = $page['path'];
				if($path_local != ''){
					$path_info = pathinfo($path_local);
					$get_path_html =  dirname(__DIR__).'/'.$path_info['dirname'].'/'.$path_info['basename'];
					file_put_contents($get_path_html, $content);
				}

				$subject = file_get_contents($file_pointer);
				$update  = dirname(__DIR__).'/'. 'page'. $value .'.html';
				
				//video 
				$pattern_video = "https://www.youtube.com/watch?v=";
				$replace_video = "https://www.youtube.com/embed/";
				file_put_contents($update,str_replace($pattern_video, $replace_video, $subject));

				$arr_upload[] =  $value;
				$local_file = dirname(__DIR__).'/'.'page'. $value .'.html';
				$link_ftp_path = 'page'. $value .'.html';

				switch ($page['status']) {
					case 1:
						$status = 3;
						break;
					case 2:
						$status = 3;
						break;
					case 3:
						$status = 3;
						break;

					default;
				}
				//var_dump($status);
				//Update status
				$obj->update('page',['id'=>$value],['status'=>$status]);
				// Update link upload 
				$obj->update('page',['id'=>$value],['upload'=>$link_ftp_path]);
				//get string in scr= ""
				$regex_img = '/src="([^"]+)"/'; 
				$regex_doc = '/\/ckeditor\/kcfinder\/upload\/files\/([a-zA-Z0-9\s_\\.\-\(\):])+(.[a-zA-Z0-9])/';
				//return all result link folder image.
				preg_match_all($regex_img, $content, $matches, PREG_SET_ORDER, 0);
				preg_match_all($regex_doc, $content, $matches_doc, PREG_SET_ORDER, 0);
				//var_dump($matches_doc[0][0]);
				//folder ftp page.
				//ftp_pwd: return current folder name.
				$dir_page_img =  ftp_pwd($conn_id).'images'.'/'.$value ;
				$dir_page_doc =  ftp_pwd($conn_id).'document'.'/'.$value;
				//return all folder in folder root ftp
				$content_ftp_img = ftp_nlist($conn_id,'/images');
				$content_ftp_doc = ftp_nlist($conn_id, '/document');
				//Check if the public folder images is in the ftp directory .
				if(in_array($dir_page_img,$content_ftp_img)){
					foreach($matches as $val){
						//get path of images  in the local directory.
						$get_link_img = LOCAL_FILE.$val[1];
						//pathinfo: get infomation path tranmission.
						$path_info = pathinfo($get_link_img);
						//return name image.
						$get_img_name = $path_info['basename'];
						//path folder contain images 
						$link_path = $dir_page_img.'/'.$get_img_name;
						//using ftp_put transfer images  to folder ftp contain page 
						if(@ftp_put($conn_id,$link_path,$get_link_img,FTP_BINARY)){
							$img_using[] = $get_img_name;
							//var_dump($img_using);
						}
					}
					//check the content in folder ftp 
					$check_content_child_folder = ftp_nlist($conn_id, $dir_page_img);
					//var_dump($check_content_child_folder);

					foreach($check_content_child_folder as $check){
						$path_info_check = pathinfo($check);
						if($path_info_check['extension']!='hmtl'){
							$list_content[] = $path_info_check['basename'];
							//var_dump($list_content);die();
						}
					}

					//check images in folder page ftp have empty 
					if (!empty($img_using)) {
						$get_array_non_using = array_diff($list_content, $img_using);
						//var_dump($get_array_non_using);die();
						foreach($get_array_non_using as $remove){
							@ftp_delete($conn_id, $dir_page_img ."/$remove");
						}
					}
				}else{
					//If the page directory is not already in the ftp 
					if (@ftp_mkdir($conn_id, $dir_page_img)) {
						foreach($matches as $val){
							$get_link_img = LOCAL_FILE.$val[1];
							$path_info = pathinfo($get_link_img);
							$get_img_name = $path_info['basename'];
							$link_path = $dir_page_img . "/" . $get_img_name;
							if(!(@ftp_put($conn_id, $link_path, $get_link_img, FTP_BINARY))){
								echo 'Error';
							}
						}
					}
				}
				if(in_array($dir_page_doc,$content_ftp_doc)){
					foreach($matches_doc as $val_doc){
						//get path of images  in the local directory.
						$get_link_doc = LOCAL_FILE.$val_doc[0];
						//var_dump($get_link_doc);
						//pathinfo: get infomation path tranmission.
						$path_info = pathinfo($get_link_doc);
						//var_dump($path_info);
						//return name image.
						$get_doc_name = $path_info['basename'];
						
						//path folder contain images 
						$link_path = $dir_page_doc.'/'.$get_doc_name;
						//using ftp_put transfer images  to folder ftp contain page 
						if(@ftp_put($conn_id,$link_path,$get_link_doc,FTP_BINARY)){
							$doc_using[] = $get_doc_name;
						}
					}
					//check the content in folder ftp 
					$check_content = ftp_nlist($conn_id, $dir_page_doc);
					
					
					//var_dump($check_content_child_folder);

					foreach($check_content as $check){
						$path_info_check = pathinfo($check);
						
						if($path_info_check['extension']!='hmtl'){
							$list_doc[] = $path_info_check['basename'];
							
						}
					}

					//check images in folder page ftp have empty 
					if (!empty($doc_using)) {
						$doc_not_using = array_diff($list_doc, $doc_using);
						foreach($doc_not_using as $remove){
							@ftp_delete($conn_id, $dir_page_doc ."/$remove");
						}
					}
				}else{
					//If the page directory is not already in the ftp 
					if (@ftp_mkdir($conn_id, $dir_page_doc)) {
						foreach($matches_doc as $val_doc){
							$get_link_doc = LOCAL_FILE.$val_doc[1];
							$path_info = pathinfo($get_link_doc);
							$get_doc_name = $path_info['basename'];
							$link_path = $dir_page_doc . "/" . $get_doc_name;
							if(@(!ftp_put($conn_id, $link_path, $get_link_doc, FTP_BINARY))){
								echo 'Error';
							}
						}
					}
				}
				$link_temp = 'file_temp.html';
				$ftp_img= 'images/'. $value. '/';
				$ftp_doc= 'document/'. $value. '/';
				$replace_img = str_replace('ckeditor/kcfinder/upload/images/', $ftp_img, file_get_contents($local_file));
				file_put_contents($link_temp,$replace_img);
				$replace_doc = str_replace('ckeditor/kcfinder/upload/files/', $ftp_doc, file_get_contents($link_temp));
				file_put_contents($link_temp,$replace_doc);
				// Upload directory for page
				// split path of page
				$path = $page['path'];
				if ($path != '') {
					$ar_path = explode('/', $path);
					array_pop($ar_path);
					$root_page = '';
					foreach ($ar_path as $key => $value) {
						@ftp_mkdir($conn_id, $root_page . '/' .$value);
						$root_page .= $value;
					}
					$upload = ftp_put($conn_id, "/" . $path, $link_temp, FTP_ASCII);
				} else {
					$upload = ftp_put($conn_id, "/page" . $value . '.html', $link_temp, FTP_ASCII);
				}

				file_put_contents($link_temp, '');
			}
			if ($upload) {
				$id_upload = implode('-', $arr_upload);
				echo "<div class='container alert alert-success'><i class='fa fa-thumbs-up'></i>Upload successfull $id_upload.</div>";
			}else{
				echo "<div class='acontain er alert alert-danger'>Upload fails.</div>";
			}
		}
	}
