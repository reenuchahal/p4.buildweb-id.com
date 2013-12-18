<!-- Recover Password Email Message for User -->
<div style="background-color:#f6f6f6; padding: 20px; margin-top:10px; border: 1px solid f6f6f6; border-radius:10px">
	<h3>forgot your password?</h3>
	<h4>Your Email address: <?=$_POST['email'];?></h4>
	
	<p> 
		Click on this link to reset your password<br/>
		<a href="http://p4.buildweb-id.com/users/reset_password/<?=$_POST['email'];?>/<?=$token?>">http://p4.buildweb-id.com/users/reset_password/<?=$_POST['email'];?>/<?=$token?></a>
		
		<br/><br/>
	
		Have a Great Web BookMark with your friends.
		<br/><br/><br/>
	
		~ Web BookMark Team
	</p>
</div> <!-- / div -->
