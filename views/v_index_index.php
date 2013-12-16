<?php if($user): ?>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1><br/>
		</div><!-- / .col-xs-12 .col-sm-12 .col-md-12 -->
	</div><!-- / .row -->
<?php endif; ?>

<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<p>Sign up for Web BookMark. Save, organize, and 
			discover interesting links on the web. 
			Instantly connect to what's most important to you. 
			Connect to others to checkout what they have saved.
		</p>
			
	</div><!-- / .col-xs-12 .col-sm-12 .col-md-8-->
</div><!-- / .row -->


