<div id="tabledata" class="section">
	<h2 class="ico_mug">
		Payment Details
	</h2>
	<form action="{$exit_tags.insert_patient}" method="post" accept-charset="utf-8">
			<fieldset>
				<legend><span>Enter patient details and pathological tests</span></legend>
				<table>
					<tr>
						<td>Patient First Name: </td>
						<td><label><input type="text" name="patients[first_name]" value="" /></label></td>
					</tr>
					<tr>
						<td>Patient Last Name: </td>
						<td><label><input type="text" name="patients[last_name]" value="" /></label></td>
					</tr>
					<tr>
						<td>Ref Doctor Name: </td>
						<td>
							<select name="patients[doctor_id]" class="drop_downs">
								<option value="">Select Doctor</option>
								<option value="0">SELF</option>
								{foreach from="$doctors" item="doctor"}
									<option value="{$doctor->getId()}">{$doctor->getFirstName()} {$doctor->getLastName()}</option>
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td>Patient Age:</td>
						<td><label><input type="text" name="patients[age]" value="" /></label></td>
					</tr>
					<tr>
						<td class="lable_text">
							Patient Sex
						</td>
						<td>
							<select name="patients[sex]" class="drop_downs">
								<option value="1">Male</option>
								<option value="0">Female</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="lable_text">
							Payment Type:
						</td>
						<td>
							<select name="patients[is_ipd]" class="drop_downs">
								<option value="0">IPD</option>
								<option value="1">OPD</option>				
							</select>
						</td>
					</tr>
					<tr>
						<td class="lable_text">
							Patient Phone:
						</td>
						<td>
							<label><input type="text" name="patients[phone]" class="text_box"></label>
						</td>
					</tr>
					<tr>
						<td class="lable_text">
							Recived Date
						</td>
						<td>
							<label><input type="text" name="patients[recieved_on]" class="text_box"></label>
						</td>
					</tr>
					<tr>
						<td class="lable_text">
							Due Date
						</td>
						<td>
							<label><input type="text" name="patients[due_on]" class="text_box"></label>
						</td>
					</tr>
					<tr>
						<td colspan="2" class="sub_header_text">
							Pathological Investigation
						</td>
					<tr>
					<tr>				
						<td colspan="4">
							<div style="height: 100px; overflow: auto;">				
							<table cellspacing="0" cellpadding="2" border="0" width="100%">
								{assign var="counter" value=1}
								<tr class="tests">
								{foreach from="$pathology_tests" item="pathology_test"}				
									<td class="lable_text">
										<div style="float: left;">
											<div style="float: left;">
												<input type="checkbox" name="path_tests[]" value="{$pathology_test->getId()}" class="text_box">
											</div>
											<div style="float: right;">
												{$pathology_test->getName()}
											</div>
											<div style="clear: both;"></div>		
										</div>																
								{if 3 eq $counter}
									{assign var="counter" value=0}
										</td>
									</tr>
								{else}						
									</td>
								{/if}				
								{assign var="counter" value=$counter+1}
								{/foreach}
							</table>
							</div>
						</td>
					</tr>
				</table>	  
					
			  <br /> <input type="submit" value="Continue" />			  
 		</fieldset>
			
		</form>
</div>