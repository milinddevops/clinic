<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<title>Clinic Management Software - Shree Diagnostic Clinic</title>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
</head>
<body>
<!-- Header -->
<div id="header">
	<div class="shell">
		<!-- Logo + Top Nav -->
		<div id="top">
			<h1><a href="#"> <marquee>Shree Diagnostic Clinic - New look</marquee></a></h1>
			<!-- <div id="top-navigation">
				Welcome <a href="#"><strong>Administrator</strong></a>
				<span>|</span>
				<a href="#">Help</a>
				<span>|</span>
				<a href="#">Profile Settings</a>
				<span>|</span>
				<a href="#">Log out</a>
			</div> -->
		</div>
		<!-- End Logo + Top Nav -->
		
		<!-- Main Nav -->
			{*include file="./common/main_navigations.tpl"*}		
		<!-- End Main Nav -->
	</div>
</div>
<!-- End Header -->

<!-- Container -->
<div id="container" style="height: 238px;">
	<div class="shell">
		
		<!-- Small Nav -->
		<!--<div class="small-nav">
			<a href="#">Dashboard</a>
			<span>&gt;</span>
			Current Articles
		</div> -->
		<!-- End Small Nav -->
		
		<!-- Message OK -->		
		<!--  <div class="msg msg-ok">
			<p><strong>Your file was uploaded succesifully!</strong></p>
			<a href="#" class="close">close</a>
		</div>-->
		<!-- End Message OK -->		
		
		<!-- Message Error -->
		<!-- <div class="msg msg-error">
			<p><strong>You must select a file to upload first!</strong></p>
			<a href="#" class="close">close</a>
		</div> -->
		<!-- End Message Error -->
		<br />
		<!-- Main -->
		<div id="main" style="height: 100%;">
			<div class="cl">&nbsp;</div>
			
			<!-- Content -->
			<div id="content">
				
				<!-- Box -->
					<!-- Pagin Box -->
				<!-- End Box -->
				
				<!-- Box -->
					{$content}
				<!-- End Box -->

			</div>
			<!-- End Content -->
			
			<!-- Sidebar -->
			<div id="sidebar">
				
				<!-- Box -->
				<!-- Side Bar Box -->
				<!-- End Box -->
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