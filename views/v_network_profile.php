<?php if(count($profile) == 0): ?>
	<div class="feed-profile-display">
		<h4>Invaild email</h4>
		<blockquote>
			<p>This user does not exist. Please check <a href="/users/findfriends">@Connection</a>.</p>
		</blockquote>
	</div>
<?php else: ?>	
	
	<div class="row">
		<div class="col-md-offset-2 col-xs-12 col-sm-10 col-md-8">	
		<?php if(count($profile_links) == 0): ?>
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
				<p><b><?=count($profile_links);?></b> <small>links</small>&nbsp;&nbsp;
				<b><?php echo (count($connections));?></b> <small>following</small>&nbsp;&nbsp; 
				<b><?php echo (count($follower));?></b> <small>follower</small> </p> <br/>
				<div class="pull-right">
					<p><a href="/users/findfriends"> &#171; Go back to Connections</a></p>
				</div>
				<?php if(!isset($_POST['search'])): ?>
					<br/><br/>
					<h4>No link added</h4>
					<blockquote>
						<p>There's no activity in <?=$profile[$email]['first_name'];?>'s  account.</p>
					</blockquote>
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
		
		<?php if(count($profile_links) > 0): ?>
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
				<p><b><?=count($profile_links);?></b> <small>links</small>&nbsp;&nbsp;
				<b><?php echo (count($connections));?></b> <small>following</small>&nbsp;&nbsp; 
				<b><?php echo (count($follower));?></b> <small>follower</small> </p> <br/>
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
		<?php foreach($profile_links as $profile_link): ?>
			<?php $url_print = $profile_link['url'];
				$url_print = str_replace(array('http://','https://','www.'), '', $url_print);
				$url_print = rtrim($url_print, "/");
			?>
			<div class="feed-profile-display">
				<h4><a href="<?=$profile_link['url']?>" target="_blank"><?=$profile_link['title']?> <span class="url-print"><?=$url_print;?></a></h4>
				<blockquote>
					<p><?=$profile_link['notes']?></p>
					<time datetime="<?=Time::display($profile_link['created'],'Y-m-d')?>">
						<?=Time::display($profile_link['created'],'Y-m-d g:i a')?>
					</time>
				</blockquote>
				
				<div class="text-right delete-btn">
					<a data-toggle="modal" data-target="#myModalAddLink"  class="btn btn-default btn-sm" >Add Link</a>
				</div>		
			</div> <!-- / .feed-display -->
			
			<!-- Modal Add Link
			 =========================================== -->
			<div class="modal fade" id="myModalAddLink" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<form method="post" action="/bookmarks/p_add" id="addLink">
							
								<!-- URL input -->
								<label for="url">URL</label>
								<input class="form-control" size="50" max="250" value="<?=$profile_link['url']?>" placeholder="url" id="url" type="text" name="url" required><br/>
								<p id="urlError"></p>
								
								<!-- Title input -->
								<label for="title">Title</label>
								<input class="form-control" size="50" max="250"  placeholder="title" id="title" type="text" name="title" required><br/>
								<p id="titleError"></p>
								
								<!-- Comment Textarea -->
								<label for='notes'>Comment</label><br>
								<textarea class="form-control" rows="3" name='notes' id='notes' placeholder="What's your comment?" required></textarea><br/>
								<p id="notesError"></p>
											 
								<div class="text-right">
									<button  type="submit" class="btn btn-success btn-sm"">Add Link</button>&nbsp;&nbsp;<a class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Cancel</a>
								</div>
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		<?php endforeach;?>
		</div>
	</div>	
<?php endif; ?>

