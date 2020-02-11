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
                      $('#result').append('<a href="javascript:void(0)" onclick="get_by_folder(\'' + full_path + '\')" style="color:black"><i class="fa fa-folder" style="color: #F3D16E"></i> ' + path  + ' </a><br />')
                    }else{
                      $('#result').append('<a href="javascript:void(0)" style="color:black"> ' + path + ' </a><br />')
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
                    $('#result').append('<a href="javascript:void(0)" name="list_folder" >'+ path + '.html' +'</a><br />')
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
                      list_file_html += '<a href="javascript:void(0)" onclick="get_by_folder(\'' + prefix_get_file + file_item + '\')" style="color:black"><i class="fa fa-folder" style="color: #F3D16E"></i>' + file_item  + '</a><br />';
                    }else{
                      list_file_html += '<a href="javascript:void(0)" >'+ file_item +'</a><br />';
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