var prefix_file = '';

function load_folder(event) {
    event.preventDefault();
    var path = $('#path').val();
    var full_path = prefix_file == '' ? path : prefix_file + '/' + path;
    var length_path = $('#path').length;
    if (path == '') {
        alert("Vui lòng nhập tên folder!");
    }else if(length_path >= 10 ){
        alert("Nhập tên không quá 10 kí tự");
    }
    else {
        if (checkSpecialStrPath()) {
            alert("Vui lòng không nhập kí tự đặc biệt!");
        } else {
            $.ajax({
                url: "create_folder.php",
                type: "post",
                data: {
                    path: full_path
                },
                success: function (response) {
                    if (response === "Fails") {
                        alert("Folder đã tồn tại !");
                        event.preventDefault();
                    }else {
                        if (!path.includes(".html")) {
                            $('#result').append('<a href="javascript:void(0)" style="color:black" onclick="get_by_folder(\'' + full_path + '\')"><i class="fa fa-folder" style="color:#F7D673"></i>' + path + '</a><br />');
                        } else {
                            $('#result').append('<a href="javascript:void(0)"> ' + path + '</a><br />');
                        }
                    }
                },
            });
        }
    }
}

function load_file(event) {
    event.preventDefault();
    var path = $('#path').val();
    var full_path = prefix_file == '' ? path : prefix_file + '/' + path;

    if (path == '') {
        alert("Vui lòng nhập tên file!");
    } else {
        if (checkSpecialStrPath()) {
            alert("Vui lòng không nhập kí tự đặc biệt!");
        } else {
            $.ajax({
                url: "create_file.php",
                type: "post",
                data: {
                    path: full_path
                },
                success: function (response) {
                    if (response !== "exists") {
                        $('#result').append('<a href="javascript:void(0)" name="list_folder" style="color:black" onclick="get_file(\'' + full_path + '.html' + '\')" >' 
                            + path + '.html' + '</a><br />');
                        var path_name = full_path + '.html';
                        $('#path-name').val(path_name);
                        $('#path').val('');
                        $('#myModal').modal('hide');
                    }else {
                        alert("File đã tồn tại!");
                    }
                },
            });
        }
    }
}
//Quay lại thư mục gốc
function back() {
    var prefix_ar = prefix_file.split('/');
    prefix_ar.pop();
    var prefix_tempa = prefix_ar.filter(Boolean);
    var prefix_temp = prefix_tempa.join('/');
    get_by_folder(prefix_temp);
}

//Lấy giá trị của file html
function get_file(file) {
    var file_path = file == '' ? '' : file;
    $('#folder_path').val(file_path);
}
//
function get_folder_path(file) {
    var folder_path_val = file == '' ? '' : file + '/';
    $('#folder_path').val(folder_path_val);
}

//Lấy các thư mục bên trong thư mục gốc
function get_by_folder(file) {
    $.ajax({
        url: "get_by_folder.php",
        type: "post",
        data: {
            file: file
        },
        success: function (response) {
            var list_file = $.parseJSON(response);
            prefix_file = file;
            if (prefix_file != '') {
                var list_file_html = '<a style="display: block" href="javascript:void(0)" onclick="back()"><i class="fa fa-arrow-left"></i></a>';
            } else {
                var list_file_html = '';
            }
            var prefix_get_file = file == '' ? '' : file + '/';
            list_file.forEach(function (file_item) {
                var value = file_item.includes(".html") || file_item.includes(".txt") || file_item.includes('.doc') || file_item.includes('.jpg') ||
                    file_item.includes('.pdf') || file_item.includes('.jpeg') || file_item.includes('.pptx') || file_item.includes('.png') || file_item.includes('.php');
                if (!value) {
                    list_file_html += '<a href="javascript:void(0)" style="color:black" onclick="get_by_folder(\'' + prefix_get_file + file_item + '\')"><i class="fa fa-folder" style="color:#F7D673"></i>' + file_item + '</a><br />';
                }
            });
            list_file.forEach(function(file_item){
                if (file_item.includes(".html")) {
                    list_file_html += '<a href="javascript:void(0)"  >' + file_item + '</a><br />';
                }
            });
            // list_file.forEach(function (file_item) {
            //     var value = file_item.includes(".html") || file_item.includes(".txt") || file_item.includes('.doc') || file_item.includes('.jpg') ||
            //         file_item.includes('.pdf') || file_item.includes('.jpeg') || file_item.includes('.pptx') || file_item.includes('.png') || file_item.includes('.php');
            //     if (!value) {
            //         list_file_html += '<a href="javascript:void(0)" style="color:black" onclick="get_by_folder(\'' + prefix_get_file + file_item + '\')"><i class="fa fa-folder" style="color:#F7D673"></i>' + file_item + '</a><br />';
            //     } else {
            //         list_file_html += '<a href="javascript:void(0)"  >' + file_item + '</a><br />';
            //     }
            // });
            $('#result').html(list_file_html);
            $('#path').val('');
            get_folder_path(file);
        },
    });
}
//Lấy giá trị đường dẫn
// function sb_path(event) {
//     var path = $('#folder_path').val();
//     if (!path.includes(".html")) {
//         alert("Mời nhập file html");
//         event.preventDefault();
//     }else{
//         var notify = confirm("Are you sure!");
//         if (notify == true) {
//             $('#path-name').val(path);
//             $('#myModal').modal('hide');
//         } else {
//              event.preventDefault();
//         }
//     }
// }

function checkSpecialStrPath() {
    var path = $('#path').val();
    var format = /[!@#$%^&*()+=\[\]{};':"\\|,.<>\/?]/;
    return format.test(path)
}

