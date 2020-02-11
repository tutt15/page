<?php
include_once dirname(__DIR__) . '/model/action.php';
$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
$obj = new DataOperation;
if (isset($_POST['title']) || isset($_POST['optradio']) || isset($_POST['getpath'])) {
    $title = htmlspecialchars($_POST['title']);
    $templ = $_POST['optradio'];
    $path = $_POST['getpath'];
    $where = array(
        "id" => $templ,
    );
    $fields = array("template_src");

    $sql = $obj->listByValue("template", $where, $fields);
    $content = $sql[0];
    $file = file_get_contents(dirname(__DIR__) .'/cat_template/'. $content);
    $patterns = array();
    $replacements = array();
    $patterns[1] = '/Post Title/';
    $replacements[1] = $title;
    $templ_page = preg_replace($patterns, $replacements, $file);

    $query = "SELECT * FROM `template`";
    $result = mysqli_query($conn, $query);
}
?>