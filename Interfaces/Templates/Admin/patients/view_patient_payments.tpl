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
		window.location.href = '{/literal}{if false eq is_null($return)}?module={$return}{else}?module=patients&action=view_patients&page={$page}{/if}{literal}';
	});

	jQuery('#cancell').click(function (){
		window.location.href = '{/literal}{if false eq is_null($return)}?module={$return}{else}?module=patients&action=view_patients&page={$page}{/if}{literal}';
	});
	
    jQuery('#bill').click(function (){
        var bill_win_url = '{/literal}{if false eq is_null($return)}?module={$return}{else}?module=patients&action=show_bill&patients[id]={$patient->getId()}{/if}{literal}';
        window.open(bill_win_url, "popupWindow", "width=600,height=600,scrollbars=yes");
        //window.location.href = '{/literal}{if false eq is_null($return)}?module={$return}{else}?module=patients&action=show_bill&patients[id]={$patient->getId()}{/if}{literal}';
	});
	    
	    jQuery('#bill2').click(function (){
	        var bill_win_url = '{/literal}{if false eq is_null($return)}?module={$return}{else}?module=patients&action=show_bill&patients[id]={$patient->getId()}{/if}{literal}';
	        window.open(bill_win_url, "popupWindow", "width=600,height=600,scrollbars=yes");
		//window.location.href = '{/literal}{if false eq is_null($return)}?module={$return}{else}?module=patients&action=show_bill&patients[id]={$patient->getId()}{/if}{literal}';
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
		<h2>Patient Payments</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="frmPatient" id="frmPatient" action="{$exit_tags.update_patient_payments}&patients[id]={$patient->getId()}" method="post">
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<input type="button" class="button" id="cancel" value="Cancel" />
			<input type="button" class="button" id="bill" value="Print Bill" />		
		</div>
		<!-- End Form Buttons -->
		<!-- Form -->
		<input type="hidden" name="patients[id]" value="{$patient->getId()}"> 
 		<div class="form" style="width: 41%;float: left;">
						
			<p>
				<label>Patient Name</label>
				{$patient->getFirstName()} {$patient->getLastName()}
			</p>
			<p class="inline-field">
				<label>Refering Doctor</label>
				{$doctor->getLastName()} {$doctor->getFirstName()}
			</p>
			<p class="inline-field">
				<label>Patient Type</label>
				{if $patient->getPatientTypeId() eq 2}OPD{/if}
				{if $patient->getPatientTypeId() eq 1}IPD{/if}
			</p>
			<p class="inline-field">
				<label>Total Bill</label>
				<img src="css/images/rupee.jpg" height="11px" width="12px">{$patient->getTotalBillAmt()}				
			</p>
			<p class="inline-field">
				<label>Balance</label>
				<img src="css/images/rupee.jpg" height="11px" width="12px">{$patient->getBalanceAmt()}				
			</p>
			<p>					
				<label>Amount</label>
				<input type="text" id="last_name" name="patient_payments[amount]" value="" class="field size2" style="width: 272px;"/>
			</p>
			<p class="inline-field">
				<label>Date</label>
				<input id="datepicker" type="text" name="patients[recieved_on]" class="field size2" style="width: 272px;" value="{$smarty.now|date_format:'%Y-%m-%d'}" readonly>
				<!--<input type="text" id="recieved_on" name="patients[recieved_on]" class="field size2" style="width: 272px;" value="{$patient->getReceivedDate()}" readonly onChange="changeDate(this.value);"> -->							
			</p>
			<div>
				
			</div>
		</div>
		<!-- End Form -->
		<div style="width: 56%;float: right;">
			<div class="box">
				<div class="box-head">
					<h2 id="sono">Payment Details</h2>
				</div>
				<div class="table">	
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>				
							<td><strong>Date</strong></td>
							<td><strong>Amount</strong></td>					
						</tr>
						{if 0 < $patient_payments|@count}
						{foreach from=$patient_payments item="patient_payment"}
						<tr>				
							<td>{$patient_payment->getCreatedOn()} </td>
							<td><strong><img src="css/images/rupee.jpg" height="11px" width="12px">{$patient_payment->getAmount()}</strong></td>					
						</tr>	
						{/foreach}
						{else}
						<tr>				
							<td colspan=2>No Payments... </td>												
						</tr>
						{/if}
					</table>				
				</div>
			</div>			
		</div>
		<div style="clear: both;"></div>
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<input type="button" class="button" id="cancell" value="Cancel" />
			<input type="button" class="button" id="bill2" value="Print Bill" />			
		</div>
		<!-- End Form Buttons -->
	</form>
</div>