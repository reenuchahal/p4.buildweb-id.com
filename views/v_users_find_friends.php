<div class="row">
	<div class="col-md-offset-2 col-sm-offset-2 col-xs-12 col-sm-8 col-md-8">
		<div class="pull-right">
			<form method="post" action="/users/findfriends/">
				<input type="text" name="search" id="search" placeholder="Search Keywords" />
				<button type="submit" class="btn btn-default">Go</button>
				<p id="searchError"></p>
			</form>
		</div>
		
		<h1>Find a Connection <br/> 
			<small><?=$user->first_name;?> <?=$user->last_name;?> (<?php echo (count($connections));?>)</small>
		</h1><br/>
		
		<?php if(count($connections) == 0): ?>
			<div class="feed-danger-display">
				<h4> No Connection Yet.</a></h4>
				<blockquote>
					<p>You are not connected with others. Follow a user to connect with them.</p>
				</blockquote>
			</div>	
		<?php endif; ?>	
		
		<h4 class="pull-right"><a href="/users/findfriends">Show all</a></h4>
		<h3>People You May Know </h3>
		
		<?php if(count($users) == 0 ): ?>
			<div class="feed-danger-display">
				<h4> Wrong Name</a></h4>
				<blockquote>
					<p>I am sorry!!! No user of this name exists. </p>
				</blockquote>
			</div>	
		<?php endif; ?>	
		
		<?php $loggedInUser = $user->user_id; ?>
		
		<?php if(count($users) == 1 ): ?>
			<?php foreach($users as $user): ?>
				<?php if ($loggedInUser == $user['user_id']): ?> 
					<div class="feed-danger-display">
						<h4>Only one match found that's you!</a></h4>
						<blockquote>
							<p>Are you searching for yourself? <br/>
								<?=$user['first_name']?> <?=$user['last_name']?>, there is no other user that has same name.
							</p>
						</blockquote>
					</div>	
				<?php endif; ?>
			<?php endforeach; ?>
		<?php endif; ?>	
		
		<table class="table table-hover">
			<!-- Set variable for logged in user -->
			<?php foreach($users as $user): ?>
				<tr <?php if ($loggedInUser == $user['user_id']): ?> class="display-none" <?php endif; ?>>
					<td class="follow-width"><a href="/network/profile/<?=$user['email']?>"><?=$user['first_name']?> <?=$user['last_name']?></a><td>
					
					<td class="follow-width">
						
						<!-- If there exists a connection with this user, show a unfollow link -->
						<?php if(isset($connections[$user['user_id']])): ?>
							<a href='/users/unfollow/<?=$user['user_id']?>' class="btn btn-danger">Unfollow</a>
						
						<!-- Otherwise, show the follow link -->
						<?php else: ?>
							<a href='/users/follow/<?=$user['user_id']?>' class="btn btn-success">Follow</a>
						<?php endif; ?>
						
					</td>
				</tr>
			<?php endforeach; ?>
		</table>
		
	</div> <!-- / .col-md-offset-2 .col-sm-offset-2 .col-xs-12 .col-sm-8 .col-md-8 -->
</div> <!-- / .row -->