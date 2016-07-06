<form id="register-form">
 <div class="form-group">
  <label for="register_name">Name</label>
  <input type="text" id="register_name" name="register_name" class="form-control" placeholder="Name" />
 </div>
 <div class="form-group">
  <label for="register_email">E-mail</label>
  <input type="email" id="register_email" name="register_email" class="form-control" placeholder="E-mail" />
 </div>
 <div class="form-group">
  <label for="register_password">Password</label>
  <input type="password" id="register_password" name="register_password" class="form-control" placeholder="Password" />
 </div>
 <div class="form-group">
  <label for="register_repassword">Confirm password</label>
  <input type="password" id="register_repassword" name="register_repassword" class="form-control" placeholder="Re-password" />
 </div>
 <div class="form-group" align="right">
  <input type="submit" class="btn btn-primary" value="Register" />
 </div>
</form>
<script type="text/javascript">
 $("#register-form").on("submit", function(e) {  
  return false;
 });
 </script>
