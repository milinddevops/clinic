{literal}
<<script type="text/javascript">
<!--
jQuery(document).ready(function(){
	$( "#datepicker" ).datepicker();

	$( "#datepicker" ).change(function(){
		CalculateWeek();
	});

	$("#untrasonography").val("Normal");
	
	$("#sonography_report").change(function(){
		if('abnormal' == $("#sonography_report").val()) {
			$("#untrasonography").val("");
			$("#abnormal").show('slow');
		}else {
			$("#abnormal").hide('slow');
			$("#untrasonography").val("Normal");
		}
	});
});

function CalculateWeek(){
    // Current Date
    var date1 = new Date();
    
    //Parsing the value from the text control. The actual date is in dd/mm/yyyy format as per your post.
    var arrDateValue = document.getElementById("datepicker").value.split('-'); // Actual Date is in dd/mm/yyyy
    
    // Converting to mm/dd/yyyy date format
    alert(arrDateValue[1] + '--' + arrDateValue[0] + '--' + arrDateValue[2]);
    var Date2 = new Date(arrDateValue[1] + '/' + arrDateValue[2] + '/' + arrDateValue[0]); // mm/dd/yyyy

    // one week calculation
    var perWeek = 24 * 60 * 60 * 1000 * 7;

    // calculating total week. FYI the week starts from Monday to Sunday
    var totalWeeks = Math.round((date1.valueOf()- Date2.valueOf())/ perWeek);

    // alerting the total Weeks
    document.getElementById("lmp_week_count").value = totalWeeks;    
}

//-->
</script>
{/literal}

<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Form F</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="frmPatient" id="frmPatient" action="{$exit_tags.update_formf}" method="post">
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<input type="button" class="button" value="Upload to PCPNDT" />
			<input type="button" class="button" id="cancel" value="Cancel" />			
		</div>
		<!-- End Form Buttons -->
		<input type="hidden" name="return" value="{$return}">		
		<input type="hidden" name="is_save_payment" id="is_save_payment" value="0">
		<input type="hidden" name="page" value="{$page}">
		
		<!-- Form -->
		<div class="form" style="width: 88%;float: left; border: 1px solid red;">
			<p>
				<label>1. Name and address of Genetic Clinic</label>
				<b>SHREE DIAGNOSTIC CLINIC</b><br>Full Address come here..
			</p>
			<p>
				<label>2. Registration number: 1234567</label>				
			</p>
			<p>
				<label>3. Title</label>
				<select class="field size1" id="title" name="patients[title]" style="width: 80px;">
					<option value="">Select Title</option>					
					<option value="Mr." {if 'Mr.' eq $patient->getTitle()}selected{/if}>Mr.</option>
					<option value="Master." {if 'Master.' eq $patient->getTitle()}selected{/if}>Master.</option>
					<option value="Mrs." {if 'Mrs.' eq $patient->getTitle()}selected{/if}>Mrs.</option>
					<option value="Miss." {if 'Miss.' eq $patient->getTitle()}selected{/if}>Miss.</option>										
				</select>
			</p>
			<p>
				<label>Patient Name</label>				
				<input type="text" id="first_name" name="patients[first_name]" value="{$patient->getFirstName()}" class="field size2" style="width: 272px;"/>
			</p>
			<p>					
				<label> 4. Number of children</label>
				Male:<input type="text" id="phone" name="patients[child_male_count]" value="{$patient->getChildMaleCount()}" class="field size2" style="width: 72px;"/>
				Female:<input type="text" id="phone" name="patients[child_female_count]" value="{$patient->getChildFemaleCount()}" class="field size2" style="width: 72px;"/>
			</p>
			<p>					
				<label>5. Husband's/father name</label>
				<input type="text" name="patient[husband_name]" value="{$patient->getHusbandName()}" class="field size2" style="width: 272px;"/>				
			</p>
			<p>					
				<label>6. Full Address</label>
				<input type="text" id="phone" name="patients[address]" value="" class="field size2" style="width: 272px;"/>				
			</p>
			<p>					
				<label>Mobile Number</label>
				<input type="text" id="phone" name="patients[phone]" value="{$patient->getPhone()}" class="field size2" style="width: 272px;"/>				
			</p>
			<p class="inline-field">
				<label>7. Refering Doctor</label>
				{$doctor->getFirstName()} {$doctor->getLastName()}<br> {$doctor->getAddress()}
			</p>
			<p class="inline-field">
				<label>8. Last menstrual period / weeks of pregnancy</label>
				LMP Date<input id="datepicker" type="text" name="patients[lmp_date]" class="field size2" style="width: 82px;" value="" readonly>
				LMP Weeks<input id="lmp_week_count" type="text" name="patients[lmp_week_count]" value="" class="field size2" style="width: 82px;"/>
			</p>
			<p align="left" class="inline-field">
				<label>9. History of genetic/medical disease in the familly</label>
				<input type="checkbox" name="patients[familly_genetic_history]" value="Not Applicable" checked="checked" class="field size2"/>Not Applicable <br>
				<input type="checkbox" name="patients[familly_genetic_history]" value="Clinical" class="field size2"/>Clinical <br>
				<input type="checkbox" name="patients[familly_genetic_history]" value="Bio-Chemical" class="field size2"/>Bio-Chemical <br>
				<input type="checkbox" name="patients[familly_genetic_history]" value="Cyto-genetic" class="field size2"/>Cyto-genetic <br>
				<input type="checkbox" name="patients[familly_genetic_history]" value="Other" class="field size2"/>Other <br>
			</p>
			<p class="inline-field">
				<label>10. Indication for prenatal diagnosis</label>
			</p>
			<p class="inline-field">
				<label>A. Previous child/children with:</label>
				<input type="checkbox" name="patients[prenatal_diagnosis_a]" value="Other" class="field size2" checked="checked"/>Not Applicable <br>
				<input type="checkbox" name="patients[prenatal_diagnosis_a]" value="Other" class="field size2"/>Chromosomal disorders <br>
				<input type="checkbox" name="patients[prenatal_diagnosis_a]" value="Other" class="field size2"/>Metabolic disorders<br>
				<input type="checkbox" name="patients[prenatal_diagnosis_a]" value="Other" class="field size2"/>Cognitial anomaly <br>
				<input type="checkbox" name="patients[prenatal_diagnosis_a]" value="Other" class="field size2"/>Mental retardation <br>
				<input type="checkbox" name="patients[prenatal_diagnosis_a]" value="Other" class="field size2"/>Haemoglobinopathy <br>
				<input type="checkbox" name="patients[prenatal_diagnosis_a]" value="Other" class="field size2"/>Sex linked disorder <br>
				<input type="checkbox" name="patients[prenatal_diagnosis_a]" value="Other" class="field size2"/>Single gene disorders <br>
				<input type="checkbox" name="patients[prenatal_diagnosis_a]" value="Other" class="field size2"/>Any other(specify) <br>
			</p>
			<p class="inline-field">
				<label>B. Advanced maternal age ( 35 years )</label>				
				<input type="text" name="patients[advanced_age]" value="" class="field size2" style="width: 72px;"/>
			</p>
			<p class="inline-field">				
				<label>C. Mother/Father/Siblings has genetic disease (specify)</label>
				<input type="text" id="phone" name="patients[parent_genetic_disease]" value="None" class="field size2" style="width: 272px;"/>
			</p>
			<p class="inline-field">
				<label>D. Other (specify)</label>				
				<input type="text" name="patients[parent_genetic_disease_other]" value="" class="field size2" style="width: 272px;"/>
			</p>
			<p class="inline-field">
				<label>11. Procedures carried out who performed it.<br>Ranjeet D. Ghatge rest details will come</label>
			</p>			
			<p class="inline-field">
				<label>Non invasive</label>
				<input type="text" name="patients[non_invasive]" value="" class="field size2" style="width: 272px;"/>
			</p>
			<p class="inline-field">
				<label>Invasive</label>
				<select class="field size1" id="title" name="patients[invasive]" style="width: 180px;">
					<option value="Not Applicable">Not Applicable</option>										
					<option value="Amniocentesis">Amniocentesis</option>
					<option value="Chorionic Villi aspiration">Chorionic Villi aspiration</option>
					<option value="Foetal biopsy">Foetal biopsy</option>
					<option value="Cordocentesis">Cordocentesis</option>
				</select>
			</p>
			<p class="inline-field">
				<label>12. Any complication of procedure - please specify</label>
				<input type="text" name="patients[complication_of_procedure]" value="No" class="field size2" style="width: 72px;"/>
			</p>
			<p class="inline-field">
				<label>13. Laboratory tests recomended</label>
				<input type="checkbox" name="patients[laboratory_tests]" value="Not Applicable" class="field size2" checked="checked" />Not Applicable <br>
				<input type="checkbox" name="patients[laboratory_tests]" value="Chromosmal studies" class="field size2" />Chromosmal studies<br>
				<input type="checkbox" name="patients[laboratory_tests]" value="Biochemical studies" class="field size2" />Biochemical studies<br>
				<input type="checkbox" name="patients[laboratory_tests]" value="Molecular studies" class="field size2" />Molecular studies<br>
				<input type="checkbox" name="patients[laboratory_tests]" value="Preimplantaion genetic diagnosis" class="field size2" />Preimplantaion genetic diagnosis<br>
			</p>
			<p class="inline-field">
				<label>14. Result of</label>
			</p>
			<p class="inline-field">
				<label>A. Pre-natal diagnostic procedure </label>
				<input type="text" name="patients[result_prenatal]" value="" class="field size2" style="width: 272px;"/>
			</p>
			<p class="inline-field">
				<label>B. Untrasonography</label>
				<select id="sonography_report" class="field size1" id="title" name="patients[untrasonography]" style="width: 80px;">
					<option value="normal">Normal</option>										
					<option value="abnormal">Abnormal</option>					
				</select>
			</p>
			<p id="abnormal" class="inline-field" style="display: none;">
				<input id="untrasonography" type="text" name="patients[untrasonography]" value="" class="field size2" style="width: 272px;"/>
			</p>
			<p class="inline-field">
				<label>15. Dates on which procedure carried out</label>
				CURRENT-DATE
			</p>
			<p class="inline-field">
				<label>16. date on which procedure carries out</label>
				<input type="text" name="patients[carried_out_date_invasive]" value="Not Applicable" class="field size2" style="width: 72px;"/>
			</p>
			<p class="inline-field">
				<label>17. Result of pre-natal diagnostic preocedure were conveyed to {$patient->getFirstName()} {$patient->getLastName()} on {$patient->getReceivedDate()}</label>
			</p>
			<p class="inline-field">
				<label>18. Was MTP advised/conducted?</label>
				<input type="text" name="patients[was_mtp_advised]" value="No" class="field size2" style="width: 72px;"/>
			</p>
			<p class="inline-field">
				<label>Date on which MTP carried out </label>
				<input type="text" id="phone" name="patients[mtp_carried_out]" value="Not applicable" class="field size2" style="width: 100px;"/>
			</p>
			<div>
			</div>
		</div>
		<!-- End Form -->		
		<div style="clear: both;"></div>
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<input type="button" class="button" value="Upload to PCPNDT" />			
			<input type="button" class="button" id="cancel" value="Cancel" />			
		</div>
		<!-- End Form Buttons -->
	</form>
</div>