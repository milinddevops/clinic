<div class="box" style="width: 60%; height: 30%">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Account Activation</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="loginform" id="loginform" action="{$basename}/activate.php" method="post">						
		<!-- Form -->
		<div class="form">
				<p>					
					<label>Owner First Name</label>
					<input name="license[first_name]" id="owner_first_name" type="text" class="field size2" style="width: 272px;" />
				</p>				
				<p>					
					<label>Owner Last Name</label>
					<input type="text" name="license[last_name]" id="owner_last_name" class="field size2" style="width: 272px;"/>
				</p>
				<p>					
					<label>Activation Key</label>
					<input type="text" name="license[key]" id="url" class="field size2" style="width: 272px;"/>
				</p>
				<p>					
					<label>Activation URL</label>
					<input type="text" name="license[url]" id="url" class="field size2" style="width: 272px;"/>
				</p>
		</div>
		<!-- End Form -->
		
		<!-- Form Buttons -->
		<div class="buttons">
			<input type="submit" class="button" value="Activate Now" />						
		</div>
		<!-- End Form Buttons -->
	</form>
</div>