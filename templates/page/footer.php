<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="/asset/js/popper.min.js"></script>
<script src="/asset/bootstrap/js/bootstrap.min.js"></script>
<script src="/asset/js/a076d05399.js"></script>
<script src="/asset/js/validate.min.js"></script>
<script src="/asset/js/validate.js"></script>
<script src="/asset/js/additional-methods.js"></script>
<script type="text/javascript" src="/asset/js/validate_form.js"></script>
<script type="text/javascript" src="/asset/js/validate-checkbox.js"></script>
<script type="text/javascript" src="/asset/js/validate_form.js"></script>
<script type="text/javascript" src="/asset/js/validate-checkbox.js"></script>
<script type='text/javascript' src="/asset/js/list.js"></script>
<script type="text/javascript">
	document.getElementById('inputGroupSelect01').value = "<?php if (isset($_GET['status'])) {echo $_GET['status'];}?>";
	document.getElementById('inputGroupSelectshow').value = "<?php if (isset($_GET['show'])) {echo $_GET['show'];}?>";
</script>
<?php
	include dirname(__DIR__,2) . "/view/modal_preview_list.php";
	include dirname(__DIR__,2) . "/view/modal_create_page.php";
?>
</body>
</html>