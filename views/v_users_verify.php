<?php if(!isset($error1) & !isset($error2)): ?>
<div class="row">
	<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-warning">
		<h4>
			Your account has been made. <br /> <br />  Please verify it by clicking the activation link that has been send to your email.
			If you don't receive our email shortly, please check in Spam.
		</h4>
	</div>
</div>
<?php endif; ?>
<?php if(isset($error1) & !isset($error2)): ?>
<div class="row">
	<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-danger">
		<h4>Invalid approach, please use the link that has been send to your email</h4>
	</div>
</div><br/>
<?php endif; ?>
<?php if(isset($error1) & isset($error2)): ?>
<div class="row">
	<div class="col-md-offset-1 col-xs-12 col-sm-12 col-md-10 bs-callout-danger">
		<h4>The url is either invalid or you already have activated your account.</h4>
	</div>
</div><br/>
<?php endif; ?>

