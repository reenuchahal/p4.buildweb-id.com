<div class="row">
	<div class="col-md-offset-2 col-xs-12 col-sm-10 col-md-8">
		
		<?php if(count($bookmarks) == 0 & !isset($_POST['search'])): ?>
			<h1>My NetWork</h1><br/>
		<?php endif; ?>
		
		<?php if(count($bookmarks) > 0 or (count($bookmarks) == 0 & isset($_POST['search']))): ?>
			<div class="pull-right">
				<form method="post" action="/network/links">
					<input type="text" name="search" id="search" placeholder="Search Keywords" />
					<button type="submit" class="btn btn-default">Go</button>
					<p id="searchError"></p>
				</form>
			</div>
		
			<h1>My NetWork</h1><br/>
			
			<div class="pull-right">
				<p>+<a href="/users/findfriends"> Add New Connection</a></p>
			</div>
			
			<div class="pull-left">
				<p><a href="/network/links">Show all</a></p>
			</div>
		<?php endif; ?>
		<br/>
		
	</div> <!-- / .col-md-offset-2 .col-xs-12 .col-sm-10 .col-md-8  -->
</div> <!-- / .row -->

<div class="row">
	<div class="col-md-offset-2 col-xs-12 col-sm-10 col-md-8">
	
		<!-- Show this if there is/are bookmark/s
		=========================================== -->
		<?php if(count($bookmarks) == 0): ?>
		
			<?php if(!isset($_POST['search'])): ?>
				<div class="feed-danger-display">
					<h4> Web Bookmark is more fun with friends.  <a href="/users/findfriends">Find my friends.</a></h4>
					<blockquote>
						<p>There's no activity in your network. Try to <a href="/users/findfriends">find some friends</a> on Web BookMark.</p>
					</blockquote>
				</div>
				
			<?php else: ?>
				<div class="feed-danger-display">
					<h4>No Match Found!!!</h4>
					<blockquote>
						<p>Refine your search. 
							TIPS: Use key words to search. 
							You can search by connection's first Name, Last Name, Title, link description.</p>
					</blockquote>
				</div>
			<?php endif; ?>
			
		<?php endif; ?>	
	</div> <!-- / .col-md-offset-2 .col-xs-12 .col-sm-10 .col-md-8  -->
</div> <!-- / .row -->
		
<div class="row">
	<div class="col-md-offset-2 col-xs-12 col-sm-10 col-md-8">
		<?php foreach($bookmarks as $bookmark): ?>
		
			<!-- Remove url http:// and end slash -->
			<?php $url_print = $bookmark['url'];
				$url_print = str_replace(array('http://','https://','www.'), '', $url_print);
				$url_print = rtrim($url_print, "/");
			?>
			
			<div class="feed-network-display">
			
			  	<h4><a href="/network/profile/<?=$bookmark['email']?>"><?=$bookmark['first_name']?> <?=$bookmark['last_name']?></a></h4>
				<blockquote>
					<p><?=$bookmark['notes']?></p>
					<p><a href="<?=$bookmark['url']?>" target="_blank"><?=$bookmark['title']?> <span class="url-print"><?=$url_print;?></span></a></p>
					<time datetime="<?=Time::display($bookmark['created'],'Y-m-d')?>">
						<?=Time::display($bookmark['created'],'Y-m-d g:i a')?>
					</time>
				</blockquote>
				
				<div class="text-right delete-btn">
					<?php if(isset($likes[$bookmark['bookmark_id']])): ?>
						<a href='/network/unlike/<?=$bookmark['bookmark_id']?>' class="btn btn-default btn-xs">Unlike</a>
					<?php else: ?>			
						<a href='/network/like/<?=$bookmark['bookmark_id']?>' class="btn btn-default btn-xs">Like</a>
					<?php endif; ?>
					
					<?php if(isset($count[$bookmark['bookmark_id']]['count'])): ?>
					 	<img src="/uploads/Facebook-Thumbs-Up.jpg" alt="facebook thumbs up"/> (<?php echo $count[$bookmark['bookmark_id']]['count'] ?>)
					<?php endif; ?>
					
					<a data-toggle="modal" data-target="#myModalAddLink"  class="btn btn-default btn-xs" >Add Link</a>
				</div><!-- / .text-right -->
				
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
								<input class="form-control" size="50" value="<?=$bookmark['url']?>" placeholder="url" id="url" type="text" name="url" required><br/>
								<p id="urlError"></p>
								
								<!-- Title input -->
								<label for="title">Title</label>
								<input class="form-control" size="50" placeholder="title" id="title" type="text" name="title" required><br/>
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
	</div> <!-- / .col-md-offset-2 .col-xs-12 .col-sm-10 .col-md-8 -->
</div> <!-- / .row -->
