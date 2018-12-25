{literal}
<script type="text/javascript">
<!--	
	function deleteExpence(id) {
		if (confirm("Are you sure to delete?")) {
			location.href = '{/literal}{$exit_tags.delete_expence}{literal}&expence[id]=' + id;				
		}
	}
this.deleteExpence = deleteExpence;
//-->
</script>
{/literal}
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left">Expences&nbsp;&nbsp;</h2>
	</div>
	<!-- End Box Head -->	

	<!-- Table -->
	<div class="table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">		
			<tr>				
				<td colspan="4" align="right">
					<form name="frmSearch" id="frmSearch" action="/?module=expences&action=search_expences" method="post">
						<label>search expences</label>
						<input type="text" name="expence[search_text]" class="field small-field" />
						<input type="submit" class="button" value="Search" />
					</form>
				</td>
			</tr>
			<tr>				
				<th>Date</th>
				<th>Amount</th>
				<th>Resaon</th>				
				<th width="110" class="ac">--</th>
			</tr>
			{if 0 lt $expences|@count}
			{foreach from="$expences" item="expence"}
				<tr>				
					<td><h3><a href="#">{$expence->getCreatedOn()|date_format:'%d-%m-%Y'}</a></h3></td>
					<td><img src="css/images/rupee.jpg" height="11px" width="12px">{$expence->getAmount()}</td>
					<td>{$expence->getReason()}</td>					
					<td>
						<a href="javascript:deleteExpence({$expence->getId()})" class="ico del">Delete</a>
						<a href="{$exit_tags.edit_expence}&expence[id]={$expence->getId()}" class="ico edit">Edit</a>
					</td>
				</tr>				
			{/foreach}
			{else}
				<tr>				
					<td colspan="6"><h3>No Expences...</h3></td>
				</tr>
			{/if}
		</table>			
	</div>
	<!-- Table -->
	
</div>