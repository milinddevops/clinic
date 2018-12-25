{literal}
<script type="text/javascript">
<!--	
	function deleteDoctor(id) {
		if (confirm("Are you sure to delete?")) {
			location.href = '{/literal}{$exit_tags.delete_doctor}{literal}&doctors[id]=' + id;				
		}
	}
this.deleteDoctor = deleteDoctor;
//-->
</script>
{/literal}

<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left">Doctors</h2>
		<div class="right">
			<form name="frmSearch" id="frmSearch" action="{$exit_tags.search_doctors}" method="post">
				<label>search doctors</label>
				<input type="text" name="doctor[search_text]" class="field small-field" />
				<input type="submit" class="button" value="Search" />
			</form>
		</div>
	</div>
	<!-- End Box Head -->	

	<!-- Table -->
	<div class="table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>				
				<th>Doctor Name</th>
				<th>Phone</th>
				<th>E-mail</th>
				<th>Address</th>
				<th>Actions</th>
			</tr>
			{foreach from="$doctors" item="doctor"}
				<tr>				
					<td class="table_date">{$doctor->getFirstName()} {$doctor->getLastName()}</td>
					<td class="table_title">{$doctor->getPhone()}</td>
					<td>{$doctor->getEmail()}</td>
					<td>{$doctor->getAddress()}</td>
					<td><a href="javascript:deleteDoctor({$doctor->getId()})" class="ico del">Delete</a><a href="{$exit_tags.edit_doctor}&doctors[id]={$doctor->getId()}" class="ico edit">Edit</a></td>
				</tr>				
			{/foreach}
		</table>			
	</div>
	<!-- Table -->
	
</div>


{*
{literal}
<style>
<!--
.ico_mug {
    background: url("../images/doctors.png") no-repeat scroll 5px center #F1F1F1;
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
		<dfn style="float: right"><a href="{$exit_tags.add_doctor}">Add New Doctor</a></dfn>
	</h2>
		<table id="table">
			<thead>
			<tr>
				<th><input type="checkbox" class="noborder" /></th>
				<th widht="40px">Doctor Name</th>
				<th>Phone</th>
				<th>E-mail</th>
				<th>Address</th>
				<th>Actions</th>
			</tr>
			</thead>
			<tbody>
			{foreach from="$doctors" item="doctor"}
			<tr>
				<td class="table_check"><input type="checkbox" class="noborder" /></td>
				<td class="table_date">{$doctor->getFirstName()} {$doctor->getLastName()}</td>
				<td class="table_title">{$doctor->getPhone()}</td>
				<td>{$doctor->getEmail()}</td>
				<td>{$doctor->getAddress()}</td>
				<td>
					<a href="#">
						<img src="img/accept.jpg" alt="accepted"/>
					</a>
					<a href="#">
						<img src="img/edit.jpg" alt="edit"/>
					</a>
					<a href="#">
						<img src="img/cancel.jpg" alt="cancel"/>
					</a>
					<a href="#">
						<img src="img/folder.jpg" alt="folder"/>
					</a>
					
				</td>				
			</tr>
			{/foreach}
			
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