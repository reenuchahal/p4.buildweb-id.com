<?php if(!isset($success) &!isset($error1) & !isset($error2)): ?>
	<div class="row">
		<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-warning">
			<h4>
				A link has been sent at your email to reset password.<br/> 
				Please click on that link to reset it. 
			</h4>
		</div>
	</div>
<?php endif; ?>
<?php if(isset($success) &!isset($error1) & !isset($error2)): ?>
	<div class="row">
		<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-success">
			<h4>
				Your password has been reset. Please <a href="/users/login">login here</a>.
			</h4>
		</div>
	</div>
<?php endif; ?>
<?php if(isset($success) & isset($error1) & !isset($error2)): ?>
	<div class="row">
		<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-danger">
			<h4>Invalid approach, please use the link that has been send to your email</h4>
		</div>
	</div><br/>
<?php endif; ?>
<?php if(isset($success) & isset($error1) & isset($error2)): ?>
	<div class="row">
		<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-danger">
			<h4>The url is either invalid or you have already used this link to recover your password.</h4>
		</div>
	</div><br/>
<?php endif; ?>

