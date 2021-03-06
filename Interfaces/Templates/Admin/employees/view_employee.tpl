<form name="frmDoctor" id="frmDoctor" action="{$exit_tags.update_employee}" method="post">
	<!-- Form -->
	<!-- Form Buttons -->
	<div class="buttons">
		<input type="submit" class="button" value="Save" />
		<input type="button" class="button" value="Cancel" />			
	</div>
	<!-- End Form Buttons -->
	<div>
		<div class="form" style="width: 45%;float: left;">			
			<p>					
				<label> Add Patients</label>
				{assign var="ADD_PATIENT" value="ADD_PATIENT"}
				<select name="user_permissions[ADD_PATIENT]"  style="width: 80px;" class="field size2">
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'ADD_PATIENT', $user_permissions) and 0 eq $user_permissions.$ADD_PATIENT->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and false eq array_key_exists( 'ADD_PATIENT', $user_permissions )} selected {/if}>Deny</option>
				</select> 
			</p>
			<p>					
				<label>Add Doctor</label>
				{assign var="ADD_DOCTOR" value="ADD_DOCTOR"}
				<select name="user_permissions[ADD_DOCTOR]"  style="width: 80px;" class="field size2">
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'ADD_DOCTOR', $user_permissions) and 0 eq $user_permissions.$ADD_DOCTOR->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and false eq array_key_exists( 'ADD_DOCTOR', $user_permissions )} selected {/if}>Deny</option>
				</select>
			</p>
			<p>					
				<label>Add Clinical Tests</label>
				{assign var="ADD_TEST" value="ADD_TEST"}
				<select name="user_permissions[ADD_TEST]"  style="width: 80px;" class="field size2">
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'ADD_TEST', $user_permissions ) and 1 eq $user_permissions.$ADD_TEST->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and false eq array_key_exists( 'ADD_TEST', $user_permissions )} selected {/if}>Deny</option>
				</select>
			</p>
			<p>
				<label>Generate CUT Report</label>
				{assign var="CUT_REPORT" value="CUT_REPORT"}
				<select name="user_permissions[CUT_REPORT]"  style="width: 80px;" class="field size2">
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'CUT_REPORT', $user_permissions ) and 1 eq $user_permissions.$CUT_REPORT->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and false eq array_key_exists( 'CUT_REPORT', $user_permissions )} selected {/if}>Deny</option>
				</select> 
			</p>
			<p>					
				<label>Data Backup</label>
				{assign var="DATA_BACKUP" value="DATA_BACKUP"}
				<select name="user_permissions[DATA_BACKUP]"  style="width: 80px;" class="field size2">
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'DATA_BACKUP', $user_permissions ) and 1 eq $user_permissions.$DATA_BACKUP->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and false eq array_key_exists( 'DATA_BACKUP', $user_permissions )} selected {/if}>Deny</option>
				</select> 
			</p>
			<p>					
				<label>Employees</label>
				{assign var="EMPLOYEES" value="EMPLOYEES"}
				<select name="user_permissions[EMPLOYEES]"  style="width: 80px;" class="field size2">
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'EMPLOYEES', $user_permissions ) and 1 eq $user_permissions.$EMPLOYEES->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and false eq array_key_exists( 'EMPLOYEES', $user_permissions )} selected {/if}>Deny</option>
				</select> 
			</p>			
			<p>					
				<label>Business Analysis</label>
				{assign var="BUSINESS_ANALYSIS" value="BUSINESS_ANALYSIS"}
				<select name="user_permissions[BUSINESS_ANALYSIS]"  style="width: 80px;" class="field size2">
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'BUSINESS_ANALYSIS', $user_permissions ) and 1 eq $user_permissions.$BUSINESS_ANALYSIS->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and false eq array_key_exists( 'BUSINESS_ANALYSIS', $user_permissions )} selected {/if}>Deny</option>
				</select> 
			</p>
			<p>					
				<label>Expences</label>
				{assign var="EXPENCES" value="EXPENCES"}
				<select name="user_permissions[EXPENCES]"  style="width: 80px;" class="field size2">
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'EXPENCES', $user_permissions ) and 1 eq $user_permissions.$EXPENCES->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and false eq array_key_exists( 'EXPENCES', $user_permissions )} selected {/if}>Deny</option>
				</select> 
			</p>
			<p>					
				<label>Patient Collections</label>
				{assign var="COLLECTIONS" value="COLLECTIONS"}
				<select name="user_permissions[COLLECTIONS]"  style="width: 80px;" class="field size2">
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'COLLECTIONS', $user_permissions ) and 1 eq $user_permissions.$COLLECTIONS->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and true eq array_key_exists( 'COLLECTIONS', $user_permissions )} selected {/if}>Deny</option>
				</select> 
			</p>
			<p>					
				<label>Reminders</label>
				{assign var="REMINDERS" value="REMINDERS"}
				<select name="user_permissions[REMINDERS]"  style="width: 80px;" class="field size2">							
					<option value="1" {if true eq is_array($user_permissions) and true eq array_key_exists( 'REMINDERS', $user_permissions ) and 1 eq $user_permissions.$REMINDERS->getValue()} selected {/if}>Allow</option>
					<option value="0" {if true eq is_array($user_permissions) and false eq array_key_exists( 'REMINDERS', $user_permissions )} selected {/if}>Deny</option>
				</select> 
			</p>
		</div>
		<div>
			<div class="box" style="width: 50%;float: right;">
				<div class="box-head">
					<h2 id="sono">Employee Details</h2>
					<input type="hidden" name="users[id]" value="{$selected_user->getId()}">
				</div>
				<div class="form">
					<p>					
						<label>First Name</label>
						<input type="text" name="users[first_name]" value="{$selected_user->getFirstName()}" class="field size2" style="width: 272px;"/>
					</p>
					<p>					
						<label>Last Name</label>
						<input type="text" name="users[last_name]" value="{$selected_user->getLastName()}" class="field size2" style="width: 272px;"/>
					</p>
					<p>					
						<label>Username</label>
						<input type="text" name="users[username]" value="{$selected_user->getUsername()}" class="field size2" style="width: 272px;"/>
					</p>
					<p>					
						<label>Password</label>
						<input type="text" name="users[password]" value="{$selected_user->getPassword()}" class="field size2" style="width: 272px;"/>
					</p>
					<p>					
						<label>Gender</label>
						<select>
							<option value="1" {if '1' eq $selected_user->getGender()}selected{/if}>Male</option>
							<option value="0" {if '0' eq $selected_user->getGender()}selected{/if}>Female</option>
						</select>
					</p>
					<p>					
						<label>Address</label>
						<input type="text" name="users[address]" value="{$selected_user->getAddress()}" class="field size2" style="width: 272px;"/>
					</p>
					<p>					
						<label>Phone Number</label>
						<input type="text" name="users[phone_number]" value="{$selected_user->getPhonenumber()}" class="field size2" style="width: 272px;"/>
					</p>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	<!-- End Form -->
	<div style="clear: both;"></div>
	<!-- Form Buttons -->
	<div class="buttons">
		<input type="submit" class="button" value="Save" />
		<input type="button" class="button" value="Cancel" />			
	</div>
	<!-- End Form Buttons -->
</form>