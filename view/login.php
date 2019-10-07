<?php 
	include dirname(__DIR__)."/model/action.php";
	include_once dirname(__DIR__)."/templates/login/header.php";
	session_start();
	$conn = mysqli_connect(HOST,USERNAME,PASSWORD,DATABASE);
	$error ="";
    if (isset($_POST["login"])) {
		$username = trim($_POST["username"]);
		$password = trim($_POST["password"]);
        $username = strip_tags($username);
        $username = addslashes($username);
        $password = strip_tags($password);
        $password = addslashes($password);
        if ($username == "" || $password =="") {
            echo "Please enter password or username";
        }else{
            $sql = "select * from user where username = '$username' and password = '$password' ";
            $query = mysqli_query($conn,$sql);
            $num_rows = mysqli_num_rows($query);
            if ($num_rows==0) {
               $error = "Wrong username or password";
            }else{
                $_SESSION['username'] = $username;
                header('Location:'.ROOT_PATH.'/view/list.php');
            }
        }
    }
?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="" method="POST">
					<span class="login100-form-title p-b-33">
						Account Login
					</span>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="text" name="username" placeholder="Username" required="">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" placeholder="Password" required="">
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn" type="submit" name="login">
							Sign in
						</button>
					</div>

					<div style = "font-size:15px; color:#cc0000; margin-top:10px;"><?php echo $error; ?></div>

				</form>
			</div>
		</div>
	</div>
	

<?php
include_once dirname(__DIR__)."/templates/login/footer.php";
?>
