<?php include_once dirname(__DIR__) . '/controller/create.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Create page</title>
  <link rel="icon" type="image/png" href="/asset/images/icons/favicon.ico"/>
	<link rel="stylesheet" type="text/css" href="/asset/css/style.css">
  <link rel="stylesheet" type="text/css" href="/asset/css/create.css">
	<link href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css' rel='stylesheet'/>
</head>
<body>
  <div class="content-templ mx-auto">
    <form id="frmcreate" method="post" action="<?php dirname(__DIR__) ?>/controller/page.php" >
      <?php echo $templ_page; ?>

      <div class="btn-create">
        <a href="list.php" class="btn1 btn-danger btn-circle text-decoration-none" style="padding: 13px 0px">Home</a>
        <button type="button" class="btn1 btn-primary btn-circle preview" data-toggle="modal" data-target=".bd-example-modal-lg" style="padding: 6px 0px;margin: 60px 0">Preview</button>
        <button type="button" class="btn1 btn-success btn-circle " data-toggle="modal" data-target="#myModal" style="padding: 6px 0px;margin: 120px 0px">Check</button>
        <button type="submit" class="btn1 btn-dark btn-circle " id="create" name="create" class="create" style="padding: 6px 0px;margin: 180px 0px">Create</button>
      </div>
      <div class="modal" id="myModal">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
              <h4 class="modal-title">Infomation</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <div class="modal-body">
              <form>
                <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Title:</label>
                  <input type="text" class="form-control" id="title-name" name="title" value="<?php echo $title; ?>" />
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label position-relative">Template:</label>
                   <div id="toggle" style="display: contents;"><img src="/asset/images/icons/icon.png" style="width: 20px;height: 25px;"></div>
                  <input class="form-control" id="templ" name="templ" value="<?php echo $templ; ?>" readonly="readonly" />
                </div>
                <div class="block" style="display: none">
                  <div class="form-group templ">
                    <div class="row">
                      <div class="col-1">
                        <div id="tpl-radio" style="width: 10%;height: auto;float: left;">
                          <?php
                          $templ = $obj->listAllValue('template');
                          foreach ($templ as $key => $value) { ?>
                            <div class="form-check">
                              <label class="form-check-label">
                                  <input type="radio" class="form-check-input float-left" id="optradio" name="optradio" value="<?php echo $value['id'] ?>" 
                                  ><?php echo $value['template_name']; ?>
                              </label>
                            </div>
                          <?php } ?>
                        </div>
                      </div>
                      <div class="col-11" style="margin-top: 5px; padding: 0;height: 300px; overflow: hidden;">
                        <iframe src="<?php echo '/cat_template/tbl_1.html'; ?>" id="pre-view" class="frame" frameborder="0" iframe_zoom="1" show_iframe_loader="true" 
                        style=" width: 1400px; height: 600px; border: 0px;margin-left: 40px"></iframe>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                  <label for="message-text" class="col-form-label">Path:</label>
                  <input class="form-control" id="path-save" name="path-save" value="<?php echo $path; ?>" readonly="readonly"/>
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>

  <?php include_once dirname(__DIR__) . '/view/modal_preview_create.php'; ?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="/asset/js/popper.min.js"></script>
  <script src="/asset/bootstrap/js/bootstrap.min.js"></script>
  <script src="/ckeditor/ckeditor.js"></script>
  <script src="/asset/js/a076d05399.js"></script>
  <script src="/asset/js/validate.min.js"></script>
  <script src="/asset/js/validate.js"></script>
  <script src="/asset/js/additional-methods.js"></script>
  <script type="text/javascript" src="/asset/js/pre_update_create.js"></script>
</body>
</html>