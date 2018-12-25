{literal}
<script type="text/javascript">
jQuery(document).ready(function() {
	$( "#start_date_picker" ).datepicker();
	$( "#end_date_picker" ).datepicker();
});
</script>
{/literal}

<link rel="stylesheet" type="text/css" href="css/calendar.css">

<!-- Box -->
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Create Report</h2>
	</div>
	<!-- End Box Head -->
	
	<form action="{$exit_tags.view_report}" method="post" name="frmSearch">
		
		<!-- Form -->
		<div class="form">
				<p>
					<label>For report printing use chrome browser.</label>
				</p>
				<p>
					<label>Start date</label>
					<input class="field size3" style="width: 272px;" type="text" id="start_date_picker" name="reports[start_date]">
				</p>
				<p>
					<label>End date</label>
					<input class="field size3" style="width: 272px;" type="text" id="end_date_picker" name="reports[end_date]">						
				</p>
				<label>OR Select year</label>
				{assign var=thisyear value=$smarty.now|date_format:"%Y"}
    			{assign var=endYear value=$thisyear-3}

    			<p>
    				<select class="field size1" style="width: 272px;" name="reports[year]">
    					<option value="">Year</option>
				        {section name=yearValue start=$endYear loop=$thisyear+1 step=1}<option value="{$smarty.section.yearValue.index}">{$smarty.section.yearValue.index}</option>
				        {/section}
				    </select>
    			</p>
				<p>
					<label>month</label>
					<select class="field size1" style="width: 272px;" name="reports[month]">
						<option value="">Month</option>
						<option value="1">January</option>
						<option value="2">Febrary</option>
						<option value="3">March</option>
						<option value="4">April</option>
						<option value="5">May</option>
						<option value="6">June</option>
						<option value="7">Jully</option>
						<option value="8">August</option>
						<option value="9">September</option>
						<option value="10">October</option>
						<option value="11">Novemeber</option>
						<option value="12">December</option>
					</select>
				</p>
				
				<p>
					<label>Select doctor</label>
					<select class="field size1" style="width: 272px;" name="reports[doctor_id]">
						<option value="">Select Doctor</option>
						<option value="all">All Doctors</option>
						{foreach from="$doctors" item="doctor"}
							<option value="{$doctor->getId()}">{$doctor->getFirstName()} {$doctor->getLastName()}</option>
						{/foreach}
					</select>
				</p>	
		</div>
		<!-- End Form -->
		
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Generate Report" />
		</div>
		<!-- End Form Buttons -->
	</form>
</div>
<!-- End Box -->

{*<link rel="stylesheet" type="text/css" href="css/calendar.css">
<script src="javascript/calendar_us.js" type="text/javascript"></script>

{literal}			
<script type="text/javascript">
$(document).ready(function(){
	$(".btn").click(function() {
			
			var formData = $("form").serialize();

			//showWaitingImage( 'content' );
			$.ajax({ 
					url: "{/literal}{$exit_tags.view_report}{literal}", 
					context: document.body,
					data: formData,
					success: function(html){
						$('#content').html(html);		        		
		      }});
		});
});
</script>
{/literal}
<div id="tabledata" class="section">
	<h2 class="ico_mug">
		Report
	</h2>
<form name="frmPatient" id="frmPatient" method="post" action="{$exit_tags.view_report}">
<fieldset>
	<legend><span>Create Report</span></legend>
	<table cellspacing="5" cellpadding="10" border="0" class="rounded_border">
		<tr>
			<td class="lable_text">
				Start Date
			</td>
			<td>
				<input class="text_box" type="text" id="start_date" name="reports[start_date]">
				{literal}
				<script language="JavaScript">
				new tcal ({
					// form name
					'formname': 'frmPatient',
					// input name
					'controlname': 'start_date'
				});		
				</script>
				{/literal}		
			</td>
		</tr>
		<tr>
			<td class="lable_text">
				End Date
			</td>
			<td>
				<input class="text_box" type="text" id="end_date" name="reports[end_date]">
				{literal}
				<script language="JavaScript">
				new tcal ({
					// form name
					'formname': 'frmPatient',
					// input name
					'controlname': 'end_date'
				});		
				</script>
				{/literal}
			</td>
		</tr>
		<tr>
			<td colspan="2" class="lable_text">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td class="lable_text">
				Ref. Doctor Name
			</td>
			<td>
				<select class="drop_downs" name="reports[doctor_id]">
					<option value="">Select Doctor</option>
					<option value="all">All Doctors</option>
					{foreach from="$doctors" item="doctor"}
						<option value="{$doctor->getId()}">{$doctor->getFirstName()} {$doctor->getLastName()}</option>
					{/foreach}
				</select>
			</td>
		</tr>
		<tr>
			<td> Options</td>
			<td> <input type="checkbox" name="options[]" value="1" class="text_box"></td>
		</tr>
		<tr>
			<td colspan="2" class="lable_text">
				&nbsp;
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="submit" value="Generate Report" />
			</td>
		</tr>
	</table>	
</fieldset>
</form>
</div>*}