<?php

    include dirname(__DIR__)."/controller/page.php";
    include dirname(__DIR__). "/connect/ftpconect.php";
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
                //$page = $obj->deletePage($value);
                $page = $obj->delete('page',['id'=> $value]);
                //delete page in local 
                unlink($link);
                //check content inside in folder page.
                $content_folder = ftp_nlist($conn_id, $folder_page_ftp . '/');
                foreach ($content_folder as $need_remove) {
                    $need_remove ='/'.$need_remove;
                    //Delete content in folder page ftp
                    if (!ftp_delete($conn_id, $need_remove)) {
                        echo "Cant delete content inside folder $value.";
                        break;
                    }
                }
                $name_folder_page = '/'. $folder_page_ftp;
                //delete folder page.
                if (!ftp_rmdir($conn_id, $name_folder_page)) {
                    echo "Cant delete this folder $value at it's address: $folder_page_ftp";
                    break;
                }
            }else{
                $arDel[] = $value;
                //$page = $obj->deletePage($value);
                $page = $obj->delete('page',['id'=> $value]);
            }
        }
        if(isset($arDel)){
            $del = implode('-', $arDel);
            echo "<div class='container alert alert-success'>Delete success pages $del</div>";
        }
    }
    

?>