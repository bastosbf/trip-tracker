<form id="login-form">
 <div class="form-group">
  <label for="login_email">E-mail</label>
  <input type="email" id="login_email" name="login_email" class="form-control" placeholder="E-mail" />
 </div>
 <div class="form-group">
  <label for="login_password">Password</label>
  <input type="password" id="login_password" name="login_password" class="form-control" placeholder="Password" />
 </div>
 <div class="form-group" align="right">
  <input type="submit" class="btn btn-primary" value="Login" />
 </div>
</form>
<script type="text/javascript">
$("#login-form").on("submit",  function(e) {
 return false;
});
</script>