{literal}
<script type="text/javascript">
jQuery(document).ready(function() {
	$( "#start_date_picker" ).datepicker();
	$( "#end_date_picker" ).datepicker();

	jQuery('#report_type').change(function() {
		if( 3 == jQuery('#report_type').val() ) {
			jQuery('#doctor').show('slow');
		}
	});
});
</script>
{/literal}

<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Statistical Report</h2>
	</div>
	<form name="frmPatient" id="frmPatient" action="{$exit_tags.clinic_statistics}" method="post">
		<!-- Form -->
		<div class="form">			
			<p>					
				<label>Start date</label>				
				<input id="start_date_picker" value="{$first_date}" type="text" name="clinic_statistics[start_date]" class="field size2" style="width: 172px;" value="" readonly>
			</p>
			<p>					
				<label>End date</label>
				<input id="end_date_picker" value="{$last_date}" type="text" name="clinic_statistics[end_date]" class="field size2" style="width: 172px;" value="" readonly>
			</p>
			<p class="inline-field">
				<label>Report Type</label>
				<select class="field size1" name="clinic_statistics[report_type]" id="report_type" style="width: 280px;">
					<option value="">Select Report Type</option>
					<option value="1" {if '1' eq $type}selected{/if}>Patients Counts By Dates</option>
					<option value="2" {if '2' eq $type}selected{/if}>Patients Counts By Doctors</option>				
					<option value="3" {if '3' eq $type}selected{/if}>Doctorwize Quaterly report </option>
				</select>
			</p>
			<p class="inline-field" id="doctor" style="display: none;">
				<label>Doctor</label>
				<select class="field size1" name="clinic_statistics[doctor]" style="width: 280px;">
					<option value="">Select Report Type</option>
					{foreach from=$doctors item="doctor"}
						<option value="{$doctor->getId()}">{$doctor->getFirstName()} {$doctor->getLastName()}</option>
					{/foreach}
				</select>
			</p>
		</div>
		<div class="buttons">
			<input type="submit" class="button" value="Generate Report" />
		</div>
	</form>
	
	<div style="margin-top: 100px;" id="chart"></div>	
</div>

{if '1' eq $type}
{literal}
<script type="text/javascript">	
		//Instantiate the Chart	
		var chart_ByCategory = new FusionCharts("FusionCharts/MSColumn3DLineDY.swf", "ByCategory", "740", "300", "0", "0");
		
		//Provide entire XML data using dataXML method
		chart_ByCategory.setDataXML("{/literal}{$strXML}{literal}")
		
		//Finally, render the chart.
		chart_ByCategory.render("chart");
	</script>
{/literal}
{elseif '2' eq $type}
{$strXML}
{literal}
<script type="text/javascript">	
	//Instantiate the Chart	
	var chart_ByCategory = new FusionCharts("FusionCharts/Pie3D.swf", "ByCategory", "850", "300", "0", "0");
						
	//Provide entire XML data using dataXML method
	chart_ByCategory.setDataXML("{/literal}{$strXML}{literal}")
	//Finally, render the chart.
	chart_ByCategory.render("chart");
</script>
{/literal}
{elseif '3' eq $type}

{literal}
<script type="text/javascript">	
		//Instantiate the Chart	
		var chart_ByCategory = new FusionCharts("FusionCharts/Pie3D.swf", "ByCategory", "940", "1500", "0", "0");
		
		//Provide entire XML data using dataXML method
		chart_ByCategory.setDataXML("{/literal}{$strXML}{literal}")
		
		//Finally, render the chart.
		chart_ByCategory.render("chart");
	</script>
{/literal}
{/if}