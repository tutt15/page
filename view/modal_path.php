<?php
    $path =  dirToArray(LOCAL_FILE);
    // echo '<pre>';
    // print_r($path);
    // echo '</pre>';
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
      <form action="" method="POST">
        <!-- <button class="btn btn-success float-right mb-2" name="create_file" onclick="getpath()"><i class="fa fa-file"></i></button> -->
         <a href="javascript:void(0)" class="btn btn-warning float-right mb-2" name="create_file" id="js-file" onclick="load_file(event)"><i class="fa fa-file"></i></a>
        <!-- <button class="btn btn-success float-right mb-2" name="create_file" onclick="getpath()"><i class="fa fa-file"></i></button> -->
        <a href="javascript:void(0)" class="btn btn-danger float-right mb-2 mr-2" name="create_folder" id="js-folder" onclick=" load_folder(event)"><i class="fa fa-folder"></i></a>
        <input type="text" name="path" id="path" class="form-control mb-2"   placeholder="Enter folder or file html">
       

      </form>
      <div id="result" class="mt-2 mb-3" style="border: 1px solid grey;">
        <?php foreach( $path as $item) { ?>
          <?php if(!strpos($item, '.html')){ ?>
            <a href="javascript:void(0)"  value="<?php echo $item ?>" name="list_folder" onclick="get_by_folder('<?php echo $item ?>')" ><i class="fa fa-folder"></i><?php  echo $item; ?></a> <br>
          <?php }else{ ?>
            <a href="javascript:void(0)" value="<?php echo $item ?>" name="list_folder"  onclick="get_file('<?php echo $item ?>')"><?php  echo $item; ?></a> <br>
          <?php } ?>
        <?php } ?>
      </div>
      <div>
      <input type="text" name="folder_path" id="folder_path" >
      <button class="btn btn-success float-right close" id="sb-path" onclick="alert('Are you sure'); sb_path(event)" type="submit" data-dismiss="modal">Submit</button>
      </div>
      <script type="text/javascript">

        var prefix_file = '';

        function load_folder(event){
          event.preventDefault();
          var path = $('#path').val();
          var full_path = prefix_file == '' ? path : prefix_file + '/' + path;
          // console.log(full_path);
          if(path == ''){
              alert("Please enter path");
          }else{
            $.ajax({
                url : "create_folder.php",
                type : "post",
                data : {
                  path : full_path
                },
                success: function(response){
                  if(response == "Fails"){
                    alert("File already exist");
                  }else{
                      if(!path.includes(".html")){
                      $('#result').append('<a href="javascript:void(0)" onclick="get_by_folder(\'' + full_path + '\')"><i class="fa fa-folder"></i>'+ path +'</a><br />')
                    }else{
                      $('#result').append('<a href="javascript:void(0)"> '+ path +'</a><br />')
                    }
                  }
                  
                },
            });
          }
        }

        function load_file(event){
          event.preventDefault();
          var path = $('#path').val();
          var full_path = prefix_file == '' ? path : prefix_file + '/' + path;
          if(path == ''){
            alert("Please enter file");
          }else{
            $.ajax({
                url : "create_file.php",
                type : "post",
                data : {
                  path : full_path
                },
                success: function(response){
                  if(response == "Fails"){
                    alert("File already exist");
                  }else{
                    $('#result').append('<a href="javascript:void(0)" name="list_folder" onclick="get_file(\''+ full_path + '.html' +'\')">'+ path + '.html' +'</a><br />')
                  }
                },
            });
          }
        }

        function back() {
          var prefix_ar = prefix_file.split('/');
          // console.log(prefix_ar);
          prefix_ar.pop();
          var prefix_tempa = prefix_ar.filter(Boolean);
          var prefix_temp = prefix_tempa.join('/');
          get_by_folder(prefix_temp);
        }
        
        function get_file(file){
          var file_path = file == '' ? '' : file ;
          $('#folder_path').val(file_path);
         // $('#path_name').val(file_path);
        }

        function get_folder_path(file) {
          var folder_path_val = file == '' ? '' : file + '/';
          $('#folder_path').val(folder_path_val);
          //$('#path_name').val(folder_path_val);
        }

        function get_by_folder(file) {
          $.ajax({
                url : "get_by_folder.php",
                type : "post",
                data : {
                  file : file
                },
                success: function(response){
                  var list_file = $.parseJSON(response);
                  prefix_file = file;
                  if (prefix_file != '') {
                    var list_file_html = '<a style="display: block" href="javascript:void(0)" onclick="back()"><i class="fa fa-arrow-left"></i></a>';
                  } else {
                    var list_file_html = '';
                  }
                  var prefix_get_file = file == '' ? '' : file + '/';
                  list_file.forEach(function(file_item) {
                    if(!file_item.includes(".html")){
                      list_file_html += '<a href="javascript:void(0)" onclick="get_by_folder(\'' + prefix_get_file + file_item + '\')"><i class="fa fa-folder"></i>'+ file_item +'</a><br />';
                    }else{
                      list_file_html += '<a href="javascript:void(0)" onclick="get_file(\'' + prefix_get_file + file_item + '\')">'+ file_item +'</a><br />';
                    }
                  });
                  $('#result').html(list_file_html);
                  $('#path').val('');
                  get_folder_path(file);
                },
          });
        }
        function sb_path(event){
          var path  = $('#folder_path').val();
          $('#path_name').val(path);
        }
    </script>
    </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
  </div>
</div>

</div>
</div>


