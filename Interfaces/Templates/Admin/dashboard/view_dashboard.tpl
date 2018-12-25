<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left"><b>{$smarty.now|date_format:'%d-%m-%Y'}</b></h2>
	</div>
	<!-- End Box Head -->
	<div style="width: 40%;float: left;">
		<div class="box" style="margin-top: 10px;">
			<div class="box-head">
				<h2 id="patho">Reminders</h2>
			</div>
			<div class="form" id="patho_details">					
				{if 0 lt $reminders|@count}
				{foreach from=$reminders item='reminder'}
					<div class="msg msg-ok">
						<p><strong>{$reminder->getDescription()}</strong></p>
					</div>
				{/foreach}
				{else}
					No reminders...
				{/if}
			</div>
		</div>
		<div class="box" style="margin-top: 10px;">
			<div class="box-head">
				<h2 id="patho">Patients Counts</h2>
			</div>
			<div class="table">	
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>				
						<td><p>Pathology:</p>
						<td><strong>{$counts.pathology.0.customers}</strong></td>					
					</tr>
					<tr>				
						<td><p>USG:</p></td>
						<td><strong>{$counts.usg.0.customers}</strong></td>					
					</tr>
					<tr>				
						<td><p>XRay:</p></td>
						<td><strong>{$counts.xray.0.customers}</strong></td>					
					</tr>
					<tr>				
						<td><p>Total Patients:</p></td>
						{assign var="total" value="0"}
						{assign var="total" value=$counts.pathology.0.customers+$counts.usg.0.customers+$counts.xray.0.customers}
						<td><strong>{$total}</strong></td>					
					</tr>
				</table>				
			</div>			
		</div>
		<div class="box" style="margin-top: 10px;">
			<div class="box-head">
				<h2 id="patho">Collections</h2>
			</div>
			<div class="table">
				{assign var="today_collection" value=0}			
				{if false eq $current_day_patient_payments.amt|is_null}
					 {assign var="today_collection" value=$current_day_patient_payments.amt}
				{/if}
				
				{assign var="today_previous" value=0}			
				{if false eq $previous_day_patient_payments.amt|is_null}
					 {assign var="today_previous" value=$previous_day_patient_payments.amt}
				{/if}
				
				{assign var="today_expences" value=0}			
				{if false eq $expences.amt|is_null}
					 {assign var="today_expences" value=$expences.amt}
				{/if}
				
				{assign var="total" value=$today_collection+$today_previous-$today_expences}				 
				
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
					<tr>				
						<td><p>Today's collection:</p>
						<td><strong><img src="css/images/rupee.jpg" height="11px" width="12px">{$today_collection}</strong></td>					
					</tr>
					<tr>				
						<td><p>Previous Balance:</p></td>
						<td><strong><img src="css/images/rupee.jpg" height="11px" width="12px">{$today_previous}</strong></td>					
					</tr>
					<tr>				
						<td><p>Expences:</p></td>
						<td><strong><img src="css/images/rupee.jpg" height="11px" width="12px">{$today_expences}</strong></td>					
					</tr>
					<tr>				
						<td><p>Total:</p></td>						
						<td><strong><img src="css/images/rupee.jpg" height="11px" width="12px">{$total}</strong></td>					
					</tr>
				</table>				
			</div>			
		</div>
	</div>
	<div style="width: 55%;float: right;">
		<div class="box" style="margin-top: 10px;">
			<div class="box-head">
				<h2 id="patho">Patient Counts({$smarty.now|date_format:'%B'})</h2>
			</div>
			<div class="form" id="patho_details">
				<div id="chart"></div>
				{literal}
				<script type="text/javascript">	
					//Instantiate the Chart	
					var chart_ByCategory = new FusionCharts("FusionCharts/Pie3D.swf", "ByCategory", "428", "300", "0", "0");
										
					//Provide entire XML data using dataXML method
					chart_ByCategory.setDataXML("{/literal}{$xml}{literal}")
					//Finally, render the chart.
					chart_ByCategory.render("chart");
				</script>
				{/literal}				
			</div>
		</div>
	</div>
	<div style="clear: both;"></div>	
</div>
