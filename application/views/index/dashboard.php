<?php $this->load->view('template/header.php');?>
<div class="container-fluid">
	<div class="row">
		<div class="col-12 jumbotron text-center">
			<h1>Welcome <?php echo isset($this->user_session['user_id']) ? $this->user_session['name'] : "";  ?></h1>
			<h3>Dashboard</h3>
			<a href="<?php echo base_url();?>signout" class="btn btn-secondary" style="float: right;">Sign Out</a>
		</div>
	</div>
	<div class="row">
		<div class="col-12 offset-md-1 col-md-10 box-shadows pad-t-b-15 mar-bot-2-rem ">
			<table id="user_table" class="table table-responsive">
				<thead>
					<tr>
						<th>Id</th>
		                <th>Name</th>
		                <th>Dob</th>
		                <th>Contact</th>
		                <th>Gender</th>
		                <th>Address</th>
		                <th>Status</th>
		                <th>Created</th>
		                <th>Action</th>
		            </tr>
				</thead>
			</table>
		</div>
	</div>
</div>
<?php $this->load->view('template/footer.php');?>
<script type="text/javascript">
	$('#user_table').DataTable({
        "ajax": {
        			"url": "<?php echo base_url().'index/fetchUserFilter';?>",
        			"type": "POST"
        		},
        "processing": true,
        "serverSide": true,
        "columnDefs": [
	        { "orderable": false, "targets": [1,2,3,4,5,6,7,8] },
	        { "orderable": true, "targets": [0] }
	    ]
	});
</script>