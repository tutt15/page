
<?php

    session_start();
    $conn = mysqli_connect("localhost","root","","db_page");
    if (isset($_POST["dangnhap"])) {
        $username = $_POST["username"];
        $password = $_POST["password"];
        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        if ($username == "" || $password =="") {
            echo "username hoặc password bạn không được để trống!";
        }else{
            $sql = "select * from user where username = '$username' and password = '$password' ";
            $query = mysqli_query($conn,$sql);
            $num_rows = mysqli_num_rows($query);
            if ($num_rows==0) {
                echo "Tên đăng nhập hoặc mật khẩu không đúng !";
            }else{
                $_SESSION['username'] = $username;
                header('Location: ../view/list.php');
            }
        }
    }
?>