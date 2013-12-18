<div class="row" >
	<form method="POST" action="/users/p_signup" id="registrationForm">
		<div class="col-md-offset-1 col-xs-12 col-sm-6 col-md-5">
			<h1>Signup for Web BookMark</h1><br/>
			<p>Sign up for Web BookMark. Save, organize, and discover interesting links on the web. Instantly connect to what's most important to you. Connect to others to checkout what they have saved.</p>
			<p class="text-muted warning">By clicking Sign Up, you agree to our Terms and that you have read our Data Use Policy, including our Cookie Use.</p><br/>
		</div> <!-- / .col-md-offset-1 .col-xs-12 .col-sm-6 .col-md-5 -->
		
		<div class="col-md-offset-1 col-xs-8 col-sm-6 col-md-4">
			<!-- First Name input -->
			<label for="firstName">First Name</label>
			<input class="form-control" placeholder="First Name" id="firstName" type="text" name="first_name" required><br/>
			<p id="firstNameInfo"></p>
			
			<!-- Last Name input -->
			<label for="lastName">Last Name</label>
			<input class="form-control" placeholder="Last Name" id="lastName" type="text" name="last_name" required><br/>
			<p id="lastNameInfo"></p>
			
			<!-- Email input -->
			<label for="yourEmail">Email</label>
			<input class="form-control" placeholder="Your Email" id="yourEmail" type="text" name="email" required><br/>
			<p id="yourEmailInfo"></p>
			
			<!-- Password input -->
			<label for="yourPassword">Password</label>
			<input class="form-control" placeholder="Password" id="yourPassword" type="password" name="password" required><br/>
			<p id="yourPasswordInfo"></p>
			
			<!-- Confirm Password input 
			<label for="passwordConfirm">Confirm Password</label>
			<input id="passwordConfirm" name="passwordConfirm" type="password" />
			<p id="passwordConfirmInfo"></p>-->
			
			<!-- If there is an error, Show this message -->
			<?php if(isset($error)): ?>
				<p class="error">
					You already have an account on Web BookMark. <a href="/users/login">Login here</a>
				</p>
			<?php endif; ?>
    	
			<button type="submit" class="btn btn-default" id="signUp">Sign up</button>
		</div><!-- /.col-md-offset-1 .col-sm-offset-1 .col-xs-8 .col-sm-6 .col-md-4 -->
	</form>
</div><!-- /.row -->
	