<div class="box">					
	<!-- Box Head -->
	<div class="box-head">
		<h2>Quick links</h2>
	</div>
	<!-- End Box Head-->	
	<div class="box-content">
		{if 'employees' eq $selected_tab}
			<a href="{$exit_tags.review_patients}" class="add-button"><span>View patients</span></a> 
			<br /><br /><br />	
		{/if}
		{if 'expences' eq $selected_tab}
			<a href="{$exit_tags.add_expence}" class="add-button"><span>Add expense</span></a> 
			<br /><br /><br />
			<a href="{$exit_tags.view_expences}" class="add-button"><span>View expenses</span></a> 
			<br /><br /><br />
		{/if}
		{if 'clinicaltests' eq $selected_tab}
			{if true eq 'ADD_TEST'|array_key_exists:$user_permissions}
				<a href="{$exit_tags.add_test}" class="add-button"><span>Add clinic test</span></a> 
				<br /><br /><br />
			{/if}
		{/if}
		{if true eq 'ADD_PATIENT'|array_key_exists:$user_permissions}
			<a href="{$exit_tags.add_patient}{if 'home' eq $selected_tab}&return=home{/if}" class="add-button"><span>Add new patient</span></a>		 
			<br /><br /><br />
			<a href="{$exit_tags.add_patient}&type=op{if 'home' eq $selected_tab}&return=home{/if}" class="add-button"><span>Add OP patient</span></a>		 
			<br /><br /><br />
		{/if}
		{if true eq 'ADD_DOCTOR'|array_key_exists:$user_permissions}
			<a href="{$exit_tags.add_doctor}" class="add-button"><span>Add new doctor&nbsp;</span></a>
			<div class="cl">&nbsp;</div>
			<br /><br />
		{/if}
		{if 'reminders' eq $selected_tab}
			<a href="{$exit_tags.add_reminder}" class="add-button"><span>Add new Reminder</span></a>
			<div class="cl">&nbsp;</div>
			<br /><br />
		{/if}
		{if true eq 'ADD_TEST'|array_key_exists:$user_permissions}
			<a href="{$exit_tags.add_test}&test_type[id]=1" class="add-button"><span>Add new Path.Test</span></a>
			<div class="cl">&nbsp;</div>
			<br /><br />		
			<a href="{$exit_tags.add_test}&test_type[id]=2" class="add-button"><span>Add new Sono test</span></a>
			<div class="cl">&nbsp;</div>
			<br /><br />
			<a href="{$exit_tags.add_test}&test_type[id]=3" class="add-button"><span>Add new X-ray test</span></a>
			<div class="cl">&nbsp;</div>
		{/if}
		{if 'backup' eq $selected_tab}
			<br /><br />
			<a href="{$exit_tags.create_databackup}" class="add-button"><span>Add new Databackup</span></a>
			<div class="cl">&nbsp;</div>
			<br /><br />
			<a href="{$exit_tags.upload_databackup}" class="add-button"><span>Upload Databackup</span></a>
			<div class="cl">&nbsp;</div>
			<br /><br />
		{/if}	
	</div>
</div>
                