<?php
  include dirname(__DIR__). "/controller/page.php";
  session_start();
  if(!isset($_SESSION['username'])){
    header("location:login.php");die();
  }

  if (isset($_GET["id"])) {
    $id = $_GET["id"] ?? null;
    $where = array(
      "id" => $id,
    );
    $row = $obj->listByValue("page", $where);

    $title = $row['title'];
    $content = $row['content'];
    $templ_id =  $row['template_id'];
    $path = $row['path'];

    $sql = $obj->listByValue( "template", ["id" =>$templ_id],["template_src"] );

    $templ = $sql[0];
    
    $file = file_get_contents(dirname(__DIR__) .'/cat_template/'. $templ);
    $patterns = array();
    $replacements = array();
    $patterns[1] = '~<h4[^>]*>[^<]*</h4>~';
    $replacements[1] = "<input class='form-control mt-3 mb-3' id='title' name='title' style='color:red;font-weight:bold' value = '$title' />";
    $patterns[2] = '~<textarea[^>]*>[^<]*</textarea>~';
    $replacements[2] = "<textarea type='text' id='editor1' name='editor1' class='editor1'>$content</textarea>";
    
    $templ_page = preg_replace($patterns, $replacements, $file);
  }
?>