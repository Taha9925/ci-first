<?php $this->load->view('template/header.php');?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 jumbotron text-center">
			<h1>Welcome</h1>
			<h3>Sign In</h3>
			<a href="<?php echo base_url();?>register" class="btn btn-secondary" style="float: right;">Sign Up</a>
		</div>
		<div class="col-12 col-md-4 offset-md-4 box-shadows pad-t-b-15 mar-bot-2-rem ">
			<form action="<?php echo base_url();?>" method="POST" id="login_form">
				<div class="row">
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="email" name="email" id="email" placeholder="alex@mail.com" class="form-control" />
						</div>
					</div>
					<div class="col-12 col-md-12">
						<div class="form-group">
							<label for="password">Password</label>
							<input type="password" name="password" id="password" placeholder="**********" class="form-control" />
						</div>
					</div>
					<div class="col-12 col-md-12">
						<button type="submit" class="btn btn-outline-primary">Submit</button>
						<input class="btn btn-outline-secondary" type="reset" value="Reset">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<?php $this->load->view('template/footer.php');?>
<script type="text/javascript">

		$('#login_form').validate({
			errorElement: 'div',

		  	errorClass: 'help-block',

			rules : {
				email: {
					required: true,
				},
				password: {
					required: true
				},
			}
		});

</script>