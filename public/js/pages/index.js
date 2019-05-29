	$(function(){

		$.blockUI({ 
            message: '<p>Loading..</p>', 
            timeout: 500 
        });
		
		$("#message").show();
		$("#message").fadeOut(5000);

        $(".toggle-password").click(function() {

		  	$(this).toggleClass("fa-eye fa-eye-slash");
		  	var input = $($(this).attr("toggle"));
		  	if (input.attr("type") == "password") {
		    	input.attr("type", "text");
		  	} else {
		    	input.attr("type", "password");
		  	}
		});

		//Datepicker
		$('.datepicker').datepicker({
			format: "dd/mm/yyyy",
			startDate: "01/01/1930",
			autoclose: true
		});

		// JQUERY VALIDATION LETTERS ONLY
		jQuery.validator.addMethod("lettersonly", function(value, element) 
		{
		return this.optional(element) || /^[a-z," "]+$/i.test(value);
		}, "Letters and spaces only please"); 

	});

	function blockUI() {
	    $(function() {
	        $.blockUI({ message: '<p>Please wait..</p>' });
	    });    
	}

	function unblockUI() {
	    $(function() {
	        $.unblockUI();
	    });
	}

	function changeUserStatus(user_id) {
		bootbox.confirm({
			size: "medium",
			message: "Are you sure?",
			callback: function(result){
				if(result) {
					$.ajax({
						url: "index/changeStatus",
						data: {user_id:user_id},
						type: "POST",
						success: function(data) {
							if (data == 'success') {
								var oTable = $('#user_table').DataTable();
								oTable.ajax.reload();
							} else {
								alert('Error occured! Please try after some time');
							}
							
						}
					});	
				}
			}
		});
	}

	function deleteUser(user_id) {
		bootbox.confirm({
			size: "medium",
			message: "Are you sure?",
			callback: function(result){
				if(result) {
					$.ajax({
						url: "index/deleteUser",
						data: {user_id:user_id},
						type: "POST",
						success: function(data) {
							if(data == 'success') {
								var oTable = $('#user_table').DataTable();
								oTable.ajax.reload();
							} else {
								alert('Error occured! Please try after some time');
							}
							
						}
					});	
				}
			}
		});
	}
