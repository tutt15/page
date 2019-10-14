	//select all checkbox
	var select_all = document.getElementById("select_all"); 
	var checkboxes = document.getElementsByClassName("checkbox"); //checkbox items

	//select all checkboxes
	select_all.addEventListener("change", function(e){
		for (i = 0; i < checkboxes.length; i++) { 
			checkboxes[i].checked = select_all.checked;
		}
	});

	for (var i = 0; i < checkboxes.length; i++) {
		//".checkbox" change 
		//uncheck "select all", if one of the listed checkbox item is unchecked
		checkboxes[i].addEventListener('change', function(e){ 
			if(this.checked == false){
				select_all.checked = false;
			}
			//check "select all" if all checkbox items are checked
			if(document.querySelectorAll('.checkbox:checked').length == checkboxes.length){
				select_all.checked = true;
			}
		});
	}
	//validate submit form upload and delete
	function submitForm() {
		var flag=0;
		$('.checkbox').each(function(){
			if(($(this).is(':checked'))){
				flag=1;
			}
		});
		if(flag==0){
			alert("Please Check Checkbox");
			return false;
		}
		if(confirm('Are you sure?')) {
			$('#sbform').submit();
			return true;
		}
		return false;
	}
