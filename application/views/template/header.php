<!DOCTYPE html>
<html>
<head>

	<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
	<title><?php echo $title.' | '.PROJECT_NAME;?></title>

	<!-- Google Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

	<!-- Bootstrap Css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap.css">

	<!-- DATATTABLE CSS -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.18/css/jquery.dataTables.min.css">

	<!-- Bootstrap Datepicker -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/bootstrap_datepicker.css">

	<!-- Selectize -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/selectize.css">

	<!-- Datatables Css -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/datatables.css">

	<!-- Custome Styles -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url();?>public/css/style.css">
	
</head>
<body>
	<?php $flash = $this->session->flashdata();?>
	<?php if(!empty($flash)) { ?>
		<div id="message" class="flash-message <?php echo $flash['message_type'];?>" style="display: none;z-index: 999;">
			<?php echo $flash['message'];?>
		</div>
	<?php } ?>