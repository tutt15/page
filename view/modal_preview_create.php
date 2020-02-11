<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" >
  <div class="modal-dialog modal-lg mh-50">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Preview</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <?php 
        $patterns = array();
        $replacements = array();
        $patterns[1] = '/Post Title/';
        $replacements[1] = $title;
        $patterns[2] = '~<textarea[^>]*>[^<]*</textarea>~';
        $replacements[2] = "<p id='pre-editor1'></p>";
        $patterns[3] = '/Title/';
        $replacements[3] = $title;
        $preview_page = preg_replace($patterns, $replacements, $file);

        echo $preview_page;

      ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>