<?php 
    include dirname(__DIR__)."/model/action.php";
    session_start();
    $conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
    mysqli_set_charset($conn , "utf8");
    $sql_login = new DataOperation();
    if (isset($_POST["check_user"])) {
		$username = mysqli_real_escape_string($conn, $_POST["username"]);
		$password = mysqli_real_escape_string($conn, $_POST["password"]);
		$sql = $sql_login ->listByValue("user", ["username" => $username, "password" => $password]);
		if ($sql == 0) {
			echo "fail";
		}else{
			$_SESSION['username'] = $username;
			echo "success";
        }
        exit();
    }
    
?>