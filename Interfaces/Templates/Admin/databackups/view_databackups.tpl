<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2 class="left">Data Backups</h2>
		<div class="right">
			<form name="frmSearch" id="frmSearch" action="" method="post">
				<label>search backups</label>
				<input type="text" name="backup[search_text]" class="field small-field" />
				<input type="submit" class="button" value="Search" />
			</form>
		</div>
	</div>
	<!-- End Box Head -->	

	<!-- Table -->
	<div class="table">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>				
				<th>Created  Date</th>
				<th>Databackup Range</th>
				<th>Actions</th>
			</tr>
			{if 0 < $databackups|@count}
				{foreach from="$databackups" item="databackup"}
					<tr>				
						<td class="table_date">{$databackup->getCreatedOn()}</td>
						<td class="table_title">{$databackup->getStartDate()} to {$databackup->getEndDate()}</td>
						<td><a href="{$exit_tags.restore_databackup}&databackups[id]={$databackup->getId()}" class="ico del">Restore</a></td>
					</tr>
				{/foreach}
			{else}
				<tr>				
					<td class="table_date" colspan="2">No databackups found.</td>
				</tr>
			{/if}
		</table>			
	</div>
	<!-- Table -->
	
</div>