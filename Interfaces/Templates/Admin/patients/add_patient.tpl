{literal}
<script type="text/javascript" src="javascript/jquery.autocomplete.js"></script>
<script type="text/javascript">

function test(id, type) {
	var div = document.getElementById( 'selection' );
	var child = document.getElementById( 'd_'+id );
	div.removeChild( child );

	jQuery.ajax({
		
  	  url: '{/literal}{$exit_tags.remove_test}{literal}&amt=' + jQuery('#bill_amt').val() + '&test[id]='+ id + '&doctor[id]='+ jQuery('#doctor_id').val() + '&type[id]='+type,
  	  success: function(data) {
  	    jQuery('#bill_amt').val(data);
  	  }
    });


	jQuery.ajax({
	  	  url: '{/literal}{$exit_tags.remove_lab_amt}{literal}&amt=' + jQuery('#lab_amt').val() + '&test[id]='+ id + '&doctor[id]='+ jQuery('#doctor_id').val() + '&type[id]='+type,
	  	  success: function(data) {
	  	    jQuery('#lab_amt').val(data);
	  	  }
	    });

	jQuery.ajax({
	  	  url: '{/literal}{$exit_tags.remove_ref_amt}{literal}&amt=' + jQuery('#ref_amt').val() + '&test[id]='+ id + '&doctor[id]='+ jQuery('#doctor_id').val() + '&type[id]='+type,
	  	  success: function(data) {
	  	    jQuery('#ref_amt').val(data);
	  	  }
	    });
}
function remove( id, type ) {
	
	var div = document.getElementById( 'selection' );
	var child = document.getElementById( 'd_'+id );
	div.removeChild( child );

	jQuery.ajax({
		
  	  url: '{/literal}{$exit_tags.remove_test}{literal}&amt=' + jQuery('#bill_amt').val() + '&test[id]='+ id + '&doctor[id]='+ jQuery('#doctor_id').val() + '&type[id]='+type,
  	  success: function(data) {
  	    jQuery('#bill_amt').val(data);
  	  }
    });


	jQuery.ajax({
	  	  url: '{/literal}{$exit_tags.remove_lab_amt}{literal}&amt=' + jQuery('#lab_amt').val() + '&test[id]='+ id + '&doctor[id]='+ jQuery('#doctor_id').val() + '&type[id]='+type,
	  	  success: function(data) {
	  	    jQuery('#lab_amt').val(data);
	  	  }
	    });

	jQuery.ajax({
	  	  url: '{/literal}{$exit_tags.remove_ref_amt}{literal}&amt=' + jQuery('#ref_amt').val() + '&test[id]='+ id + '&doctor[id]='+ jQuery('#doctor_id').val() + '&type[id]='+type,
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
		  
	      jQuery('#selection').append('<div id=d_'+data+'> <input type="hidden" name="path_tests[]" value="'+data+'">'+value+' <a href="#" onclick="test('+data+');remove('+data+');">X</a></div> ');
	      jQuery('#query').val('');

	      jQuery.ajax({
	    	  url: '{/literal}{$exit_tags.get_test}{literal}&amt=' + jQuery('#bill_amt').val() + '&test[id]='+data,
	    	  success: function(data) {
	    	    jQuery('#bill_amt').val(data);
	    	  }
	      });

	      jQuery.ajax({
	    	  url: '{/literal}{$exit_tags.get_lab_amt}{literal}&amt=' + jQuery('#lab_amt').val() + '&doctor[id]='+ jQuery('#doctor_id').val() + '&test[id]='+data,
	    	  success: function(data) {
	    	    jQuery('#lab_amt').val(data);
	    	  }
	      });

	      jQuery.ajax({
	    	  url: '{/literal}{$exit_tags.get_ref_amt}{literal}&amt=' + jQuery('#ref_amt').val() + '&doctor[id]='+ jQuery('#doctor_id').val() + '&test[id]='+data,
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

	$( "#datepicker" ).datepicker();

	jQuery('#cancel').click(function (){
		window.location.href = '{/literal}{if false eq is_null($return)}?module={$return}{else}?module=patients&action=view_patients{/if}{literal}';
	});

	jQuery('#save_payment').click(function (){		
		jQuery('#is_save_payment').val("1");		
		jQuery('#frmPatient').submit();		
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
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<input type="submit" class="button" id="save_payment" value="{if 'edit_patient' eq $action}Payment{else}Save & Payment{/if}" />			
			<input type="button" class="button" id="cancel" value="Cancel" />			
			<!-- <a href="{$exit_tags.create_formf}&patient[id]={$patient->getId()}">Form F</a> -->
		</div>
		<!-- End Form Buttons -->
		<input type="hidden" name="return" value="{$return}">
		<input type="hidden" name="patients[sr_no]" value="{$patient->getSrNo()}">
		<input type="hidden" name="is_save_payment" id="is_save_payment" value="0">
		<input type="hidden" name="page" value="{$page}">
		{if false eq is_null($patient->getId())}
			<input type="hidden" name="patients[balance_status_type_id]" value="{$patient->getBalanceStatusTypeId()}">
		{/if}
		<!-- Form -->
		<div class="form" style="width: 41%;float: left;">
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
				<select class="field size1" id="doctor_id" name="patients[doctor_id]" style="width: 280px;">
					<option value="">Select Doctor</option>																
					{foreach from="$doctors" item="doctor"}
						<option value="{$doctor->getId()}" {if $patient->getDoctorId() eq $doctor->getId()}selected{/if}> {$doctor->getLastName()} {$doctor->getFirstName()}</option>									
					{/foreach}
				</select>
			</p>
			<p class="inline-field">
				<label>Patient Type</label>
				<select class="field size1" name="patients[patient_type_id]" style="width: 280px;">				
					<option value="2" {if $patient->getPatientTypeId() eq 2}selected{/if}> OPD</option>
					<option value="1" {if $patient->getPatientTypeId() eq 1}selected{/if}> IPD</option>									
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
				
			</div>
		</div>
		<!-- End Form -->
		<div style="width: 56%;float: right;">
			<div class="box">
				<div class="box-head">
					<h2 id="sono">Billing Details</h2>
				</div>
				<div class="form">					
					<p class="inline-field" >					
						<label>Bill Amount&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<!-- Received Amount -->&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							{if 0 lt $patient->getBalanceAmt() and 2 neq $patient->getBalanceStatusTypeId()}
								Balance:<img height="11px" width="12px" src="css/images/rupee.jpg"><span style="color: red; font-weight: bold;">{$patient->getBalanceAmt()}</span>								
							{/if}
							{if false eq is_null( $patient->getId() )}
								&nbsp;Last Paid:<img height="11px" width="12px" src="css/images/rupee.jpg">{$patient->getReceivedAmt()}
							{/if}
						</label>
						<input type="text" id="bill_amt" name="patients[total_bill_amt]" value="{$patient->getTotalBillAmt()}" class="field size2"/>&nbsp;&nbsp;&nbsp;
						<!--<input type="text" name="patients[received_amt]" value="{*$patient->getReceivedAmt()*}" class="field size2"/>-->						
					</p>
					<p class="inline-field">					
						<label>SDC&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;RDC</label>				
						<input type="text" id="lab_amt" name="patients[ipd_amt]" value="{$patient->getIpdAmt()}" class="field size2">&nbsp;&nbsp;&nbsp;
						<input type="text" id="ref_amt" name="patients[opd_amt]" value="{$patient->getOpdAmt()}" class="field size2"/>
						
					</p>
					<p class="inline-field">
						<label>Is Finalized</label>
						<input type="checkbox" name="patients[is_finalized]" value="1" {if 1 eq $patient->getIsFinalized()}checked=checked{/if} class="field size2"/>						
					</p>		
				</div>
			</div>
			<div class="box">
				<div class="box-head">
					<h2 id="patho">Pathology / Sonography / X-Ray</h2>
				</div>
				<div class="form" id="patho_details">					
					<div style="float: left;" id="selection">
						{foreach from="$pathology_tests" item="pathology_test"}
							{if 0 neq $customer_pathology_tests|@count and true eq $pathology_test->getId()|array_key_exists:$customer_pathology_tests}
								<div id=d_{$pathology_test->getId()}> <input type="hidden" name="path_tests[]" value="{$pathology_test->getId()}"> {$pathology_test->getName()}&nbsp;<a href="#" onclick="test('{$pathology_test->getId()}', 1);remove('{$pathology_test->getId()}', 1);">X</a></div>		
							{/if}
						{/foreach}
						{foreach from="$sonography_tests" item="sonography_test"}
							{if 0 neq $customer_pathology_tests|@count and true eq $sonography_test->getId()|array_key_exists:$customer_pathology_tests}
								<div id=d_{$sonography_test->getId()}> <input type="hidden" name="path_tests[]" value="{$sonography_test->getId()}"> {$sonography_test->getName()}&nbsp;<a href="#" onclick="test('{$sonography_test->getId()}', 2);remove('{$sonography_test->getId()}', 2);">X</a></div>		
							{/if}
						{/foreach}
						{foreach from="$xray_tests" item="xray_test"}
							{if 0 neq $customer_pathology_tests|@count and true eq $xray_test->getId()|array_key_exists:$customer_pathology_tests}
								<div id=d_{$xray_test->getId()}> <input type="hidden" name="path_tests[]" value="{$xray_test->getId()}"> {$xray_test->getName()}&nbsp;<a href="#" onclick="test('{$xray_test->getId()}', 3);remove('{$xray_test->getId()}', 3);">X</a></div>		
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
			<input type="submit" class="button" id="save_payment" value="{if 'edit_patient' eq $action}Payment{else}Save & Payment{/if}" />
			<!-- <input type="button" class="button" id="formf" value="Form F" /> -->
			<input type="button" class="button" id="cancel" value="Cancel" />			
		</div>
		<!-- End Form Buttons -->
	</form>
</div>