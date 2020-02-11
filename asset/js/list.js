$(document).ready(function() {
    $('.preview').click(function() {
        var page_id = $(this).data('id');
        $.ajax({
            url: 'preview.php',
            type: 'post',
            data: {
                page_id: page_id
            },
            success: function(response) {
                $('.modal-body-1').html(response);
                $('#empModal').modal('show');
            }
        });
    });

    $('#frm-list').submit(function() {
        if($('#search').val() == ''){
            $('#search').attr('disabled', 'disabled');
        }else{
            var str = $('#search').val();
            str = str.replace(/ +(?= )/g, '').replace(/[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
            $('#search').val(str);
        }
        return true;
    })
    
    $('#inputGroupSelectshow').change(function(){
        $('#frm-list').submit();
    });
    $('#inputGroupSelect01').change(function(){
        $('#frm-list').submit();
    });
    setTimeout(function() {
        $(".alert").alert('close');
    }, 1500);
    // $("#frm-list").submit(function(event) {
    //     if ($('#search').val().trim() == '') {
    //         event.preventDefault();
    //         alert('Vui lòng nhập tiêu đề bạn cần tìm?');
    //     } else {
    //         var str = $('#search').val();
    //         // if (checkSpecialStr(str)) {
    //         //     alert('Vui lòng không nhập các ký tự đặc biệt vào độ dài từ khóa?');
    //         //     event.preventDefault();
    //         // }
    //         str = str.replace(/ +(?= )/g, '').replace(/[0-9`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/gi,'');
    //         $('#search').val(str);
    //     }
    // });

    // function checkSpecialStr(str) {
    //     var format = /[!@#$%^&*()+=\[\]{};':"\\|,.<>\/?]/;
    //     return format.test(str)
    // }
    // 

    
});