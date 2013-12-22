<!-- Welcome Email Message for User -->
<div style="background-color:#f6f6f6; padding: 20px; margin-top:10px; border: 1px solid f6f6f6; border-radius:10px">
	<h3>Hello <?=$_POST['first_name'];?> <?=$_POST['last_name'];?>,</h3>
	<?=$_POST['email'];?>
	
	<p> 
		Thank you for signing up at Web BookMark.<br/><br/> 
		
		Click on this link to activate your account:<br/>
		<a href="http://p4.buildweb-id.com/users/verify/<?=$_POST['email'];?>/<?=$token?>">http://p4.buildweb-id.com/users/verify/<?=$_POST['email'];?>/<?=$token?></a>
		<br/><br/>
		
		After activation of your account, you may login to 
		<a href="http://p4.buildweb-id.com/users/login/">Web BooKMark</a> 
		using the following email-<br/>
		Email: <?=$_POST['email'];?>
		<br/><br/>
		
		Have a Great Web BookMarking with other members.
		<br/><br/><br/>
	
		~ Web BookMark Team
	</p>
</div> <!-- / div -->
