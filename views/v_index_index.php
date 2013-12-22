<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12">
		<?php if($user): ?>
			<h1>Welcome to <?=APP_NAME?><?php if($user) echo ', '.$user->first_name; ?></h1><br/>
		<?php endif; ?>

		<?php if(!$user): ?>
			<h1><span class="glyphicon glyphicon-bookmark"></span><?=APP_NAME?></h1><br/>
			<h2>Couldn't recall the link?</h2>
			<p> Save, organize, and 
				discover interesting links on the web. 
				Instantly save what's most important to you. 
				Connect to others to checkout what they have saved.</p>
			<p> On Web BookMark, you can save your favorite links. You can checkout other's links and add their links to your list. You can follow the users for their every day updates. </p>
			<h3>
				<a href="/users/signup">Sign up for <span class="glyphicon glyphicon-bookmark"></span>Web BookMark</a>. 
			</h3>
		<?php endif; ?>
	</div><!-- / .col-xs-12 .col-sm-12 .col-md-12 -->
</div><!-- / .row -->
