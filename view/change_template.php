<?php 
	include dirname(__DIR__). "/controller/page.php";
	if (isset($_POST['name_tmp']) && isset($_POST['title'])) {
		$id = $_POST['name_tmp'];
		$title = $_POST['title'];
		$where = array(
            "id" => $id,
        );
        $row = $obj->listByValue("template", $where);

        $tmp_src = $row['template_src'];

        $file_temp = file_get_contents(dirname(__DIR__).'/cat_template/'.$tmp_src);

        $patterns = array();
	    $replacements = array();
	    $patterns[1] = '/Post Title/';
	    $replacements[1] = $title;
	    $templ_page = preg_replace($patterns, $replacements, $file_temp);

        echo $file_temp; 
	}
?>