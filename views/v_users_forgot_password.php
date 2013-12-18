<div class="row">
	<form  method="POST" action="/users/p_forgot_password/" id="forgotPasswordLogin">
		
		<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10">
		<h3>Forgot Your Password?</h3>
		<p>Please enter email that you used for registration.</p>
			
			<!-- Email input -->
			<label for="yourEmail">Email</label>
			<input class="form-control" value="<?php echo $email?>" placeholder="Your Email" id="yourEmail" type="text" name="email" required><br/>
			<p id="yourEmailInfo"></p>
			
			
				<?php if(isset($error) ): ?>
					<p class="error">This email is not registered to the Web BookMark.</p>
				<?php endif; ?>
			
			<button type="submit" class="btn btn-default">Get Password</button>
			
		</div><!-- /.col-md-offset-1 .col-xs-8 .col-sm-6 .col-md-4 -->
	</form>
</div><!-- / .row -->
