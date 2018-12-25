{if true eq is_array($success_msgs)}
	<div id="success" class="info_div">
	{foreach from=$success_msgs item=success_msg}
		<span class="ico_success">{$success_msg}!</span>
	{/foreach}
	</div>
{/if}

{if true eq is_array($error_msgs)}
	<div id="fail" class="info_div">
	{foreach from=$error_msgs item=error_msg}
		{*<div class="errors"> {$error_msg} </div>*}
		<span class="ico_cancel">{$error_msg}</span>
	{/foreach}
	</div>
{/if}