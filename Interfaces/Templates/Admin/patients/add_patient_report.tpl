{literal}
	<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
{/literal}
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Patient Report</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="frmPatient" id="frmPatient" action="{$exit_tags.insert_patient_report_template}" method="post">
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<input type="button" class="button" id="cancel" value="Cancel" />			
			<!-- <a href="{$exit_tags.create_formf}&patient[id]={$patient->getId()}">Form F</a> -->
		</div>
		<!-- End Form Buttons -->
		<input type="hidden" name="return" value="{$return}">
		<input type="hidden" name="patient_report_template[patient_id]" value="{$patient->getId()}">
		<input type="hidden" name="page" value="{$page}">
		
		<!-- Form -->
		<!-- End Form -->
		<div style="width: 100%;float: right;">
			<div class="box">
				<div class="form">
					<p>					
						<select class="field size1" id="title" name="patient_report_template[template_id]" style="width: 200px;">
							<option value="">Select Template</option>							
							<option value="1">Basic</option>
						</select>
					</p>
				</div>
			</div>	
			 <div class="box">
				<div class="box-head">
					<h2 id="sono">Report</h2>
				</div>
				<div class="form">					
					<!-- Table -->
					<div>
					<textarea cols="40" id="cut_report_editor" name="patient_report_template[data]" rows=500">
						<div style="height: "500px;"> <!-- class="table" -->						
						<table width="100%" border="0" cellspacing="0" cellpadding="0">
							<tr>
								<td colspan="2" align="left" valign="top" height="200px" width="100%">
									
								</td>																
							</tr>
							<tr>
								<td align="left" width="50%">
									<table>
										<tr><td>Patient Name:</td><td>{$patient->getFirstName()} {$patient->getLastName()}</td></tr>
										<tr><td>Sex:</td><td>{if $patient->getGender() eq 0}Female{else}Male{/if}</td></tr>
										<tr><td>Date:</td><td>{$patient->getReceivedDate()}</td></tr>
									</table>
								</td>								
								<td align="right" width="50%">
									<table>
										<tr><td>Ref By:</td><td>{$doctor->getLastName()} {$doctor->getFirstName()}</td></tr>
										<tr><td>Study:</td><td></td></tr>
										<tr><td>Examined By:</td><td>Ranjeet Ghatge</td></tr>
									</table>
								</td>
							</tr>
							<tr>
								<td colspan="2" align="left" valign="top" height="400px" width="100%">
									
								</td>																
							</tr>
							<tr>
								<td align="left" width="50%">
									
								</td>								
								<td colspan="2" align="right" width="50%">
									<table>
										<tr><td>Ranjeet Ghatge</td></tr>
									</table>
								</td>
							</tr>
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
										['Styles','Format','Font','FontSize', 'Table'],['Bold','Italic','Underline','StrikeThrough','-','Undo','Redo','-','Cut','Copy','Paste','Find','Replace','-','Outdent','Indent','-','Print'],
										['NumberedList','BulletedList','-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
										
									]
								});

						//]]>
						</script>
					{/literal}
					<!-- Table -->
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<!-- <input type="button" class="button" id="formf" value="Form F" /> -->
			<input type="button" class="button" id="cancel" value="Cancel" />			
		</div>
		<!-- End Form Buttons -->
	</form>
</div>



