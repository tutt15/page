$(document).ready(function(){
    $('#frmCreate').validate({
        ignore: [],
        debug: false,
        rules:{
            title:{
                required: true,
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
            },	
            content:{
                required: "Please enter content",
            }
        }
    });
});