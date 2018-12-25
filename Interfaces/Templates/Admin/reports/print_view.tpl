
<script type="text/javascript">document.write('<input type="button" value="Print Now" onclick="window.print();">');</script>
<table cellspacing="0" cellpadding="0" border="0.5" width="100%" style="border: 1px solid black;">
		{foreach from="$doctors" item="doctor"}
			{if false eq is_null($doctor->getPatients())}
			<tr><td colspan="2" align="center"><h3><b>Dr. {$doctor->getFirstName()} {$doctor->getLastName()}</b></h3></td></tr>
			<tr>				
				<td>
					<table cellspacing="0" cellpadding="0" border="0.5" width="100%" style="border: 1px solid black;">
						<tr>							
							<td width="20%"><b>Patient's Name</b></td>
							<td width="46%"><b>Pathology Tests</b></td>
							<td width="15%"><b>Date</b></td>
							{if -1 eq $doctor->getId()}
								<td width="7%"><b>Total Bill</b></td>
							{/if}
							<td width="7%"><b>Paid Amount</b></td>
							<td width="7%"><b>Lab. Charges</b></td>
							<td width="7%"><b>Ref. Fee</b></td>
						</tr>
						{assign var="doc_total_amt" value=0}
						{assign var="lab_charges_total" value=0}
						{assign var="ref_fee_total" value=0}
						{foreach from=$doctor->getPatients() item="patient"}
							<tr>							
								<td>{$patient->getTitle()} {$patient->getFirstName()} {$patient->getLastName()}</td>
								<td>
									{foreach from=$patient->getPathologyTests() item="pathology_test"}
										{$pathology_test->getName()},
									{/foreach}
								</td>
								<td>{$patient->getReceivedDate()|date_format:"%e-%B-%y"}</td>
								{if -1 eq $doctor->getId()}
									<td>{$patient->getTotalBillAmt()}</td>
								{/if}
								<td align="center">{$patient->getReceivedAmt()}</td>
								<td align="center">{if 0 eq $patient->getOpdAmt()}{$patient->getIpdAmt()}{else}*{/if}</td>
								<td align="center">{$patient->getOpdAmt()}</td>
							</tr>
							{if 0 eq $patient->getOpdAmt()}
								{assign var="lab_charges_total" value=$lab_charges_total+$patient->getIpdAmt()}
							{/if}
							{assign var="ref_fee_total" value=$ref_fee_total+$patient->getOpdAmt()}
							{assign var="doc_total_amt" value=$doc_total_amt+$patient->getOpdAmt()}
						{/foreach}
						<tr>
							<td {if -1 eq $doctor->getId()} colspan="5" {else} colspan="4" {/if}>&nbsp;</td>
							<td align="center">{$lab_charges_total}</td>
							<td align="center">{$ref_fee_total}</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr> <td colspan="2">&nbsp;</td> </tr>
			<tr>
				<td colspan="2" align="right" class="lable_text">
					<h3><b>Total
					{assign var="grand_total" value=0}	
					{if $ref_fee_total > $lab_charges_total}
						({$ref_fee_total} - {$lab_charges_total})
						{assign var="grand_total" value=$ref_fee_total-$lab_charges_total}
					{elseif $lab_charges_total > $ref_fee_total}
						({$lab_charges_total} - {$ref_fee_total})
						{assign var="grand_total" value=$lab_charges_total-$ref_fee_total}
					{/if}					
					&nbsp;&nbsp;Rs. {$grand_total}</b></h3>					
				</td>
			</tr>
			<tr><td colspan="2">&nbsp;</td></tr>
			{/if}
		{/foreach}
	</table>





{*
<table cellpadding="0" cellspacing="0" border="1" width="100%">
	<tr>
		<td align="center"><h1>Payments Report</h1></td>
	</tr>
	<tr>
		<td align="center">
			<table>
				<tr>
					<td>{$start_date}</td>
					<td>Thru</td>
					<td>{$end_date}</td>
				</tr>
			</table>
		</td>
	</tr>
	{foreach from="$doctors" item="doctor"}
	<tr>
		<td><h2>Dr. {$doctor->getFirstName()} {$doctor->getLastName()}</h2></td>
	</tr>
	<tr>
		<td>
			<table width="60%">
				<tr>
					<td><b>Sr. No.</b></td>
					<td><b>Date</b></td>
					<td><b>Patient Name</b></td>
					<td><b>Pathology Tests<b></td>
					<td><b>Amount</b></td>
				</tr>
				{assign var="counter" value=1}
				{foreach from=$doctor->getPatients() item="patient"}
					<tr>
						<td valign="top">{$counter}</td>
						<td valign="top">{$patient->getReceivedDate()}</td>
						<td valign="top">{$patient->getFirstName()} {$patient->getLastName()}</td>
						<td>									
							<table>
								{assign var="total" value=0}
								{foreach from=$patient->getPathologyTests() item="pathology_test"}
									<tr><td>{$pathology_test->getName()}</td></tr>
									{assign var="total" value=$total+$pathology_test->getDocRate()}
								{/foreach}
							</table>
						</td>
						<td valign="top">Rs {$total} /-</td>
					</tr>
					<tr><td colspan="5"><hr></td></tr>
					{assign var="counter" value=$counter+1}
					{assign var="main_total" value=$total+$main_total}
				{/foreach}				
			</table>
		</td>
	</tr>
	<tr>
		<td align="center"><h2>Total Amount: Rs.{$main_total}/-</h2></td>
	</tr>
	{assign var="main_total" value=0}
	{/foreach}
</table> *}