<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
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
          echo $templ_page;
         ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>