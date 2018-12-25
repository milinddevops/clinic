{literal}
<script type="text/javascript">
<!--
	
		function deletePatient(id) {
			if (confirm("Are you sure to delete?")) {
				location.href = '{/literal}{$exit_tags.delete_patient}{literal}&patients[id]=' + id				
			}
		}
this.deletePatient = deletePatient;
//-->

</script>
{/literal}

<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left">Today's Patients</h2>
		<div class="right">
			<form name="frmSearch" id="frmSearch" action="/?module=patients&action=search_patients" method="post">
				<label>search patients</label>
				<input type="text" name="patients[search_text]" class="field small-field" />
				<input type="submit" class="button" value="Search" />
			</form>
		</div>
	</div>
	<!-- End Box Head -->	

	<!-- Table -->
	<div class="table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>				
				<th>Name</th>
				<th>Date</th>
				<th>Ref. Doctor</th>
				<th>IPD/OPD</th>
				<th>Bill Amt</th>
				<th>Received Amt</th>
				<th>Balance</th>
				<th width="110" class="ac">--</th>
			</tr>
			{if 0 < $patients|@count}
			{foreach from="$patients" item="patient"}
				<tr>				
					<td><h3><a href="#">{$patient->getFirstName()} {$patient->getLastName()}</a></h3></td>
					<td>{$patient->getReceivedDate()|date_format:"%b %e, %Y"}</td>
					<td><h3><a href="#">{assign var="doctor_id" value=$patient->getDoctorId()}
					{$doctors.$doctor_id->getFirstName()} {$doctors.$doctor_id->getLastName()}</a></h3></td>
					<td>
						{if 1 eq $patient->getPatientTypeId()}
							IPD
						{else}
							OPD
						{/if}
					</td>
					<td><img src="css/images/rupee.jpg" height="11px" width="12px">{$patient->getTotalBillAmt()}</td>
					<td><img src="css/images/rupee.jpg" height="11px" width="12px">{$patient->getReceivedAmt()}</td>
					{math equation="b-r" b=$patient->getTotalBillAmt() r=$patient->getReceivedAmt() assign="balance"}					
					<td {if 0 lt $balance}style="color: red; font-weight: bold;"{/if}><img src="css/images/rupee.jpg" height="11px" width="12px">{$balance}</td>
					<td><a href="javascript:deletePatient({$patient->getId()})" class="ico del">Delete</a><a href="{$exit_tags.edit_patient}&patient_id={$patient->getId()}" class="ico edit">Edit</a></td>
				</tr>
			{/foreach}
			{else}
				<tr>
					<td colspan="8">No patients...</td>
				</tr>
			{/if}
		</table>	
		
		<!-- Pagging -->
		<div class="pagging">			
			<div class="right">
				
				{if true eq is_null($page)}
					{assign var=page value=1}
				{/if}
				{math assign=offset equation="(x - y) * z" x=$page y=1 z=10}
								
				<div class="left">Showing {$offset+1}-{$offset+1+10} of {$patient_count.patients_count}</div>
				<a href="{$exit_tags.view_patients}&page={$page-1}">Previous</a>
				
				<a href="{$exit_tags.view_patients}&page={$page+1}"">Next</a>				
			</div>
		</div>
		<!-- End Pagging -->
		
	</div>
	<!-- Table -->
	
</div>







{*literal}
<script type="text/javascript">
<!--
function confirmToDelete( intPatientId ) {
	var isConfirmDelete = confirm("Do you really want to go to delete?");
	if( true == isConfirmDelete ) {
		window.location="{/literal}{$exit_tags.delete_patient}&patients[id]={literal}"+intPatientId;
	}		
}
//-->
</script>

<style>
<!--
.ico_mug {
    background: url("../images/patients.png") no-repeat scroll 5px center #F1F1F1;
    margin-bottom: 20px;
    padding-left: 40px;
    height: 105px;
}
-->
</style>

{/literal}
<div id="tabledata" class="section">
{include file="./common/messages.tpl"}
	<h2 class="ico_mug">		
		<dfn style="float: right">
			<a href="{$exit_tags.search_patient}">Search Patients</a>
			&nbsp;|&nbsp;
			<a href="{$exit_tags.add_patient}">Add New Patient</a>		
		</dfn>
	</h2>
		<table id="table">			
			{if true eq is_array($patients)}
			<thead>
			<tr>
				<th><input type="checkbox" class="noborder" /></th>
				<th>Date </th>
				<th>Patient Name</th>
				<th>Doctor Name</th>
				<th>Actions</th>
				<th>Payment Status</th>
			</tr>
			</thead>
			<tbody>			
			{foreach from="$patients" item="patient"}
			<tr>
				<td class="table_check"><input type="checkbox" class="noborder" /></td>
				<td class="table_date">{$patient->getReceivedDate()|date_format:"%b %e, %Y"}</td>
				<td class="table_title"><a href="#">{$patient->getFirstName()} {$patient->getLastName()}</a></td>
				<td>
					{assign var="doctor_id" value=$patient->getDoctorId()}
					{$doctors.$doctor_id->getFirstName()} {$doctors.$doctor_id->getLastName()}
				</td>
				<td>					
					<a href="{$exit_tags.edit_patient}&patient_id={$patient->getId()}">
						<img src="img/edit.jpg" alt="edit"/>
					</a>
					<a href="#">
						<img src="img/cancel.jpg" alt="cancel" onClick="confirmToDelete({$patient->getId()});"/>
					</a>					
				</td>
				<td>
					{if 0 lt $patient->getReceivedAmt()}
						<span class="approved">Paid</span>
					{else}
						<span class="ico_pending">Pending</span>
					{/if}
				</td>
			</tr>
			{/foreach}
			{else}
				<td colspan="6">No Patients found...</td>
			{/if}
			</tbody>
		</table>
			<!--<div id="table_options" class="clearfix">
				
				<ul>
					<li><a href="#">Select All</a></li>
					<li><a href="#">Select None</a></li>
					<li><label>	Action:<select id="kategoria" name="kategoria">
									<option value="1">Option 1</option> 
									<option value="2">Option 2</option> 
									<option value="3">Option 3</option> 
									<option value="4">Option 4</option> 
								</select>
				</label></li>
				</ul>
				
				
			</div>
			--><!--<div class="pagination">
				<span class="pages">Page 1 of 3&#8201;</span>
				<span class="current">1</span>
				<a href="#" title="2">2</a>
				<a href="#" title="3">3</a>
				<a href="#" >&raquo;</a>
			</div>
--></div> <!-- end #tabledata -->
*}