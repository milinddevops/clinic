{literal}
<script type="text/javascript">
<!--
	
		function deleteTest(id) {
			if (confirm("Are you sure to delete?")) {
				location.href = '{/literal}{$exit_tags.delete_test}{literal}&pathology_test[id]=' + id				
			}
		}
this.deleteTest = deleteTest;
//-->

</script>
{/literal}

<div class="box">
	<!-- Box Head -->
	<div class="box-head">
<!--		<h2 class="left">Doctors</h2>-->
		<div class="right">
			<form name="frmSearch" id="frmSearch" action="{$exit_tags.search_tests}" method="post">
				<label></label>
				<input type="text" name="tests[search_text]" class="field small-field" />
				
				<input type="submit" class="button" value="Search" />
			</form>
		</div>
	</div>
	<!-- End Box Head -->	

	<!-- Table -->
	<div class="table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>				
				<th>Test Name</th>
				{*<th>SDC</th>
				<th>RDC</th>*}
				<th>Amount</th>
				<th>Actions</th>
			</tr>
			{if 0 < $clinical_tests|@count}
				{foreach from="$clinical_tests" item="clinical_test"}
				{math equation="dr+cr" cr=$clinical_test->getLabRate() dr=$clinical_test->getDocRate() assign="total"} 
					<tr>				
						<td class="table_date">{$clinical_test->getName()}</td>
						{*<td class="table_date"><img src="css/images/rupee.jpg" height="11px" width="12px">{$clinical_test->getLabRate()}</td>
						<td class="table_date"><img src="css/images/rupee.jpg" height="11px" width="12px">{$clinical_test->getDocRate()}</td>*}
						<td class="table_date"><img src="css/images/rupee.jpg" height="11px" width="12px">{$clinical_test->getTotal()}</td>
						<td><a href="javascript:deleteTest({$clinical_test->getId()})" class="ico del">Delete</a><a href="{$exit_tags.edit_clinical_test}&clinical_test[id]={$clinical_test->getId()}" class="ico edit">Edit</a></td>
					</tr>				
				{/foreach}
			{else}
				<tr>				
					<td class="table_date" colspan="4">No tests...</td>
				</tr>
			{/if}
		</table>			
	</div>
	<!-- Table -->
	
</div>