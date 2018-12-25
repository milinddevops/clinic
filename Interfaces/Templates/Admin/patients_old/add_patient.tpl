{literal}
<script type="text/javascript" src="javascript/jquery.autocomplete.js"></script>
<script type="text/javascript">
<!--
function remove( id, type ) {
	
	var div = document.getElementById( 'selection' );
	var child = document.getElementById( 'd_'+id );
	div.removeChild( child );

	jQuery.ajax({
  	  url: '{/literal}{$exit_tags.remove_test}{literal}&amt=' + jQuery('#bill_amt').val() + '&test[id]='+ id + '&type[id]='+type,
  	  success: function(data) {
  	    jQuery('#bill_amt').val(data);
  	  }
    });


	jQuery.ajax({
	  	  url: '{/literal}{$exit_tags.remove_lab_amt}{literal}&amt=' + jQuery('#lab_amt').val() + '&test[id]='+ id + '&type[id]='+type,
	  	  success: function(data) {
	  	    jQuery('#lab_amt').val(data);
	  	  }
	    });

	jQuery.ajax({
	  	  url: '{/literal}{$exit_tags.remove_ref_amt}{literal}&amt=' + jQuery('#ref_amt').val() + '&test[id]='+ id + '&type[id]='+type,
	  	  success: function(data) {
	  	    jQuery('#ref_amt').val(data);
	  	  }
	    });
}

jQuery(document).ready(function() {
	/*jQuery('#patho').click(function() {
		if('block' == jQuery('#patho_details').css('display')){
			jQuery('#patho_details').hide('slow');
			
		} else {
			jQuery('#patho_details').show('slow');
		}				
	});*/

	jQuery('#sono').click(function() {
		if('block' == jQuery('#sono_details').css('display')){
			jQuery('#sono_details').hide('slow');
			
		} else {
			jQuery('#sono_details').show('slow');
		}		
	});

	jQuery('#xray').click(function() {
		if('block' == jQuery('#xray_details').css('display')){
			jQuery('#xray_details').hide('slow');
			
		} else {
			jQuery('#xray_details').show('slow');
		}		
	});

	
	var options, a;
	jQuery(function(){
		
	  var onAutocompleteSelect = function(value, data) {
		  
	      jQuery('#selection').append('<div id=d_'+data+'> <input type="hidden" name="path_tests[]" value="'+data+'">'+value+' <a href="#" onclick="remove('+data+');">X</a></div> ');
	      jQuery('#query').val('');

	      jQuery.ajax({
	    	  url: '{/literal}{$exit_tags.get_test}{literal}&amt=' + jQuery('#bill_amt').val() + '&test[id]='+data,
	    	  success: function(data) {
	    	    jQuery('#bill_amt').val(data);
	    	  }
	      });

	      jQuery.ajax({
	    	  url: '{/literal}{$exit_tags.get_lab_amt}{literal}&amt=' + jQuery('#lab_amt').val() + '&test[id]='+data,
	    	  success: function(data) {
	    	    jQuery('#lab_amt').val(data);
	    	  }
	      });

	      jQuery.ajax({
	    	  url: '{/literal}{$exit_tags.get_ref_amt}{literal}&amt=' + jQuery('#ref_amt').val() + '&test[id]='+data,
	    	  success: function(data) {
	    	    jQuery('#ref_amt').val(data);
	    	  }
	      });
	  }

	  options = { serviceUrl:'{/literal}{$exit_tags.get_tests}{literal}',
			      width:300,
			      onSelect:onAutocompleteSelect };
	  a = jQuery('#query').autocomplete(options);
	});
		
	/*jQuery('#sono_test').change(function(){
		var test_id = jQuery('#sono_test').val();

		if( '' != test_id ) {
			jQuery.ajax({
		    	  url: '{/literal}{$exit_tags.get_test}{literal}&amt=' + jQuery('#bill_amt').val() + '&test[id]='+test_id + '&type[id]=2',
		    	  success: function(data) {
		    	    jQuery('#bill_amt').val(data);
		    	  }
		      });
			jQuery('#sono_selection').append('<div id=d_'+data+'> <input type="hidden" name="path_tests[]" value="'+data+'">'+value+' <a href="#" onclick="remove('+data+');">X</a></div> ');
		}
	});

	jQuery('#xray_test').change(function(){
		var test_id = jQuery('#xray_test').val();
		
		if( '' != test_id ) {
			jQuery.ajax({
		    	  url: '{/literal}{$exit_tags.get_test}{literal}&amt=' + jQuery('#bill_amt').val() + '&test[id]='+test_id + '&type[id]=3',
		    	  success: function(data) {
		    	    jQuery('#bill_amt').val(data);
		    	  }
		    });

			jQuery('#xray_selection').append('<div id=d_'+data+'> <input type="hidden" name="path_tests[]" value="'+data+'">'+value+' <a href="#" onclick="remove('+data+');">X</a></div> ');
		}
	});*/

	$( "#datepicker" ).datepicker();

	jQuery('#cancel').click(function (){
		window.location.href = '{/literal}{if false eq is_null($return)}?module={$return}{else}?module=patients&action=view_patients{/if}{literal}';
	});

	jQuery('#title').change(function(){
		var strTitle = jQuery('#title').val();
		if( 'Mr.' == strTitle || 'Master.' == strTitle ) {
			jQuery('#sex').val(1);
			
		} else if( 'Miss.' == strTitle || 'Mrs.' == strTitle ) {
			jQuery('#sex').val(0);
		}
	});
	
});

this.remove = remove;
//-->
</script>
{/literal}

<link rel="stylesheet" type="text/css" href="css/auto_styles.css">
<link rel="stylesheet" type="text/css" href="css/calendar.css">

{if true eq $patient->getErrorMsg()|is_array}
	{foreach from=$patient->getErrorMsg() item="error"}
		<div class="msg msg-error">
			<p><strong>{$error}</strong></p>
		</div>
	{/foreach}
{/if}
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Add New Patient</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="frmPatient" id="frmPatient" action="{if false eq is_null($url)}/?module=patients&action={$url}&patients[id]={$patient->getId()}{else}{$exit_tags.insert_patient}{/if}" method="post">
		
		<input type="hidden" name="return" value="{$return}">		
		<!-- Form -->
		<div class="form" style="width: 45%;float: left;">
			<p>					
				<label>Title</label>
				<select class="field size1" id="title" name="patients[title]" style="width: 80px;">
					<option value="">Select Title</option>					
					<option value="Mr." {if 'Mr.' eq $patient->getTitle()}selected{/if}>Mr.</option>
					<option value="Master." {if 'Master.' eq $patient->getTitle()}selected{/if}>Master.</option>
					<option value="Mrs." {if 'Mrs.' eq $patient->getTitle()}selected{/if}>Mrs.</option>
					<option value="Miss." {if 'Miss.' eq $patient->getTitle()}selected{/if}>Miss.</option>										
				</select>
			</p>			
			<p>					
				<label>First Name</label>
				<input type="text" id="first_name" name="patients[first_name]" value="{$patient->getFirstName()}" class="field size2" style="width: 272px;"/>
			</p>
			<p>					
				<label>Last Name</label>
				<input type="text" id="last_name" name="patients[last_name]" value="{$patient->getLastName()}" class="field size2" style="width: 272px;"/>
			</p>
			<p>					
				<label>Phone</label>
				<input type="text" id="phone" name="patients[phone]" value="{$patient->getPhone()}" class="field size2" style="width: 272px;"/>
			</p>
			<p class="inline-field">
				<label>Refering Doctor</label>
				<select class="field size1" name="patients[doctor_id]" style="width: 280px;">
					<option value="">Select Doctor</option>																
					{foreach from="$doctors" item="doctor"}
						<option value="{$doctor->getId()}" {if $patient->getDoctorId() eq $doctor->getId()}selected{/if}> {$doctor->getLastName()} {$doctor->getFirstName()}</option>									
					{/foreach}
				</select>
			</p>
			<p class="inline-field">
				<label>Patient Type</label>
				<select class="field size1" name="patients[patient_type_id]" style="width: 280px;">																			
					<option value="1" {if $patient->getPatientTypeId() eq 1}selected{/if}> IPD</option>
					<option value="2" {if $patient->getPatientTypeId() eq 2}selected{/if}> OPD</option>									
				</select>
			</p>
			<p>					
				<label>Age</label>
				<input type="text" name="patients[age]" value="{$patient->getAge()}" class="field size2"/>
			</p>
			<p class="inline-field">
				<label>Sex</label>				
				<select id="sex" name="patients[gender]" class="field size1" style="width: 180px;">
					<option value="1" {if $patient->getGender() eq 1}selected{/if}>Male</option>
					<option value="0"{if $patient->getGender() eq 0}selected{/if}>Female</option>
				</select>
			</p>
			<p class="inline-field">
				<label>Date</label>
				<input id="datepicker" type="text" name="patients[recieved_on]" class="field size2" style="width: 272px;" value="{$patient->getReceivedDate()}" readonly>
				<!--<input type="text" id="recieved_on" name="patients[recieved_on]" class="field size2" style="width: 272px;" value="{$patient->getReceivedDate()}" readonly onChange="changeDate(this.value);"> -->							
			</p>
			<div>
				<p class="inline-field">					
					<label>Bill Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Received Amount</label>
					<input type="text" id="bill_amt" name="patients[total_bill_amt]" value="{$patient->getTotalBillAmt()}" class="field size2"/>&nbsp;&nbsp;&nbsp;
					<input type="text" name="patients[received_amt]" value="{$patient->getReceivedAmt()}" class="field size2"/>
				</p>
				<p class="inline-field">					
					<label>Clinic Charges&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ref. Fee</label>				
					<input type="text" id="lab_amt" name="patients[ipd_amt]" value="{$patient->getIpdAmt()}" class="field size2">&nbsp;&nbsp;&nbsp;
					<input type="text" id="ref_amt" name="patients[opd_amt]" value="{$patient->getOpdAmt()}" class="field size2"/>
					
				</p>
			</div>
		</div>
		<!-- End Form -->
		<div style="width: 50%;float: right;">
			<div class="box">
				<div class="box-head">
					<h2 id="patho">Pathology / Sonography / X-Ray</h2>
				</div>
				<div class="form" id="patho_details">					
					<div style="float: left;" id="selection">
						{foreach from="$pathology_tests" item="pathology_test"}
							{if true eq $customer_pathology_tests|is_array and true eq $pathology_test->getId()|array_key_exists:$customer_pathology_tests}
								<div id=d_{$pathology_test->getId()}> <input type="hidden" name="path_tests[]" value="{$pathology_test->getId()}"> {$pathology_test->getName()}&nbsp;<a href="#" onclick="remove('{$pathology_test->getId()}', 1);">X</a></div>		
							{/if}
						{/foreach}
						{foreach from="$sonography_tests" item="sonography_test"}
							{if true eq $customer_pathology_tests|is_array and true eq $sonography_test->getId()|array_key_exists:$customer_pathology_tests}
								<div id=d_{$sonography_test->getId()}> <input type="hidden" name="path_tests[]" value="{$sonography_test->getId()}"> {$sonography_test->getName()}&nbsp;<a href="#" onclick="remove('{$sonography_test->getId()}', 2);">X</a></div>		
							{/if}
						{/foreach}
						{foreach from="$xray_tests" item="xray_test"}
							{if true eq $xray_tests|is_array and true eq $xray_test->getId()|array_key_exists:$xray_tests}
								<div id=d_{$xray_test->getId()}> <input type="hidden" name="path_tests[]" value="{$xray_test->getId()}"> {$xray_test->getName()}&nbsp;<a href="#" onclick="remove('{$xray_test->getId()}', 3);">X</a></div>		
							{/if}
						{/foreach}
					</div>
					<div style="float: right;"><input size="15" type="text" name="q" id="query" /></div>
					<div style="clear: both;"></div>
				</div>
			</div>
			 <div class="box">
				<div class="box-head">
					<h2 id="sono">Comment</h2>
				</div>
				<div class="form">					
					<p>
						<span class="req"></span>
						<label>Patient Comment</label>
						<textarea cols="45" rows="10" class="field size4" name="patients[comment]">{$patient->getComment()}</textarea>
					</p>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<input type="button" class="button" id="cancel" value="Cancel" />			
		</div>
		<!-- End Form Buttons -->
	</form>
</div>



{*literal}
<style>
<!--
.ico_mug {
    background: url("../images/patients.png") no-repeat scroll 5px center #F1F1F1;
    margin-bottom: 20px;
    padding-left: 40px;
    height: 105px;
}

.autocomplete-w1 { background:url(../img/shadow.png) no-repeat bottom right; position:absolute; top:0px; left:0px; margin:6px 0 0 6px; /* IE6 fix: */ _background:none; _margin:1px 0 0 0; }
.autocomplete { border:1px solid #999; background:#FFF; cursor:default; text-align:left; max-height:350px; overflow:auto; margin:-6px 6px 6px -6px; /* IE6 specific: */ _height:350px;  _margin:0; _overflow-x:hidden; }
.autocomplete .selected { background:#F0F0F0; }
.autocomplete div { padding:2px 5px; white-space:nowrap; overflow:hidden; }
.autocomplete strong { font-weight:normal; color:#3399FF; }

-->
</style>
<!-- JS files for auto complete -->
<script type="text/javascript" src="javascript/jquery.js"></script>
<script type="text/javascript" src="javascript/jquery.autocomplete.js"></script>

<<script type="text/javascript">
<!--
function changeGender(option){
	var gender = document.getElementById("gender");
	if(option == "Mrs." || option == "Miss." || option == "Smt." || option == "Dr Mrs."){
		gender[1].selected = true;
	} else {
		gender[0].selected = true;
	}
}

function changeDate(date) {
	if( '' != date ) {
		document.getElementById('due_on').value = date;
	}
}

var options, a;
jQuery(function(){
  options = { serviceUrl:'service/autocomplete.ashx' };
  a = $('#query').autocomplete(options);
});


//-->
</script>
{/literal}
<link rel="stylesheet" type="text/css" href="css/calendar.css">

<script src="javascript/calendar_us.js" type="text/javascript"></script>

<div id="tabledata" class="section">
	<h2 class="ico_mug">
		<dfn style="float: left;margin-left: 50px;"><a href="#">
		{if false eq is_null($patient->getId())}
			Edit
		{else}
			Add New
		{/if}
		Patient
		</a></dfn>
	</h2>
	<form name="frmPatient" id="frmPatient" action="{if false eq is_null( $patient->getId() )}{$exit_tags.update_patient}{else}{$exit_tags.insert_patient}{/if}" method="post" accept-charset="utf-8">
			<input type="hidden" name="patients[id]" value="{$patient->getId()}">
			<fieldset>
				<legend><span>Enter patient details and pathological tests</span></legend>
				<table border="0">
					<tr>
						<td></td>
						<td>
							<input type="text" name="q" id="query" />
							
							<div class="autocomplete-w1">
							  <div style="width:299px;" id="Autocomplete_1240430421731" class="autocomplete">
							    <div><strong>Li</strong>beria</div>
							    <div><strong>Li</strong>byan Arab Jamahiriya</div>
							    <div><strong>Li</strong>echtenstein</div>
							    <div class="selected"><strong>Li</strong>thuania</div>
							  </div>
							</div>														
						</td>
					</tr>
					<tr>
						<td>Title: </td>
						<td>
							<select name="patients[title]" onChange="changeGender(this.value);">
								<option>--</option>
								<option>Mr.</option>
								<option>Mrs.</option>
								<option>Miss.</option>
								<option>Mst.</option>
								<option>B/O</option>
								<option>Baby</option>
								<option>Smt.</option>
								<option>Dr.</option>
								<option>Dr Mrs.</option>
							</select>
						</td>
					</tr>
					<tr>
						<td>Patient First Name: </td>
						<td><input type="text" name="patients[first_name]" value="{$patient->getFirstName()}" /></td>
					</tr>
					<tr>
						<td>Patient Last Name: </td>
						<td><input type="text" name="patients[last_name]" value="{$patient->getLastName()}" /></td>
					</tr>
					<tr>
						<td>Ref Doctor Name: </td>
						<td style="margine-left: 10px;">
							<select name="patients[doctor_id]" class="drop_downs">
								<option value="">Select Doctor</option>																
								{foreach from="$doctors" item="doctor"}
									<option value="{$doctor->getId()}" {if $patient->getDoctorId() eq $doctor->getId()}selected{/if}> {$doctor->getLastName()} {$doctor->getFirstName()}</option>									
								{/foreach}
							</select>
						</td>
					</tr>
					<tr>
						<td>Patient Age:</td>
						<td>
							<input type="text" name="patients[age]" value="{$patient->getAge()}" />							
						</td>
					</tr>
					<tr>
						<td class="lable_text">
							Patient Sex
						</td>
						<td>
							<select id="gender" name="patients[sex]" class="drop_downs">
								<option value="1" {if $patient->getGender() eq 1}selected{/if}>Male</option>
								<option value="0"{if $patient->getGender() eq 0}selected{/if}>Female</option>
							</select>
						</td>
					</tr>
					<tr>
						<td class="lable_text">
							Patient Phone:
						</td>
						<td>
							<input type="text" name="patients[phone]" class="text_box" value="{$patient->getPhone()}">
						</td>
					</tr>
					<tr>
						<td class="lable_text">
							Recived Date
						</td>
						<td>
							<input type="text" id="recieved_on" name="patients[recieved_on]" class="text_box" value="{$patient->getReceivedDate()}" readonly onChange="changeDate(this.value);">							
							{literal}
							<script language="JavaScript">
							new tcal ({
								// form name
								'formname': 'frmPatient',
								// input name
								'controlname': 'recieved_on'
							});		
							</script>
							{/literal}
						</td>
					</tr>
					<tr>
						<td class="lable_text">
							Due Date
						</td>
						<td>
							<input type="text" id="due_on" name="patients[due_on]" class="text_box" value="{$patient->getDueDate()}" readonly>
							{literal}
							<script language="JavaScript">
							new tcal ({
								// form name
								'formname': 'frmPatient',
								// input name
								'controlname': 'due_on'
							});		
							</script>
							{/literal}
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<fieldset><legend><span>Pathological Investigation</span></legend>
							<table cellspacing="0" cellpadding="2" border="0" width="100%">
								{assign var="counter" value=1}
								<tr class="tests">
								{foreach from="$pathology_tests" item="pathology_test"}
									
									<td class="lable_text">
										<div style="float: left;">
											<div style="float: left;">
												{if true eq $customer_pathology_tests|is_array and true eq $pathology_test->getId()|array_key_exists:$customer_pathology_tests}													
													{assign var="checked" value="checked"}
												{else}
													{assign var="checked" value=""}
												{/if}
												<input type="checkbox" name="path_tests[]" value="{$pathology_test->getId()}" {$checked} class="text_box">
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
						</fieldset>	
						</td>
					</tr>
					<tr>
						<td colspan="4">
							<fieldset><legend><span>Payment Information</span></legend>
							<div id="payment_info">
								<table cellspacing="0" cellpadding="2" border="0" width="100%">
									<tr>
										<td>
											Total Bill Amt
										</td>
										<td>
											<input type="text" name="patients[total_bill_amt]" value="{$patient->getTotalBillAmt()}">
										</td>
										<td>
											Received Amt
										</td>
										<td>
											<input type="text" name="patients[received_amt]" value="{$patient->getReceivedAmt()}">
										</td>
									</tr>
									<tr>
										<td colspan="1" align="right">
											Lab Charges
										</td>
										<td colspan="1">
											<input type="text" name="patients[ipd_amt]" value="{$patient->getIpdAmt()}">
										</td>
										<td colspan="1" align="right">
											Ref. Fee
										</td>
										<td colspan="1">
											<input type="text" name="patients[opd_amt]" value="{$patient->getOpdAmt()}">
										</td>
									</tr>
									<tr>
										
									</tr>
								</table>
							</div>
						</fieldset>	
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" value="Save" />
						</td>
					</tr>			  			  
 		</fieldset>
		</form>
</div>
{literal}
<script type="text/javascript">
$(document).ready(function() {
	$(":checkbox").click(function() {
		$.ajax({
			  url: '{/literal}{$exit_tags.update_billing_info}&patient_id={$patient->getId()}{literal}',
			  data:$('form').serialize(),
			  success: function(msg) {
			    $('#payment_info').html(msg);			    
			  }
			});
		});
	
});
</script>
{/literal*}