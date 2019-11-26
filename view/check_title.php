<?php
    include_once dirname(__DIR__).'/model/action.php';
    $obj = new DataOperation;
    $con = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    if (!$con) {
        die('Could not connect: ' . mysqli_error($con));
    }
    if(isset($_POST["create"])){
		$title = mysqli_real_escape_string($conn, $_POST['title'] );
		$content = mysqli_real_escape_string($conn, $_POST['content']);
		$path = mysqli_real_escape_string($conn, $_POST['path']);
		$fields = array(
			"title"   => htmlspecialchars(trim($title)),
			"content" => $content,
			"path"    => $path,
        );
        $title = $_REQUEST['title'];
        $query = "select * from page where title =' . $title . ' ";
        $sql = mysqli_query($con,$query);
        $record = mysqli_num_rows($sql);
    
        if ($record) {
            $error_title =  "Record already exits";
            echo $error_title;
            exit();
        }else{
            if($obj->insert("page",$fields)){
			    header("location:/view/list.php");
            }
        }
	}
   
?> 
<?php
    // $path =  dirToArray(LOCAL_FILE);
    // echo '<pre>';
    // print_r($path);
    // echo '</pre>';
    //include dirname(__DIR__)."/model/action.php";
	$obj = new DataOperation;
?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

  <!-- Modal content-->
  <div class="modal-content">
    <div class="modal-header">
      <h4 class="modal-title">Path page</h4>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
      <button class="btn btn-success float-right mb-2" ><i class="fa fa-plus"></i></button>
      <input type="text" name="path" class="form-control mb-2" id="folder_name" placeholder="Enter path">
      <form action="" method="POST">
        <input type="text" id="path_page" class="form-control">
      </form>
    </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>
  <script>
  function getpath() {
    document.getElementById("path").value = document.getElementById("folder_name").value;
    var url='Path/';
    document.getElementById("path_page").value = url+document.getElementById("folder_name").value;
  }
</script>
