<div class="row">
	<form  method="POST" action="/users/p_reset_password/" id="formPassword">
		<div class="col-md-offset-1 col-xs-12 col-sm-6 col-md-6">
			
			<label for="yourPassword">Password</label>
			<input class="form-control" placeholder="Password" id="yourPassword" type="password" name="password" required><br/>
			<p id="yourPasswordInfo"></p>
			
			<input type="hidden" value="<?php echo $email?>" name="email">
			<input type="hidden" value="<?php echo $token ?>" name="token">
			
			<button type="submit" class="btn btn-default">Reset Password</button> 
		</div><!-- /.col-md-offset-1 .col-xs-8 .col-sm-6 .col-md-4 -->
	</form>
</div><!-- / .row -->