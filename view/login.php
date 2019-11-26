<?php 
	include dirname(__DIR__)."/model/action.php";
	include_once dirname(__DIR__)."/templates/login/header.php";
	session_start();
?>
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-50">
				<form class="login100-form validate-form" action="check_user.php" onsubmit="return do_login(); " method="POST">
					<span class="login100-form-title p-b-33">
						Account Login
					</span>

					<div class="wrap-input100 validate-input" data-validate="Username is required" >
						<input class="input100" type="text" name="username" id="username" placeholder="Username" >
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="wrap-input100 rs1 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" id="password" placeholder="Password" >
						<span class="focus-input100-1"></span>
						<span class="focus-input100-2"></span>
					</div>

					<div class="container-login100-form-btn m-t-20">
						<button class="login100-form-btn" type="submit" name="login">
							Sign in
						</button>
					</div>

					<div style = "font-size:15px; color:#cc0000; margin-top:10px;" id="error"></div>

				</form>
			</div>
		</div>
	</div>
<?php include_once dirname(__DIR__)."/templates/login/footer.php";?>
<script type="text/javascript">
	function do_login()
	{
		var username=$("#username").val();
		var password=$("#password").val();
		if(username!="" && password!="")
		{
			$.ajax({
				type:'post',
				url:'check_user.php',
				data:{
					check_user:"check_user",
					username:username,
					password:password
				},
				success:function(response) {
				if(response=="success")
				{
					window.location.href="list.php";
				}
				else
				{
					$('#error').append('<p class="text-danger">Wrong username or password</p>');
				}
				}
			});
		}
		else
		{
			$('#error').append('<p class="text-danger">Please enter full user information</p>');
		}

		return false;
	}
</script>
