<?php $this->load->view('template/header.php');?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 jumbotron text-center">
			<h1>Welcome</h1>
			<h3>Sign Up</h3>
			<a href="<?php echo base_url();?>" class="btn btn-success" style="float: right;">Sign In</a>
		</div>
		<div class="col-12 col-md-6 offset-md-3 box-shadows pad-t-b-15 mar-bot-2-rem ">
			<form action="<?php echo base_url();?>register" method="POST" id="register_form">
				<div class="row">
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="fname">First Name</label>
							<input type="text" name="fname" id="fname" placeholder="Alexander" class="form-control" />
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="lname">Last Name</label>
							<input type="text" name="lname" id="lname" placeholder="White" class="form-control" />
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" placeholder="alex@gmail.com" class="form-control" />
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="dob">DOB</label>
							<input type="text" name="dob" id="dob" class="form-control datepicker" placeholder="01/01/1996" />
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="mobile">Mobile</label>
							<input type="text" name="mobile" id="mobile" placeholder="9876543210" class="form-control" />
						</div>
					</div>
					<div class="col-12 col-md-6">
						<label>Gender</label><br>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="Male" checked="true">
						  	<label class="form-check-label" for="inlineRadio1">Male</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="Female">
						  	<label class="form-check-label" for="inlineRadio2">Female</label>
						</div>
						<div class="form-check form-check-inline">
						  	<input class="form-check-input" type="radio" name="gender" id="inlineRadio3" value="Other">
						  	<label class="form-check-label" for="inlineRadio3">Other</label>
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="address">Address</label>
							<textarea type="text" name="address" id="address" placeholder="A/4 Unit Hills" class="form-control"></textarea>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="state">State</label>
							<select name="state" id="state" placeholder="Select State" class="">
								<?php foreach ($states as $key => $value) { ?>
								<option value="<?php echo $value->state;?>"><?php echo $value->state;?></option>
								<?php } ?>	
							</select>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="city">City</label>
							<select name="city" id="city" placeholder="Select City" class="">
								<?php foreach ($city as $key => $value) { ?>
								<option value="<?php echo $value->city;?>"><?php echo $value->city;?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" placeholder="**********" class="form-control p-r-40" />
						</div>
					</div>
					<div class="col-12 col-md-6">
						<div class="form-group">
							<label for="conf_password">Re-Enter Password</label>
							<input type="password" name="conf_password" id="conf_password" placeholder="**********" class="form-control" />
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-check">
						  <input class="form-check-input" type="checkbox" value="" id="terms">
						  <label class="form-check-label" for="terms">
					    	<p>
					    		By clicking Sign Up, you agree to our <a href="javascript:void();">Terms</a> and that you have read our <a href="javascript:void();">Data Use Policy</a>, including our <a href="javascript:void();">Cookie</a> Use.
					    	</p>
						  </label>
						</div>
					</div>
					<div class="col-12 col-md-6">
						<button type="submit" class="btn btn-primary">Submit</button>
						<input class="btn btn-secondary" type="reset" value="Reset">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('template/footer.php');?>
<script type="text/javascript">

		$('#state').on('change',function(){
			var state_name = $('#state').val();
			blockUI();	
			$.ajax({
				url: "<?php echo base_url();?>index/getCities",
				data: {state:state_name},
				type: "POST",
				success: function(data) {
					$('#city').selectize()[0].selectize.destroy();
					$('#city').html(data);
					$('#city').removeClass('form-control');
					$('#city').selectize();
					unblockUI();
				} 
			});
		});

		$('#register_form').validate({
			errorElement: 'div',

		  	errorClass: 'help-block',

			rules : {
				fname: {
					required: true,
					lettersonly: true,
					maxlength: 10
				},
				lname: {
					required: true,
					lettersonly: true,
					maxlength: 10
				},
				email: {
					required: true,
					email: true
				},
				dob: {
					required: true,
				},
				mobile: {
					required: true,
					number: true,
					minlength: 10,
					maxlength: 10
				},
				address: {
					required: true,
				},
				state: {
					required: true,
				},
				city: {
					required: true,
				},
				password: {
					required: true,
					minlength: 8,
					maxlength: 16
				},
				conf_password: {
					equalTo: '#password',
					minlength: 8,
					maxlength: 16
				}
			}
		});

		$('#state').selectize();
		$('#city').selectize();

</script>