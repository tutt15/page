<?php
$arr = array(
         ".", "..", ".vscode", "config", "common.php", "connect", "controller", "model", "templates",
         "view", ".git", ".htaccess", "asset", "ckeditor", "db_page.sql", "test.php", "modal.php", "result.php", "preview", "search.php", "test.php", "cat_template", "index.php");
$path = array_diff(scandir(LOCAL_FILE), $arr);
sort($path);
?>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg mw-75 w-75">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Path page</h4>
        <button type="button" class="close" id="close"  onclick="closeModal()">&times;</button>
      </div>
      <div class="modal-body">
        <form action="" method="POST" name="frmpath">
          <a href="javascript:void(0)" class="btn btn-outline-success float-right mb-2" name="create_file" id="js-file" 
          onclick="load_file(event)" data-toggle="tooltip" title="Create file"><i  class='fas'>&#xf15c;</i></a>
          <a href="javascript:void(0)" class="btn btn-outline-danger float-right mb-2 mr-2" name="create_folder" id="js-folder" 
          onclick=" load_folder(event)" data-toggle="tooltip" title="Create folder" style="padding: 5px 9px 1px 9px"><i class="material-icons">&#xe2cc;</i></a>
          <input type="text" name="path" id="path" class="form-control mb-2" placeholder="Enter name" style="width: 660px;">
        </form>
        <div id="result" class="mt-2 mb-3 pl-2" style="border: 1px solid #CED4DA;border-radius:5px;overflow: hidden;
        overflow-y: scroll;width: auto;height: 250px;">
          <?php foreach($path as $item){
              if(!strpos($item, '.html')){
                $item1 = "'".$item."'";
                  echo '<a href="javascript:void(0)" value="'.$item.'" name="list_folder" onclick="get_by_folder('.$item1.')"         style="color:black;width:250%;" ><i class="fa fa-folder" style="color:#F7D673"></i>'.$item.'</a><br>';
                }
            } ?>
          <?php
            foreach($path as $item){
              if(strpos($item, '.html')){
                  echo "<a href='javascript:void(0)' value='$item' name='list_folder' style='width:250%;'>" . $item . "</a><br>";
              }
            }
           ?>
        </div>
        <script type="text/javascript" src="/asset/js/modal_path.js"></script>
      </div>
    </div>
  </div>
</div>
<script type='text/javascript' src="/asset/js/validate_form.js"></script>
<script type="text/javascript">
  function closeModal() {            
    $("#myModal").modal("hide");    
  }
</script>