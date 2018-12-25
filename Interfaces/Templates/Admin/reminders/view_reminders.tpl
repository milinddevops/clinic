{literal}
<script type="text/javascript">
<!--	
	function deleteReminder(id) {
		if (confirm("Are you sure to delete?")) {
			location.href = '{/literal}{$exit_tags.delete_reminder}{literal}&reminder[id]=' + id;				
		}
	}
this.deleteExpence = deleteExpence;
//-->
</script>
{/literal}
<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left">Reminders&nbsp;&nbsp;</h2>
	</div>
	<!-- End Box Head -->	

	<!-- Table -->
	<div class="table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">		
			<tr>				
				<td colspan="4" align="right">
					<form name="frmSearch" id="frmSearch" action="/?module=reminders&action=search_reminders" method="post">
						<label>search reminders</label>
						<input type="text" name="reminder[search_text]" class="field small-field" />
						<input type="submit" class="button" value="Search" />
					</form>
				</td>
			</tr>
			<tr>				
				<th>Date</th>
				<th>Description</th>								
				<th width="110" class="ac">--</th>
			</tr>
			{if 0 lt $reminders|@count}
			{foreach from="$reminders" item="reminder"}
				<tr>				
					<td><h3><a href="#">{$reminder->getCreatedOn()|date_format:'%d-%m-%Y'}</a></h3></td>
					<td>{$reminder->getDescription()}</td>					
					<td>
						<a href="javascript:deleteReminder({$reminder->getId()})" class="ico del">Delete</a>
						<a href="{$exit_tags.edit_reminder}&reminder[id]={$reminder->getId()}" class="ico edit">Edit</a>
					</td>
				</tr>				
			{/foreach}
			{else}
				<tr>				
					<td colspan="6"><h3>No Reminders...</h3></td>
				</tr>
			{/if}
		</table>			
	</div>
	<!-- Table -->
	
</div>