$(document).ready(function() {
    var block = $(".block");
    var templ = $("#templ").val(); 
    $( "#toggle" ).on( "click", function() {
      block.stop().slideToggle( 200 );
      $("#optradio").attr('checked', 'checked');
    });

    $("input[type='radio']").click(function() {
      var radio_val = $("input[name='optradio']:checked").val();
      $("#templ").val(radio_val);

      $.ajax({
        url: "templates.php",
        type: "post",
        data: {
            radio_val: radio_val
        },
        success: function(response) {
            $('#pre-view').attr("src", response);
        },
      });
    });
    CKEDITOR.replace('editor1');
    $(".preview").click(function() {
        var title = $('#title').val();
        var content = CKEDITOR.instances['editor1'].getData();
        $('#pre-title').text(title);
        $('#pre-editor1').html(content);
    });


    $("#title").on('keyup',function() {
      var title = $("#title").val();
      $.ajax({
        url: "check_title.php",
        type: "post",
        data: {
            title: title
        },
        success: function(response) {
            if(response > 0 ) {
              alert("Title đã tồn tại!");
              return false;
            }
        },
      });
      return false;
    });

    $("#title-name").on('keyup',function() {
      var title = $("#title-name").val();
      $.ajax({
        url: "check_title.php",
        type: "post",
        data: {
            title: title
        },
        success: function(response) {
            if(response > 0 ) {
              alert("Title đã tồn tại!");
              return false;
            }
        },
      });
      return false;
    });   
    $('#frmcreate').validate({
      ignore: [],
      debug: false,
      rules: {
        title:{
          required: true,
          maxlength: 70
        },
        editor1: {
          required: function(textarea) {
          CKEDITOR.instances['editor1'].updateElement(); 
          var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); 
          return editorcontent.length === 0;
          }
        }

      },
      messages: {
        title:{
          required: "Vui lòng nhập tên",
          maxlength: "Vui lòng nhập tiêu đề không quá 70 kí tự"
        },
        editor1: {
          required: "Vui lòng nhập nội dung",
        }
      }
    });


});