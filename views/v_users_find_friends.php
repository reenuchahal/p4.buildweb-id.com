<div class="row">
	<div class="col-md-offset-2 col-sm-offset-2 col-xs-12 col-sm-8 col-md-8">
		
		<h1>Find a Connection <br/> 
			<small><?=$user->first_name;?> <?=$user->last_name;?> (<?php echo (count($connections)-1);?>)</small>
		</h1>
		
		<table class="table table-hover">
		
			<!-- Set variable for logged in user -->
			<?php $loggedInUser = $user->user_id; ?>
			
			<?php foreach($users as $user): ?>
				<tr <?php if ($loggedInUser == $user['user_id']): ?> class="display-none" <?php endif; ?>>
					<td class="follow-width"><?=$user['first_name']?> <?=$user['last_name']?><td>
					
					<td class="follow-width">
						
						<!-- If there exists a connection with this user, show a unfollow link -->
						<?php if(isset($connections[$user['user_id']])): ?>
							<a href='/posts/unfollow/<?=$user['user_id']?>' class="btn btn-danger">Unfollow</a>
						
						<!-- Otherwise, show the follow link -->
						<?php else: ?>
							<a href='/posts/follow/<?=$user['user_id']?>' class="btn btn-success">Follow</a>
						<?php endif; ?>
						
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		
	</div> <!-- / .col-md-offset-2 .col-sm-offset-2 .col-xs-12 .col-sm-8 .col-md-8 -->
</div> <!-- / .row -->