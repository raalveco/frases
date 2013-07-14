<!DOCTYPE html>
<html lang="en">
<head>
	<!--
		Charisma v1.0.0

		Copyright 2012 Muhammad Usman
		Licensed under the Apache License v2.0
		http://www.apache.org/licenses/LICENSE-2.0

		http://usman.it
		http://twitter.com/halalit_usman
	-->
	<meta charset="utf-8">
	<title><?= "CONFIGURACION_ TITULO" ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="Charisma, a fully featured, responsive, HTML5, Bootstrap admin template.">
	<meta name="author" content="Muhammad Usman">

	<!-- The styles -->
	<?php
		$this->config->load('config'); 
		$base_url = $this->config->item('base_url');
		
		$this->load->helper('html');
	?>
	<link id="bs-css" href="<?= $base_url ?>css/bootstrap-classic.css" rel="stylesheet">
	<style type="text/css">
	  body {
		padding-bottom: 40px;
	  }
	  .sidebar-nav {
		padding: 9px 0;
	  }
	</style>
	<link href="<?= $base_url ?>css/bootstrap-responsive.css" rel="stylesheet">
	<link href="<?= $base_url ?>css/charisma-app.css" rel="stylesheet">
	<link href="<?= $base_url ?>css/jquery-ui-1.8.21.custom.css" rel="stylesheet">
	<link href='<?= $base_url ?>css/fullcalendar.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/fullcalendar.print.css' rel='stylesheet'  media='print'>
	<link href='<?= $base_url ?>css/chosen.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/uniform.default.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/colorbox.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/jquery.cleditor.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/jquery.noty.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/noty_theme_default.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/elfinder.min.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/elfinder.theme.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/jquery.iphone.toggle.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/opa-icons.css' rel='stylesheet'>
	<link href='<?= $base_url ?>css/uploadify.css' rel='stylesheet'>

	<!-- The HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<!-- The fav icon -->
	<link rel="shortcut icon" href="<?= $base_url ?>img/favicon.ico">
	<style type="text/css">
		th{
			text-align: center !important;
			vertical-align: middle !important;
		}
		
		td{
			vertical-align: middle !important;
		}
		
		.center{
			text-align: center !important;
		}
	</style>
</head>

<body>
		<!-- topbar starts -->
	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".top-nav.nav-collapse,.sidebar-nav.nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>
				<a class="brand" href="index.html"> <img alt="Charisma Logo" src="<?= $base_url ?>img/logo20.png" /> <span>Charisma</span></a>
				
				<!-- user dropdown starts -->
				<div class="btn-group pull-right" >
					<a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
						<i class="icon-user"></i><span class="hidden-phone"> admin</span>
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="#">Profile</a></li>
						<li class="divider"></li>
						<li><a href="login.html">Logout</a></li>
					</ul>
				</div>
				<!-- user dropdown ends -->
				<!--
				<div class="top-nav nav-collapse">
					<ul class="nav">
						<li><a href="#">Visit Site</a></li>
						<li>
							<form class="navbar-search pull-left">
								<input placeholder="Search" class="search-query span2" name="query" type="text">
							</form>
						</li>
					</ul>
				</div><!--/.nav-collapse -->
			</div>
		</div>
	</div>
	<!-- topbar ends -->
		<div class="container-fluid">
		<br><br><br><br>
		<div class="row-fluid">
				
			<!-- left menu starts -->
			<div class="span2 main-menu-span">
				<div class="well nav-collapse sidebar-nav">
					<ul class="nav nav-tabs nav-stacked main-menu">
						<li class="nav-header hidden-tablet"></li>
						<li><a class="ajax-link" href="<?= $base_url ?>index.php/configurations"><i class="icon-wrench"></i><span class="hidden-tablet"> Configuración</span></a></li>
						<li class="nav-header hidden-tablet"></li>
						<li><a class="ajax-link" href="<?= $base_url ?>index.php/categories"><i class="icon-list"></i><span class="hidden-tablet"> Categorías</span></a></li>
						<li><a class="ajax-link" href="<?= $base_url ?>index.php/backgrounds"><i class="icon-home"></i><span class="hidden-tablet"> Fondos</span></a></li>
						<li><a class="ajax-link" href="<?= $base_url ?>index.php/fonts"><i class="icon-picture"></i><span class="hidden-tablet"> Tipografías</span></a></li>
						<li><a class="ajax-link" href="<?= $base_url ?>index.php/tags"><i class="icon-tags"></i><span class="hidden-tablet"> Etiquetas</span></a></li>
						<li class="nav-header hidden-tablet"></li>
						<li><a class="ajax-link" href="<?= $base_url ?>index.php/phrases"><i class="icon-pencil"></i><span class="hidden-tablet"> Frases</span></a></li>
						<li class="nav-header hidden-tablet"></li>
						<li><a class="ajax-link" href="<?= $base_url ?>index.php/pages"><i class="icon-book"></i><span class="hidden-tablet"> Páginas</span></a></li>
						<li class="nav-header hidden-tablet"></li>
						<li><a class="ajax-link" href="<?= $base_url ?>index.php/users"><i class="icon-user"></i><span class="hidden-tablet"> Usuarios</span></a></li>
					</ul>
				</div><!--/.well -->
			</div><!--/span-->
			<!-- left menu ends -->
			
			<noscript>
				<div class="alert alert-block span10">
					<h4 class="alert-heading">Warning!</h4>
					<p>You need to have <a href="http://en.wikipedia.org/wiki/JavaScript" target="_blank">JavaScript</a> enabled to use this site.</p>
				</div>
			</noscript>
			
			<div id="content" class="span10">