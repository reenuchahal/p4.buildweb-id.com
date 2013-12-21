<div class="row">

	<div class="col-md-offset-1 col-xs-12 col-sm-5 col-md-5">
		<!-- If User upload an image -->
		<?php if($user->profile_image): ?>
			<img  class="img-responsive img-thumbnail" alt="<?=$user->first_name?>_profile_image" src="/uploads/avatars/<?=$user->profile_image?>" /><br/><br/>
		
		<!-- Default Image -->
		<?php else: ?>
			<img  class="img-responsive img-thumbnail" alt="placeholder_image" src="/uploads/placeholder_200_200.png" /><br/><br/>
		<?php endif; ?>
	</div><!-- / .col-md-offset-1 .col-xs-12 .col-sm-5 .col-md-5 -->
	
	<div class="col-md-offset-1 col-sm-offset-1 col-xs-6 col-sm-5 col-md-4" >
		<h1>Your Profile</h1><br/>
		<div id="profileInfo" class="show">
		<p>
			<b>Name:</b> <?=$user->first_name?>  <?=$user->last_name?><br/>
			<b>Email:</b> <?=$user->email?>
		</p><br/>
		<!-- If there is an error, Show this message -->
		<?php if(isset($error) & isset($unique_email_error)): ?>
			<p class="error">
				Someone else is using this email, Please use another email.
			</p>
		<?php endif; ?> 
	</div>
		<div id="profileInfoEdit" class="hidden">
			<form method="POST" action="/users/p_profileEdit" id="registrationForm">
	
				<!-- First Name input -->
				<label for="firstName">First Name</label>
				<input class="form-control" value="<?=$user->first_name?>" placeholder="First Name" id="firstName" type="text" name="first_name" required><br/>
				<p id="firstNameInfo"></p>
				
				<!-- Last Name input -->
				<label for="lastName">Last Name</label>
				<input class="form-control" value="<?=$user->last_name?>" placeholder="Last Name" id="lastName" type="text" name="last_name" required><br/>
				<p id="lastNameInfo"></p>
				
				<!-- Email input -->
				<label for="yourEmail">Email</label>
				<input class="form-control" value="<?=$user->email?>" placeholder="Your Email" id="yourEmail" type="text" name="email" required><br/>
				<p id="yourEmailInfo"></p>
				
				<!-- Password input -->
				<label for="yourPassword">Password</label>
				<input class="form-control" placeholder="Password" id="yourPassword" type="password" name="password" required><br/>
				<p id="yourPasswordInfo"></p>
				
				<button type="submit" class="btn btn-success" id="profileEditSave">Save</button>
				<a class="btn btn-danger" id="profileEditCancel">Cancel</a>
		
			</form>
			<br/><br/>
		</div>
			<button class="btn btn-warning show" id="profileEdit">Edit Profile</button><br/>
		<p>
			<b>Your Current Location </b><br/>
			<?=$location['city'];?>, <?=$location['state'];?>, <?=$location['country_code'];?>
		</p><br/>
		
		<form enctype="multipart/form-data" method="POST" action="/users/p_profile">
			<!-- Upload Image Here -->
			<label for="imageInputFile">Upload your profile image here</label>
			<input id="imageInputFile" type="file" name="profile_image" required><br/>
			
			<!-- If there is an erro show this -->
			<?php if(isset($error) & !isset($unique_email_error)): ?>
				<p class="error"> There was an error uploading the file, please try again!</p>
			<?php endif; ?>
			
			<button type="submit" class="btn btn-default">Upload</button><br/><br/><br/>
		</form>
	</div> <!-- / .col-md-offset-1 .col-sm-offset-1 .col-xs-6 .col-sm-5 .col-md-4 -->	

</div> <!-- / .row -->
  
                       




