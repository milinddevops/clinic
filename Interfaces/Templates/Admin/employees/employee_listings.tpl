{literal}
<script type="text/javascript">

	jQuery(document).ready(function() {
		function loadEmployee(id) {
			jQuery.ajax({
				  url: "{/literal}{$exit_tags.load_employee}{literal}&user[id]=" + id,
				  success: function(data){
				    jQuery("#employee_details").html(data);
				  }
				});
		}

		this.loadEmployee = loadEmployee;
	});

</script>
{/literal}

<div class="box">					
	<!-- Box Head -->
	<div class="box-head">
		<h2>Employees</h2>
	</div>
<!-- Table -->
	<div class="table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			{foreach from=$users item="user"}
				<tr>
					<td onclick="loadEmployee({$user->getId()})" class="table_date" style="cursor: pointer; {if $selected_user->getId() eq $user->getId()}background: #fff9e1; font-weight: bold;{/if}">{$user->getFirstName()} {$user->getLastName()}</td>
				</tr>
			{/foreach}
		</table>			
	</div>
</div>
{*<div class="box">					
	<!-- Box Head -->
	<div class="box-head">
		<h2>Employees</h2>
	</div>
	<!-- End Box Head-->	
	<div class="box-content">
		<a href="{$exit_tags.add_patient}" class="add-button"><span>Ashwini Chavan</span></a> 
		<br /><br /><br />
		<a href="{$exit_tags.add_doctor}" class="add-button"><span>Milind Chavan</span></a>
		<div class="cl">&nbsp;</div>
		<br /><br />
		<a href="{$exit_tags.add_doctor}" class="add-button"><span>Milind Chavan</span></a>
		<div class="cl">&nbsp;</div>
		<br /><br />
		<a href="{$exit_tags.add_doctor}" class="add-button"><span>Milind Chavan</span></a>
		<div class="cl">&nbsp;</div>
		<br /><br />
		<a href="{$exit_tags.add_doctor}" class="add-button"><span>Milind Chavan</span></a>
		<div class="cl">&nbsp;</div>
		<br /><br />
	</div>
</div>
*}