	$(function(){

		$.blockUI({ 
            message: '<p>Loading..</p>', 
            timeout: 500 
        });

		$("#message").slideDown();
		
		$("#message").slideUp(2000);

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
		$.ajax({
			url: "index/changeStatus",
			data: {user_id:user_id},
			type: "POST",
			success: function(data) {
				var oTable = $('#user_table').DataTable();
				oTable.ajax.reload();
			}
		});
	}
