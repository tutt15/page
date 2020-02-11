<?php 
 include dirname(__DIR__). "/controller/page.php";
	$pageid = $_POST['page_id'];
    
    $where = array(
        "id" => $pageid,
    );
    $row = $obj->listByValue("page", $where);

    $title = $row['title'];
    $content = $row['content'];
    $templ_id =  $row['template_id'];

    $sql = $obj->listByValue( "template", ["id" =>$templ_id],["template_src"] );

    $templ = $sql[0];
    
    $file = file_get_contents(dirname(__DIR__) .'/cat_template/'. $templ);
    $patterns = array();
    $replacements = array();
    $patterns[1] = '~<h4[^>]*>[^<]*</h4>~';
    $replacements[1] = "<h4 style='color:red'>$title</h4>";
   	$patterns[2] = '~<textarea[^>]*>[^<]*</textarea>~';
    $replacements[2] = "<p id='pre-editor1'>$content</p>";
    
    $templ_page = preg_replace($patterns, $replacements, $file);

    echo $templ_page;