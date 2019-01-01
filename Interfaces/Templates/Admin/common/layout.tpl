<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Clinic Management Software - Shree Diagnostic Clinic</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!-- script type="text/javascript" src="javascript/jquery.js"></script -->	
	<link rel="stylesheet" href="css/base/jquery.ui.all.css">
	
	<script type="text/javascript" src="javascript/jquery-1.6.2.js"></script>
	<script type="text/javascript" src="javascript/ui/jquery.ui.core.js"></script>
	<script type="text/javascript" src="javascript/ui/jquery.ui.widget.js"></script>
	<script type="text/javascript" src="javascript/ui/jquery.ui.datepicker.js"></script>
	<script type="text/javascript" src="javascript/ui/jquery.ui.button.js"></script>
	<script type="text/javascript" src="FusionCharts/FusionCharts.js"></script>
	<!--link rel="stylesheet" href="../demos.css"-->
	
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#"><marquee width="250px">Shree Diagnostic Clinic - New Look</marquee></a></h1>
			{include file="./common/header.tpl"}
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
			{include file="./common/main_navigations.tpl"}		
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container">
	<div class="shell">
		
		<!-- Small Nav -->
		<!-- <div class="small-nav">
			<a href="#">Dashboard</a>
			<span>&gt;</span>
			Current Articles
		</div> -->
		<!-- End Small Nav -->
		
		<!-- Message OK -->		
		<!-- <div class="msg msg-ok">
			<p><strong>Your file was uploaded succesifully!</strong></p>
			<a href="#" class="close">close</a>
		</div> -->
		<!-- End Message OK -->		
		
		<!-- Message Error -->
		<!-- <div class="msg msg-error">
			<p><strong>You must select a file to upload first!</strong></p>
			<a href="#" class="close">close</a>
		</div>-->
		<!-- End Message Error -->
		<br />
		<!-- Main -->
		<div id="main">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
				{$content}
				<!-- End Box -->
				
				<!-- Box -->
				
				<!-- End Box -->

			</div>
			<!-- End Content -->
			
			<!-- Sidebar -->
			<div id="sidebar">
				{if 'employees' eq $selected_tab}
					<!-- Box -->
					{include file="./employees/employee_listings.tpl"}
					<!-- End Box -->
				{else}
					<!-- Box -->
					{include file="./common/right_navigations.tpl"}
					<!-- End Box -->
				{/if}				
			</div>
			<!-- End Sidebar -->
			
			<div class="cl">&nbsp;</div>			
		</div>
		<!-- Main -->
	</div>
</div>
<!-- End Container -->

<!-- Footer -->
<div id="footer">
	<div class="shell">
		<span class="left">&copy; {$smarty.now|date_format:'%Y'} - Shree Diagnostic Clinic</span>
		<span class="right">
			Developed by Milind Chavan - 9890903180</a>
		</span>
	</div>
</div>
<!-- End Footer -->
	
</body>
</html>