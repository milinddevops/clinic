{literal}
<script type="text/javascript" src="javascript/jquery.autocomplete.js"></script>
<script type="text/javascript">
<!--
	jQuery(document).ready(function() {
		$( "#dtp_databack_start_date" ).datepicker();
		$( "#dtp_databack_end_date" ).datepicker();
		});
//-->
</script>
{/literal}
<link rel="stylesheet" type="text/css" href="css/auto_styles.css">
<link rel="stylesheet" type="text/css" href="css/calendar.css">
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Databackup</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="frmTest" id="frmTest" action="{$exit_tags.insert_databackup}" method="post">
		
		<!-- Form -->
		<div class="form" style="width: 45%;float: left;">			
			{if false eq $is_data_backup}
				<p>
					<label>Backup file 'data_backup_on_{$smarty.now|date_format:'%Y%m%d'}'.sql will be created.</label>
				</p>
				<p>					
					<label>Backup start date</label>
					<input id="dtp_databack_start_date" type="text" name="databackup[start_date]" class="field size2" style="width: 272px;" value="" readonly>				
				</p>
				<p>					
					<label>Backup end date</label>
					<input id="dtp_databack_end_date" type="text" name="databackup[end_date]" class="field size2" style="width: 272px;" value="" readonly>
				</p>
			{else}
				Data backup successfuly.			
			{/if}
		</div>
		<!-- End Form -->
		<div style="clear: both;"></div>
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<input type="button" class="button" id="back" value="Cancel" />			
		</div>
		<!-- End Form Buttons -->
		<input type="hidden" name="pathology_test[id]" value="">
	</form>
</div>