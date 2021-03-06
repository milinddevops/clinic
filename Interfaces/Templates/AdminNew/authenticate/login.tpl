<div class="container">
  <div class="card card-login mx-auto mt-5">
    <div class="card-header">Login</div>
    <div class="card-body">
      <form name="loginform" id="loginform" action="{$exit_tags.login_attempt}" method="post">
        <div class="form-group">
          <div class="form-label-group">
            <input type="text" name="user[username]" id="user_login" class="form-control" placeholder="Email address" required="required" autofocus="autofocus">
            <label for="user_login">Username</label>
          </div>
        </div>
        <div class="form-group">
          <div class="form-label-group">
            <input type="password" name="user[password]" id="user_pass" class="form-control" placeholder="Password" required="required">
            <label for="user_pass">Password</label>
          </div>
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block">Login</button>
      </form>
      <div class="text-center">
    </div>
  </div>
</div>