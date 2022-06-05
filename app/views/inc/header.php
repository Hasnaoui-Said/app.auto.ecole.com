<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />
	<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
	<meta content="" name="description" />
	<meta content="" name="author" />
	<!-- ================== BEGIN core-css ================== -->
	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
	<link href="<?php echo URLROOT; ?>/public/assets/css/vendor.min.css" rel="stylesheet" />
	<link href="<?php echo URLROOT; ?>/public/assets/css/default/app.min.css" rel="stylesheet" />
	<!-- ================== END core-css ================== -->
	
	<!-- ================== BEGIN page-css ================== -->
	<link href="<?php echo URLROOT; ?>/public/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
	<link href="<?php echo URLROOT; ?>/public/assets/plugins/bootstrap-datepicker/dist/css/bootstrap-datepicker.css" rel="stylesheet" />
	<link href="<?php echo URLROOT; ?>/public/assets/plugins/gritter/css/jquery.gritter.css" rel="stylesheet" />
	<!-- ================== END page-css ================== -->
	<!-- Title -->
	<title><?= SITENAME .' | '. $data['title'] ?></title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.2/css/boxicons.min.css" integrity="sha512-AGmpdsTqvAh2GvTWzVhhJ9VqQb1eAXwOM7uiWtv0DzcnGaGWy98K51z2cK5OG3gp4NB1HbMaD7p0MeO9kE7E3w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
	<!-- BEGIN #loader -->
	<div id="loader" class="app-loader">
		<span class="spinner"></span>
	</div>
	<!-- END #loader -->

	<!-- BEGIN #app -->
	<div id="app" class="app app-header-fixed app-sidebar-fixed ">
		
