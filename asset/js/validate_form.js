$(document).ready(function(){
    $('#frmpage').validate({
        ignore: [],
        debug: false,
        rules:{
            title:{
                required: true,
                maxlength: 150
            },
            content:{
                required: function(textarea) {
                    CKEDITOR.instances[textarea.id].updateElement(); 
                    var editorcontent = textarea.value.replace(/<[^>]*>/gi, ''); 
                    return editorcontent.length === 0;
                }
            },
        },
        messages:{
            title:{
                required: "Vui lòng nhập tiêu đề!",
                maxlength: "Vui lòng nhập tiêu đề không quá 150 kí tự"
            },	
            content:{
                required: "Vui lòng nhập nội dung của bài !",
            }
        }
    });

    $('#frm-list').validate({
        ignore: [],
        debug: false,
        rules:{
            search:{
                maxlength: 50
            },
        },
        messages:{
            search:{
                maxlength: "Vui lòng nhập tiêu đề không quá 50 kí tự"
            },	
        }
    })

    // $('#frmCreate').validate({
    //     ignore: [],
    //     debug: false,
    //     rules:{
    //         title:{
    //             required: true,
    //             maxlength: 100
    //         },
    //         templ:{
    //             required: true
    //         },
    //         path:{
    //             required: true
    //         },
    //     },
    //     messages:{
    //         title:{
    //             required: "Vui lòng nhập tiêu đề",
    //             maxlength: "Vui lòng nhập tiêu đề không quá 50 kí tự"
    //         },
    //         templ:{
    //             required: "Vui lòng chọn template",
    //         },
    //     }
    // });

    $("#frm-create").validate({
        ignore: [],
        debug: false,
        rules: {
            editor1: {
                required: function() {
                    CKEDITOR.instances.cktext.updateElement();
                },
            }
        },
        messages: {

            editor1: {
                required: "Vui lòng nhập nội dung",
            }
        }
    });

    $("#frmpath").validate({
        ignore: [],
        debug: false,
        rules: {
            path: {
                maxlength: 20
            }
        },
        messages: {
            path: {
                maxlength: "maxlength 20 ",
            }
        }
    });

    
});