<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Add new Reminder</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="frmReminder" id="frmReminder" action="{if true eq is_null($reminder->getId())}{$exit_tags.insert_reminder}{else}{$exit_tags.update_reminder}{/if}" method="post">
		<input type="hidden" name="reminder[id]" value="{$reminder->getId()}">		
		<!-- Form -->
		<div class="form" style="width: 45%;float: left;">			
			<p>					
				<label>Description</label>				
				<textarea cols="60" rows="10" class="field size4" name="reminder[description]">{$reminder->getDescription()}</textarea>
			</p>
			<p>					
				<label>Alert Date</label>
				<select class="field size1" id="title" name="reminder[alert_on]" style="width: 180px;">
					<option value="1" {if '1' eq $reminder->getAlertOn()}selected{/if}>1</option>
					<option value="2" {if '2' eq $reminder->getAlertOn()}selected{/if}>2</option>
					<option value="3" {if '3' eq $reminder->getAlertOn()}selected{/if}>3</option>
					<option value="4" {if '4' eq $reminder->getAlertOn()}selected{/if}>4</option>
					<option value="5" {if '5' eq $reminder->getAlertOn()}selected{/if}>5</option>
					<option value="6" {if '6' eq $reminder->getAlertOn()}selected{/if}>6</option>
					<option value="7" {if '7' eq $reminder->getAlertOn()}selected{/if}>7</option>
					<option value="8" {if '8' eq $reminder->getAlertOn()}selected{/if}>8</option>
					<option value="9" {if '9' eq $reminder->getAlertOn()}selected{/if}>9</option>
					<option value="10" {if '10' eq $reminder->getAlertOn()}selected{/if}>10</option>
					<option value="11" {if '11' eq $reminder->getAlertOn()}selected{/if}>11</option>
					<option value="12" {if '12' eq $reminder->getAlertOn()}selected{/if}>12</option>
					<option value="13" {if '13' eq $reminder->getAlertOn()}selected{/if}>13</option>
					<option value="14" {if '14' eq $reminder->getAlertOn()}selected{/if}>14</option>
					<option value="15" {if '15' eq $reminder->getAlertOn()}selected{/if}>15</option>
					<option value="16" {if '16' eq $reminder->getAlertOn()}selected{/if}>16</option>
					<option value="17" {if '17' eq $reminder->getAlertOn()}selected{/if}>17</option>
					<option value="18" {if '18' eq $reminder->getAlertOn()}selected{/if}>18</option>
					<option value="19" {if '19' eq $reminder->getAlertOn()}selected{/if}>19</option>
					<option value="20" {if '20' eq $reminder->getAlertOn()}selected{/if}>20</option>
					<option value="21" {if '21' eq $reminder->getAlertOn()}selected{/if}>21</option>
					<option value="22" {if '22' eq $reminder->getAlertOn()}selected{/if}>22</option>
					<option value="23" {if '23' eq $reminder->getAlertOn()}selected{/if}>23</option>
					<option value="24" {if '24' eq $reminder->getAlertOn()}selected{/if}>24</option>
					<option value="25" {if '25' eq $reminder->getAlertOn()}selected{/if}>25</option>
					<option value="26" {if '26' eq $reminder->getAlertOn()}selected{/if}>26</option>
					<option value="27" {if '27' eq $reminder->getAlertOn()}selected{/if}>27</option>
					<option value="28" {if '28' eq $reminder->getAlertOn()}selected{/if}>28</option>
					<option value="29" {if '29' eq $reminder->getAlertOn()}selected{/if}>29</option>
					<option value="30" {if '30' eq $reminder->getAlertOn()}selected{/if}>30</option>
					<option value="31" {if '31' eq $reminder->getAlertOn()}selected{/if}>31</option>
					
				</select>				
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