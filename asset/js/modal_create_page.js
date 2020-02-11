$(document).ready(function() {
    $("#optradio").attr("checked", "checked");
    $("input[type='radio']").click(function() {
        var radio_val = $("input[name='optradio']:checked").val();
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

    $('#save-page').click(function(e) {
        e.preventDefault();
        var title = $('#recipient-name').val();
        var radio_val = $('input[name="optradio"]:checked').length == 0;
        var path = $('#path-name').val();
        if (title == '') {
            alert('Vui lòng nhập tên');
            return false;
        }
        if(path == ''){
            alert('Vui lòng nhập đường dẫn');
            return false;
        }
        if($('input[name="optradio"]:checked').length == 0) {
            alert('Vui lòng chọn template');
            return false; 
        } 
        if(title != ''){
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
                    }else{
                        $('#frmCreate').submit();
                    }
                },
            });
            return false;
        }
    });

    $("#recipient-name").on('keyup',function() {
      var title = $("#recipient-name").val();
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
    $('#recipient-name').on('keyup',function() {
        var count = $(this).val().length;
        if (count >= 70 ) {
            alert("Vui lòng nhập tiêu đề không quá 70 kí tự");
            return false;
        }
    });


});