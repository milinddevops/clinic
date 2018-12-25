{if true eq $expence->getErrorMsg()|is_array}
	{foreach from=$expence->getErrorMsg() item="error"}
		<div class="msg msg-error">
			<p><strong>{$error}</strong></p>
		</div>
	{/foreach}
{/if}
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Add new Expense</h2>
	</div>
	<!-- End Box Head -->
	<form name="frmExpence" id="frmExpence" action="{if true eq $expence->getId()|is_null}{$exit_tags.insert_expence}{else}{$exit_tags.update_expence}{/if}" method="post">
		<input type="hidden" name="expence[id]" value="{$expence->getId()}">		
		<!-- Form -->
		<div class="form" style="width: 45%;float: left;">			
			<p>					
				<label>Expense Reason</label>				
				<textarea cols="60" rows="10" class="field size4" name="expence[reason]">{$expence->getReason()}</textarea>
			</p>
			<p>					
				<label>Amount</label>
				<input type="text" name="expence[amount]" class="field size2" style="width: 120px;" value="{$expence->getAmount()}">
			</p>			
			
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
</div>