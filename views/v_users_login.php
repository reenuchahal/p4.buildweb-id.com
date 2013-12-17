<?php if(isset($loginMessage) & !isset($error)): ?>
<div class="row">
	<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-success">
		<h4> You have been registered to website successfully. Please Login.</h4>
	</div>
</div><br/>
<?php endif; ?>
<div class="row">
	<form  method="POST" action="/users/p_login">
		<div class="col-md-offset-1 col-xs-12 col-sm-6 col-md-5">
			<h1>Login for Web BookMark</h1><br/>
			<p>Don't have an account on Web BookMark? <a href="/users/signup">Signup here.</a></p><br/>
		</div> <!-- / .col-md-offset-1 .col-xs-12 .col-sm-6 .col-md-5 -->
		
		<div class="col-md-offset-1 col-xs-8 col-sm-6 col-md-4">
			<label for="loginEmail">Email</label>
			<input class="form-control" placeholder="Enter email" id="loginEmail" type="text" name="email" required><br/>
		
			<label for="loginPassword">Password</label>
			<input class="form-control" placeholder="Enter Password" id="loginPassword" type="password" name="password" required><br/>
		
			<?php if(isset($loginMessage) & isset($error) ): ?>
				<p class="error"> Login failed. <br/>Please double check your email and password.</p>
			<?php endif; ?>
			
			<button type="submit" class="btn btn-default">Log in</button>
		</div><!-- /.col-md-offset-1 .col-xs-8 .col-sm-6 .col-md-4 -->
	</form>
</div><!-- / .row -->
	