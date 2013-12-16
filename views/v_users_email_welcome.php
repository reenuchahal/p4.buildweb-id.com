<!-- Welcome Email Message for User -->
<div style="background-color:#f6f6f6; padding: 20px; margin-top:10px; border: 1px solid f6f6f6; border-radius:10px">
	<h3>Hello <?=$_POST['first_name'];?> <?=$_POST['last_name'];?>,</h3>
	<p> 
		Thank you for signing up at ChitChat. Your may login to 
		<a href="http://p2.buildweb-id.com/users/login/">ChitChat</a> 
		Using the following email:
		<br/><br/>
		
		Email: <?=$_POST['email'];?>
		<br/><br/>
	
		Have a Great ChitChat with your friends.
		<br/><br/><br/>
	
		~ ChitChat Team
	</p>
</div> <!-- / div -->
