{literal}
<script type="text/javascript">
<!--	
	function deletePatient(id) {
		if (confirm("Are you sure to delete?")) {
			location.href = '{/literal}{$exit_tags.delete_patient}{literal}&patients[id]=' + id +'&return=home'				
		}
	}
this.deletePatient = deletePatient;
//-->
</script>
{/literal}

<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left">Patients&nbsp;&nbsp;{$smarty.now|date_format:'%d-%m-%Y'}</h2>
		<div class="right">
			<form name="frmSearch" id="frmSearch" action="{$exit_tags.search_patients}" method="post">
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
			{assign var="bill_total" value=0}
			{assign var="received_total" value=0}
			{assign var="expence_total" value=0}
			{assign var="prev_bal" value=0}
			
			{foreach from="$patients" item="patient"}
				{assign var="received_total" value=$received_total+$patient->getReceivedAmt()}
				{assign var="bill_total" value=$bill_total+$patient->getTotalBillAmt()}
			{/foreach}
			{foreach from="$expences" item="expence"}
				{assign var="expence_total" value=$expence_total+$expence->getAmount()}
			{/foreach}
			
			{math equation="r-e" r=$received_total e=$expence_total assign="final_collection1"}
			
			{if false eq is_null($total_previous_balance.total_balance)}
				{assign var="prev_bal" value=$total_previous_balance.total_balance}
			{/if}
			
			{math equation="fc1+pb" fc1=$final_collection1 pb=$prev_bal assign="final_collection"}
			{if true eq 'COLLECTIONS'|array_key_exists:$user_permissions}
				{*<tr>				
					<th colspan="9">
					Final Collections:&nbsp;<img src="css/images/rupee.jpg" height="11px" width="12px">{$final_collection}
					&nbsp; Total Received:&nbsp;<img src="css/images/rupee.jpg" height="11px" width="12px">{$received_total}
					&nbsp; Previous Balance:&nbsp;<img src="css/images/rupee.jpg" height="11px" width="12px">{$prev_bal}
					&nbsp;Expences:<img src="css/images/rupee.jpg" height="11px" width="12px">{$expence_total}</th>				
				</tr>*}
			{/if}
			<tr>
				<th>Sr. No.</th>	
				<th>Name</th>
				<th>Date</th>
				<th>Ref. Doctor</th>
				<th>OPD/IPD</th>
				<th>Bill</th>
				<th>Received</th>
				<th>Balance</th>
				<th width="110" class="ac">--</th>
			</tr>
			{if 0 lt $patients|@count}
			{foreach from="$patients" item="patient"}
				<tr>				
					<td>{$patient->getSrNo()}</td>
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
					<td><img src="css/images/rupee.jpg" height="11px" width="12px">
						{if $patient->getReceivedDate() eq $patient->getUpdatedOn()}
							{$patient->getReceivedAmt()}
						{else}
							{if $smarty.now|date_format:'%Y-%m-%d' eq $patient->getUpdatedOn()|date_format:'%Y-%m-%d' and $patient->getTotalBillAmt() eq $patient->getReceivedAmt() and $patient->getBalanceStatusTypeId() neq 2}
								{if 0 eq $patient->getBalanceAmt()}
									{$patient->getReceivedAmt()}
								{else}
									{$patient->getBalanceAmt()}
								{/if}						
							{else}
								{$patient->getReceivedAmt()}
							{/if}
						{/if}
					</td>
					{math equation="b-r" b=$patient->getTotalBillAmt() r=$patient->getReceivedAmt() assign="balance"}					
					<td {if 0 lt $balance}style="color: red; font-weight: bold;"{/if}><img src="css/images/rupee.jpg" height="11px" width="12px">{$balance}</td>
					<td width="220px">
						<a href="javascript:deletePatient({$patient->getId()})" class="ico del">Delete</a>
						<a href="{$exit_tags.edit_patient}&patient_id={$patient->getId()}&return=home" class="ico edit">Edit</a>
						<a href="{$exit_tags.view_patient_payments}&patient_id={$patient->getId()}" class="ico edit">Billing</a>
					</td>
				</tr>				
			{/foreach}
			{else}
				<tr>				
					<td colspan="8"><h3>No Patients...</h3></td>
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
				<a href="{$exit_tags.search_patients}&page={$page-1}&patients[search_text]={$search_text}">Previous</a>
				
				<a href="{$exit_tags.search_patients}&page={$page+1}&patients[search_text]={$search_text}">Next</a>				
			</div>
		</div>
		<!-- End Pagging -->
		
	</div>
	<!-- Table -->
	
</div>




{*ytryryr
<div id="center-column">
                <div class="top-bar">
                    <a href="#" class="button">ADD NEW PATIENT</a>
                    <h1>Today's Patients</h1>
                    
                </div>
                <div class="select-bar" style="border-top:none;">
                    
                </div>
                <div class="table">
                    <table class="listing" cellpadding="0" cellspacing="0">
                        <tr>
                            <th>Patient Name</th>
                            <th>Header</th>
                            <th>Head</th>
                            <th>Header</th>
                            <th>Header</th>
                            
                            <th>Head</th>
                            <th>Header</th>
                            <th>Head</th>
                        </tr>
                        <tr>
                            <td class="style1">- Lorem Ipsum </td>
                            <td><img src="/img/add-icon.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/edit-icon.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/login-icon.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="style2">- Lorem Ipsum </td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                            <td><img src="img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="img/login-icon.gif" width="16" height="16" alt="login" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="style3">- Lorem Ipsum </td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                            <td><img src="img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="img/login-icon.gif" width="16" height="16" alt="login" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="style1">- Lorem Ipsum </td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                            <td><img src="img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="img/login-icon.gif" width="16" height="16" alt="login" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="style2">- Lorem Ipsum </td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                            <td><img src="img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="img/login-icon.gif" width="16" height="16" alt="login" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="style3">- Lorem Ipsum </td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                            <td><img src="img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="img/login-icon.gif" width="16" height="16" alt="login" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                        <tr>
                            <td class="style4">- Lorem Ipsum </td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                            <td><img src="img/hr.gif" width="16" height="16" alt="" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/edit-icon.gif" width="16" height="16" alt="edit" /></td>
                            <td><img src="img/login-icon.gif" width="16" height="16" alt="login" /></td>
                            <td><img src="img/save-icon.gif" width="16" height="16" alt="save" /></td>
                            <td><img src="img/add-icon.gif" width="16" height="16" alt="add" /></td>
                        </tr>
                    </table>
                    <div class="select">
                        <strong>Other Pages: </strong>
                        <select>
                            <option>1</option>
                        </select>
                    </div>
                </div>                
            </div>*}

{*<div id="content_main" class="clearfix">
			<div id="main_panel_container" class="left">		
	<div id="shortcuts" class="clearfix">
		<h2 class="ico_mug">Panel shortcuts</h2>
		<ul>
			<li class="first_li"><a href=""><img src="img/theme.jpg" alt="themes" /><span>Reports</span></a></li>
			<li><a href=""><img src="img/statistic.jpg" alt="statistics" /><span>Statistics</span></a></li>
			<li><a href=""><img src="img/ftp.jpg" alt="FTP" /><span>Data Backup</span></a></li>
			<li><a href=""><img src="images/users.png" height="80" alt="Users" /><span>Users</span></a></li>
			<li><a href="{$exit_tags.view_patients}"><img height="80" src="images/patients.png" alt="Patients" /><span>Patients</span></a></li>
			<li><a href="{$exit_tags.view_doctors}"><img height="80" src="images/doctors.png" alt="Doctors" /><span>Doctors</span></a></li>
			<li><a href=""><img src="images/employees.png" height="80" alt="Security" /><span>Employees</span></a></li>
			
		</ul>
	</div><!-- end #shortcuts -->
</div>
</div>*}