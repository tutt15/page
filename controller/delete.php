<?php

    include dirname(__DIR__)."/controller/page.php";
    include dirname(__DIR__). "/connect/ftpconect.php";
    if (isset($_POST['submitDel'])) {
        foreach ($_POST['checkbox'] as $key => $value) {
            //Address page on local 
            $page = $obj->listByValue('page',['id'=>$value]);
            $real_path = $page['path'] != '' ?  $page['path'] :  'page' . $value . '.html';
            $link_page_local  = dirname(__DIR__).'/'.'page'. $value .'.html';
            $link_page_ftp = ftp_pwd($conn_id) . $real_path;
            //var_dump($link_page_ftp);die();
            $dir_img =  ftp_pwd($conn_id).'images'.'/'.$value ;
            $dir_doc =  ftp_pwd($conn_id).'document'.'/'.$value;
            $contents_img_on_server = ftp_nlist($conn_id,'/images');
            $contents_doc_on_server = ftp_nlist($conn_id,'/document');
            //name folder page
            $folder_img_ftp = $value;
            //check folder page already in ftp .
            if (isset($link_page_ftp) && in_array($dir_img, $contents_img_on_server) && in_array($dir_doc, $contents_doc_on_server)) {
                $arDel[] = $value;
                //delete page in database
                $page = $obj->delete('page',['id'=> $value]);
                //delete page in local 
                @unlink($link_page_local);

                //delete page in ftp server
                @ftp_delete($conn_id, $link_page_ftp);
                $ar_path = explode('/' , $page['path']);
                //array_pop($ar_path);
                $ar_path_dir = $ar_path;
                
                foreach(array_reverse($ar_path) as $value_path) {
                    $check_exist_dir = ftp_nlist($conn_id, ftp_pwd($conn_id) . implode('/',  $ar_path_dir)) != false;
                    if (!$check_exist_dir) {
                        ftp_rmdir($conn_id, implode('/',  $ar_path_dir));
                    } else {
                        break;
                    }
                    array_pop($ar_path_dir);
                }

                //check content inside in folder page.
                $content_folder = ftp_nlist($conn_id, ftp_pwd($conn_id).'images'.'/'.$value.'/' );
                foreach ($content_folder as $need_remove) {
                    //Delete content in folder page ftp
                    if (!ftp_delete($conn_id, $need_remove)) {
                        echo "Cant delete content inside folder $value.";
                        break;
                    }
                }
                //delete folder page.
                if (!ftp_rmdir($conn_id, $dir_img)) {
                    echo "Cant delete this folder $value at it's address: $dir_img";
                    break;
                }
                $content_folder_document = ftp_nlist($conn_id, ftp_pwd($conn_id).'document'.'/'.$value.'/' );
                foreach ($content_folder_document as $need_remove_doc) {
                    //Delete content in folder page ftp
                    if (!ftp_delete($conn_id, $need_remove_doc)) {
                        echo "Cant delete content inside folder $value.";
                        break;
                    }
                }
                //delete folder page.
                if (!ftp_rmdir($conn_id, $dir_doc)) {
                    echo "Cant delete this folder $value at it's address: $dir_doc";
                    break;
                }
            }else{
                $arDel[] = $value;
                $page = $obj->delete('page',['id'=> $value]);
            }
        }
        if(isset($arDel)){
            $del = implode('-', $arDel);
            echo "<div class='container alert alert-success'><i class='fa fa-thumbs-up'></i>Delete success pages $del</div>";
        }
    }

?>    