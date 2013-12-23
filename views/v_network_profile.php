<!-- No user has been defined
================================== -->
<?php if(!isset($email)):?>
	<div class="feed-danger-display">
		<h4>No User has been defined.</h4>
	</div>
<?php endif;?>

<!-- Email does not exist
================================== -->
<?php if(count($profile) == 0): ?>
	<div class="feed-profile-display">
		<h4>Invaild email</h4>
		<blockquote>
			<p>This user does not exist. Please check <a href="/users/findfriends">@Connection</a>.</p>
		</blockquote>
	</div>

<!-- Email exists
================================== -->
<?php else: ?>	
	<div class="row">
		<div class="col-md-offset-2 col-xs-12 col-sm-10 col-md-8">	
		
			<!-- No Profile Links 
			================================== -->
			<?php if(count($bookmarks) == 0): ?>
				
				<!-- Search Is set show search bar for zero links
				================================== -->
				<?php if(isset($_POST['search'])): ?>
					<div class="pull-right">
						<form method="post" action="/network/profile/<?=$profile[$email]['email'];?>">
							<input type="text" name="search" id="search" placeholder="Search Keywords" />
							<button type="submit" class="btn btn-default">Go</button>
							<p id="searchError"></p>
						</form>
					</div>
				<?php endif; ?>
				
				<div class="feed-danger-display">
					<h1><?php echo $profile[$email]['first_name'];?> <?php echo $profile[$email]['last_name'];?><br/>
						<small><?php echo $profile[$email]['email'];?></small>
					</h1>
					<p>
						<b><?=count($bookmarks);?></b> <small>links</small>&nbsp;&nbsp;
						<b><?php echo (count($connections));?></b> <small>following</small>&nbsp;&nbsp; 
						<b><?php echo (count($follower));?></b> <small>follower</small> 
					</p><br/>
					
					<div class="pull-right">
						<p><a href="/users/findfriends"> &#171; Go back to Connections</a></p>
					</div>
					
					<!-- Search Is not set and there is no link, Show this message
					================================== -->
					<?php if(!isset($_POST['search'])): ?>
						<br/><br/>
						<h4>No link added</h4>
						<blockquote>
							<p>There's no activity in <?=$profile[$email]['first_name'];?>'s  account.</p>
						</blockquote>
					
					<!-- Search is set and there is no link, Show this message
					================================== -->	
					<?php else: ?>
						<div class="pull-left">
							<p><a href="/network/profile/<?=$profile[$email]['email'];?>">Show all</a></p>
						</div><br/><br/>
						<h4>No Match Found !!!</h4>
						<blockquote>
							<p>Refine your search. 
								TIPS: Use key words to search. 
								You can search by Link's Title, URL or Description.</p>
						</blockquote>
					<?php endif; ?>
				</div>	
			<?php endif; ?>
		
			<!-- There is one or more than one links, Display this.
			================================== -->
			<?php if(count($bookmarks) > 0): ?>
				<div class="pull-right">
					<form method="post" action="/network/profile/<?=$profile[$email]['email'];?>">
						<input type="text" name="search" id="search" placeholder="Search Keywords" />
						<button type="submit" class="btn btn-default">Go</button>
						<p id="searchError"></p>
					</form>
				</div>
				<div class="profile-display">
					<h1><?php echo $profile[$email]['first_name'];?> <?php echo $profile[$email]['last_name'];?><br/>
						<small><?php echo $profile[$email]['email'];?></small>
					</h1>
					<p>
						<b><?=count($bookmarks);?></b> <small>links</small>&nbsp;&nbsp;
						<b><?php echo (count($connections));?></b> <small>following</small>&nbsp;&nbsp; 
						<b><?php echo (count($follower));?></b> <small>follower</small> 
					</p><br/>
					
					<div class="pull-right">
						<p><a href="/users/findfriends"> &#171; Go back to Connections</a></p>
					</div>
					
					<div class="pull-left">
						<p><a href="/network/profile/<?=$profile[$email]['email'];?>">Show all</a></p>
					</div>
				</div>	
			<?php endif; ?>
		
			<!-- Show Links 
			=========================================== -->
			<?php foreach($bookmarks as $bookmark): ?>
			
				<!-- Remove http:// and end slash from url
				================================== -->
				<?php $url_print = $bookmark['url'];
					$url_print = str_replace(array('http://','https://','www.'), '', $url_print);
					$url_print = rtrim($url_print, "/");
				?>
				
				<div class="feed-profile-display">
					<h4><a href="<?=$bookmark['url']?>" target="_blank"><?=$bookmark['title']?> <span class="url-print"><?=$url_print;?></a></h4>
					<blockquote>
						<p><?=$bookmark['notes']?></p>
						<time datetime="<?=Time::display($bookmark['created'],'Y-m-d')?>">
							<?=Time::display($bookmark['created'],'Y-m-d g:i a')?>
						</time>
					</blockquote>
					
					<div class="text-right delete-btn">
						<a  class="btn btn-default btn-sm" href="/network/addLinkProfile/<?=$bookmark['bookmark_id']?>">Add Link</a>
					</div>		
				</div> <!-- / .feed-display -->
			<?php endforeach;?>
		</div><!-- /.col-md-offset-2 .col-xs-12 .col-sm-10 .col-md-8 -->
	</div><!-- / .row -->	
<?php endif; ?>



