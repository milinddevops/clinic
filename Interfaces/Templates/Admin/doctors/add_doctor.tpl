<div class="box">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Add new Doctor</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="frmDoctor" id="frmDoctor" action="{$exit_tags.insert_doctor}" method="post">
		
		<!-- Form -->
		<div class="form" style="width: 38%;float: left;">			
			<p>					
				<label>First Name</label>
				<input type="text" name="doctors[first_name]" value="" class="field size2" style="width: 272px;"/>
			</p>
			<p>					
				<label>Last Name</label>
				<input type="text" name="doctors[last_name]" value="" class="field size2" style="width: 272px;"/>
			</p>
			<p>					
				<label>Phone</label>
				<input type="text" name="doctors[phone]" value="" class="field size2" style="width: 272px;"/>
			</p>
			<p>
				<label>E-mail</label>
				<input type="text" name="doctors[email]" class="field size2" style="width: 272px;">
			</p>
			<p>					
				<label>Address</label>
				<input type="text" name="doctors[address]" class="field size2" style="width: 272px;">
			</p>			
			<p>					
				<label>Referal</label>
				<input type="checkbox" name="doctors[is_ref_fee]" value="1">
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