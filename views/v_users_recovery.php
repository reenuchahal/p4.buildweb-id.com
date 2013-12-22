<!-- If success, error1 and error2 are not set -->
<?php if(!isset($success) &!isset($error1) & !isset($error2)): ?>
	<div class="row">
		<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-warning">
			<h4>
				Your instructions to reset your password have been emailed to you. <br/> 
				If you don't receive this email within 10 minutes, 
				check your junk and spam folders for a message from  info@p4.buildweb-id.com
			</h4>
		</div>
	</div>
<?php endif; ?>

<!-- If success message is set but error1 and error2 are not set -->
<?php if(isset($success) &!isset($error1) & !isset($error2)): ?>
	<div class="row">
		<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-success">
			<h4>
				Your password has been reset. Please <a href="/users/login">login here</a>.
			</h4>
		</div>
	</div>
<?php endif; ?>

<!-- If error1 is set and error2 is not set -->
<?php if(isset($success) & isset($error1) & !isset($error2)): ?>
	<div class="row">
		<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-danger">
			<h4>Invalid approach, please use the link that has been send to your email</h4>
		</div>
	</div><br/>
<?php endif; ?>

<!-- If error2 is set -->
<?php if(isset($success) & isset($error1) & isset($error2)): ?>
	<div class="row">
		<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-danger">
			<h4>The url is either invalid or you have already used this link to recover your password.</h4>
		</div>
	</div><br/>
<?php endif; ?>

