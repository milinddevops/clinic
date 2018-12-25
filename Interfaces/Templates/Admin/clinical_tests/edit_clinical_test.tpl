{literal}
<script type="text/javascript">
jQuery(document).ready(function() {
	jQuery('#back').click(function(){
		window.location ='{/literal}{$exit_tags.view_clinical_tests}{literal}';
	});
});
{/literal}
</script>

<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Clinical Test</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="frmTest" id="frmTest" action="{if true eq $clinical_test->getId()|is_null}{$exit_tags.insert_test}{else}{$exit_tags.update_test}{/if}" method="post">
		
		<!-- Form -->
		<div class="form" style="width: 45%;float: left;">			
			<p>					
				<label>Test Name</label>
				<input type="text" name="pathology_test[name]" value="{$clinical_test->getName()}" class="field size2" style="width: 272px;"/>
			</p>
			<p>
				<label>Test Type</label>
				<select class="field size1" id="title" name="pathology_test[test_type]" style="width: 180px;">
					<option value="">Select Test Type</option>					
					<option value="1" {if '1' eq $clinical_test->getTestType()}selected{/if}>Pathology</option>
					<option value="2" {if '2' eq $clinical_test->getTestType()}selected{/if}>Sonography</option>
					<option value="3" {if '3' eq $clinical_test->getTestType()}selected{/if}>X-Ray</option>															
				</select>
			</p>
			<p>					
				<label>Lab Charges</label>
				<input type="text" name="pathology_test[lab_rate]" value="{$clinical_test->getLabRate()}" class="field size2" style="width: 272px;"/>
			</p>
			<p>					
				<label>Ref. Charges</label>
				<input type="text" name="pathology_test[doc_rate]" value="{$clinical_test->getDocRate()}" class="field size2" style="width: 272px;"/>
			</p>
			
			<p>					
				<label>Total</label>
				<input type="text" name="pathology_test[total]" value="{$clinical_test->getTotal()}" class="field size2" style="width: 272px;"/>
			</p>			
			
		</div>
		<!-- End Form -->
		<div style="clear: both;"></div>
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Save" />
			<input type="button" class="button" id="back" value="Cancel" />			
		</div>
		<!-- End Form Buttons -->
		<input type="hidden" name="pathology_test[id]" value="{$clinical_test->getId()}">
	</form>
</div>