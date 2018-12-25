<div id="navigation">
	<ul>
		<li><a href="{$exit_tags.dashboard}" class="{if 'dashboard' eq $selected_tab}active{else}{/if}"><span>Dashboard</span></a></li>
	    <li><a href="{$exit_tags.home}" class="{if 'home' eq $selected_tab}active{else}{/if}"><span>Today's Patients</span></a></li>
	    <li><a href="{$exit_tags.view_patients}" class="{if 'patients' eq $selected_tab}active{else}{/if}"><span>Patients</span></a></li>
	    <li><a href="{$exit_tags.view_doctors}" class="{if 'doctors' eq $selected_tab}active{else}{/if}"><span>Doctors</span></a></li>
	    
	    {if true eq $user_permissions|is_array and true eq 'CUT_REPORT'|array_key_exists:$user_permissions}
	    	<li><a href="{$exit_tags.view_clinical_tests}" class="{if 'clinicaltests' eq $selected_tab}active{else}{/if}"><span>Clinical Tests</span></a></li>
	    {/if}
	    {if true eq $user_permissions|is_array and true eq 'CUT_REPORT'|array_key_exists:$user_permissions}
	    	<li><a href="{$exit_tags.create_report}" class="{if 'reports' eq $selected_tab}active{else}{/if}"><span>Reports</span></a></li>
	    {/if}
	    {if true eq $user_permissions|is_array and true eq 'DATA_BACKUP'|array_key_exists:$user_permissions}
	    	<li><a href="{$exit_tags.databackup}" class="{if 'backup' eq $selected_tab}active{else}{/if}"><span>Data Backup</span></a></li>
	    {/if}
	    {if true eq $user_permissions|is_array and true eq 'EMPLOYEES'|array_key_exists:$user_permissions}
	    	<li><a href="{$exit_tags.view_employees}" class="{if 'employees' eq $selected_tab}active{else}{/if}"><span>Emplyees</span></a></li>
	    {/if}
	    {if true eq $user_permissions|is_array and true eq 'BUSINESS_ANALYSIS'|array_key_exists:$user_permissions}
	    	<li><a href="{$exit_tags.clinic_statistics}" class="{if 'ba' eq $selected_tab}active{else}{/if}"><span>Business Analysis</span></a></li>
	    {/if}
	    {if true eq $user_permissions|is_array and true eq 'EXPENCES'|array_key_exists:$user_permissions}
	    	<li><a href="{$exit_tags.view_current_date_expences}" class="{if 'expences' eq $selected_tab}active{else}{/if}"><span>Expenses</span></a></li>
	    {/if}
	    
	    {if true eq $user_permissions|is_array and true eq 'REMINDERS'|array_key_exists:$user_permissions}
	    	<li><a href="{$exit_tags.view_reminders}" class="{if 'reminders' eq $selected_tab}active{else}{/if}"><span>Reminders</span></a></li>
	    {/if}
	</ul>
</div>

<!-- <ul id="top-navigation">
	<li><a href="#" class="active">Dashboard</a></li>
	<li><a href="#" >Patients</a></li>
	<li><a href="#">Doctors</a></li>
	<li><a href="#">Reports</a></li>
	<li><a href="#">Data BackUp</a></li>
	<li><a href="#">Employees</a></li>
	<li><a href="#">Business Analysis</a></li>
</ul>-->