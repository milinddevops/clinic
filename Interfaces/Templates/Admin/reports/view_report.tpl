{literal}
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
{/literal}
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left">CUT Report</h2>
	</div>
	<!-- End Box Head -->	

	<!-- Table -->
	<div>
	<textarea cols="40" id="cut_report_editor" name="cut_report_editor" rows="500">
	<div style="height: 800px;"> <!-- class="table" -->
		<table width="100%" border="1" cellspacing="0" cellpadding="0">
		{if false eq is_null($doctors)}
		{foreach from="$doctors" item="doctor"}
			{if false eq is_null($doctor->getPatients())}
			<tr><td colspan="2" align="center"><h3><b>Dr. {$doctor->getFirstName()} {$doctor->getLastName()}</b></h3></td></tr>
			{*<tr>				
				<td>
					<table cellspacing="0" cellpadding="0" border="0.5" width="100%">*}
					{* 	<tr>
							<td width="15%"><b>Date</b></td>							
							<td width="20%"><b>Patient's Name</b></td>
							<td width="46%"><b>Tests</b></td>
														
							<td width="7%"><b>Total Bill</b></td>
							
							<td width="7%"><b>Paid Amount</b></td>
							<td width="7%"><b>Clinic. Charges</b></td>
							<td width="7%"><b>Ref. Fee</b></td>
						</tr> *}
						{assign var="doc_total_amt" value=0}
						{assign var="lab_charges_total" value=0}
						{assign var="ref_fee_total" value=0}
						{foreach from=$doctor->getPatients() item="patient"}
							{* <tr>							
								<td>{$patient->getReceivedDate()|date_format:"%b %e, %Y"}</td>
								<td>{$patient->getTitle()} {$patient->getFirstName()} {$patient->getLastName()}</td>
								<td>
									{foreach from=$patient->getPathologyTests() item="pathology_test"}
										{$pathology_test->getName()},
									{/foreach}
								</td>							
									<td> qwe {$patient->getTotalBillAmt()}</td>
								
								<td align="center">{$patient->getReceivedAmt()}</td>
								<td align="center">{if 0 eq $patient->getOpdAmt()}{$patient->getIpdAmt()}{else}*{/if}</td>
								<td align="center">{if 0 lt $patient->getOpdAmt()}{$patient->getOpdAmt()}{else}*{/if}</td>
							</tr>*}
							{if 0 eq $patient->getOpdAmt()}
								{assign var="lab_charges_total" value=$lab_charges_total+$patient->getIpdAmt()}
							{/if}
							{assign var="ref_fee_total" value=$ref_fee_total+$patient->getOpdAmt()}
							{assign var="doc_total_amt" value=$doc_total_amt+$patient->getOpdAmt()}
						{/foreach}
						{*<tr>
							<td colspan="5">&nbsp;</td>
							<td align="center">{$lab_charges_total}</td>							
							<td align="center">{$ref_fee_total}</td>
						</tr>*}
					{*</table>
				</td>
			</tr>*}
			<tr>
				<td colspan="2" align="right" class="lable_text">
					<h3><b>Total	
					{assign var="grand_total" value=0}
					{if $ref_fee_total > $lab_charges_total}
						({$ref_fee_total} - {$lab_charges_total})
						{assign var="grand_total" value=$ref_fee_total-$lab_charges_total}
					{elseif $lab_charges_total > $ref_fee_total}
						Bill
						({$lab_charges_total} - {$ref_fee_total})
						{assign var="grand_total" value=$lab_charges_total-$ref_fee_total}
					{/if}					
					&nbsp;&nbsp;Rs. {$grand_total}</b></h3>					
				</td>
			</tr>
			<tr><td colspan="2">--</td></tr>
			{/if}
		{/foreach}			
		{/if}
	</table>			
	</div>
	</textarea>
	</div>
	{literal}
		<script type="text/javascript">
		//<![CDATA[

			// Replace the <textarea id="editor"> with an CKEditor
			// instance, using default configurations.
			CKEDITOR.replace( 'cut_report_editor',
				{
					extraPlugins : 'autogrow',
					autoGrow_maxHeight : 5200,
					removePlugins : 'resize',
					toolbar :
					[
						[ 'Print' ],[ 'Bold', 'Italic' ]
						
					]
				});

		//]]>
		</script>
	{/literal}
	<!-- Table -->
</div>