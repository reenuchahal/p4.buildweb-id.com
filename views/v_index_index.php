<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<?php if($user): ?>
		
		<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1><br/>
		<?php endif; ?>

		<?php if(!$user): ?>
			<h1>Welcome to <?=APP_NAME?></h1><br/>
			<p>Sign up for Web BookMark. Save, organize, and 
				discover interesting links on the web. 
				Instantly save what's most important to you. 
				Connect to others to checkout what they have saved.
			</p>
		<?php endif; ?>
	</div><!-- / .col-xs-12 .col-sm-12 .col-md-12 -->
</div><!-- / .row -->
