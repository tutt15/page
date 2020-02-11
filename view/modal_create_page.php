<?php include_once dirname(__DIR__) . '/controller/page.php'; ?>
<style>
  .frame {
    zoom: 0.71;
    -moz-transform: scale(0.71);
    -moz-transform-origin: 0 0;
    -o-transform: scale(0.71);
    -o-transform-origin: 0 0;
    -webkit-transform: scale(0.71);
    -webkit-transform-origin: 0 0;
  }
</style>
<div id="exampleModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModal" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <!-- header -->
      <div class="modal-header">
        <h5 class="modal-title " id="exampleModal">Info page</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" id="frmCreate" action="create_page.php">
          <div class="form-group">
            <div class="row">
                <div class="col-6">
                  <label for="recipient-name" class="col-form-label text-danger font-weight-bold">Title</label>
                  <input type="text" class="form-control" name="title" id="recipient-name" style="background-color: #f8f9fa;
                  margin-top:5px">
                </div>
                <div class="col-6">
                  <button type="button" class="btn btn-outline-danger font-weight-bold border-0" data-toggle="modal" 
                  data-target="#myModal" style="width: 25%;">Path</button>
                  <input type="text" class="form-control" name="getpath" id="path-name" readonly="readonly"  
                  style="background-color: #f8f9fa;margin-top:5px">
                </div>
            </div>
          </div>
          <div class="form-group">
              <div class="row">
                <div class="col-1">
                  <div id="tpl-radio" style="width: 10%;height: auto;float: left;">
                    <label for="message-text" class="col-form-label font-weight-bold text-danger">Templates</label>
                    <?php
                    $templ = $obj->listAllValue('template');
                    foreach ($templ as $key => $value) { ?>
                      <div class="form-check">
                        <label class="form-check-label">
                            <input type="radio" class="form-check-input float-left" name="optradio" id="optradio" value="<?php echo $value['id'] ?>" 
                            ><?php echo $value['template_name']; ?>
                        </label>
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="col-11" style="margin-top: 40px; width: 1500px; padding: 0;height: 300px; overflow: hidden;">
                  <iframe src="<?php echo '/cat_template/tbl_1.html' ?>" id="pre-view" class="frame" frameborder="0" iframe_zoom="1" show_iframe_loader="true" 
                  style=" width: 1400px; height: 600px; border: 0px;margin-left: 40px"></iframe>
                </div>
              </div>
          </div>
          <div class="save">
              <button type="submit" id="save-page" class="btn btn-danger save-page mx-auto d-block">Save</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
  <?php
      include dirname(__DIR__) . "/view/modal_path.php";
      include dirname(__DIR__) . "/view/modal_page.php";
  ?>
  <script type="text/javascript" src="/asset/js/modal_create_page.js"></script>