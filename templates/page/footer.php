<script type="text/javascript" >
	var root_path = '<?php echo DOMAIN ?>';
	CKEDITOR.replace( 'content', {
		filebrowserUploadMethod: 'form',
	 });
</script>
<script>
	$(document).ready(function() {
		setTimeout(function() {
			$(".alert").alert('close');
		}, 1500);
	});
</script>