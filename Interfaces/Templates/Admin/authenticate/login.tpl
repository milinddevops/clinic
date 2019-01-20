<div class="box" style="width: 60%; height: 30%">
	<!-- Box Head -->
	<div class="box-head">
		<h2>Login</h2>
	</div>
	<!-- End Box Head -->
	
	<form name="loginform" id="loginform" action="{$exit_tags.login_attempt}" method="post">
		<!-- Form -->
		<div class="form">
				<p>					
					<label>Username</label>
					<input name="user[username]" id="user_login" type="text" class="field size2" style="width: 272px;" />
				</p>				
				<p>					
					<label>Password</label>
					<input type="password" name="user[password]" id="user_pass" class="field size2" style="width: 272px;"/>
				</p>
		</div>
		<!-- End Form -->
		
		<!-- Form Buttons -->
		<div class="buttons">
			<button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
		</div>
		<!-- End Form Buttons -->
	</form>
</div>