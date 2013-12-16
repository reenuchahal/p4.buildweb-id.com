<!-- Welcome Email Message for User -->
<div style="background-color:#f6f6f6; padding: 20px; margin-top:10px; border: 1px solid f6f6f6; border-radius:10px">
	<h3>Hello <?=$_POST['first_name'];?> <?=$_POST['last_name'];?>,</h3>
	<?=$_POST['email'];?>
	<?=$token?>
	<?php 
	echo $token;
	?>
	<p> 
		Thank you for signing up at ChitChat. Your may login to 
		<a href="http://p4.buildweb-id.com/users/login/">Web BooKMark</a> 
		Using the following email:
		<br/><br/>
		Click on this link to activate your account:<br/>
		<a href="http://p4.buildweb-id.com/users/verify/email='.<?=$_POST['email'];?>.'&token='.<?=$token?>.'">http://p4.buildweb-id.com/users/verify/email='.<?=$_POST['email'];?>.'&token='.<?=$token?>.'</a>
		<a href="http://p4.buildweb-id.com/users/verify/token='.<?=$token?>.'">http://p4.buildweb-id.com/users/verify/token='.<?=$token?>.'</a>
		Email: <?=$_POST['email'];?>
		<br/><br/>
	
		Have a Great Web BookMark with your friends.
		<br/><br/><br/>
	
		~ Web BookMark Team
	</p>
</div> <!-- / div -->
