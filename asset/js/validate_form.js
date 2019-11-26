$(document).ready(function(){
    $('#frmpage').validate({
        ignore: [],
        debug: false,
        rules:{
            title:{
                required: true,
                maxlength: 50
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
                required: "Please enter title",
                maxlength: "Please enter title no more than 50 character"
            },	
            content:{
                required: "Please enter content",
            }
        }
    });
});