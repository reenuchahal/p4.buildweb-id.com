<div class="row">
	<div class="col-md-offset-2 col-xs-12 col-sm-10 col-md-8">
	
		<!-- Show if there is no pook marks and search is not set
		=========================================== -->
		<?php if(count($bookmarks) == 0 & !isset($_POST['search'])): ?>
			<h1><?=$user->first_name;?> <?=$user->last_name;?></h1>
			<p>
				<b><?=count($bookmarks);?></b> <small>links</small>&nbsp;&nbsp;
				<b><?php echo (count($connections));?></b> <small>following</small>&nbsp;&nbsp; 
				<b><?php echo (count($follower));?></b> <small>follower</small> 
			</p> 
			<br/>
		<?php endif; ?>
		
		<!-- Show this if there is/are bookmark/s Or
			There is no bookmarks and search is set
		=========================================== -->
		<?php if(count($bookmarks) > 0 or (count($bookmarks) == 0 & isset($_POST['search']))): ?>
			<div class="pull-right">
				<form method="post" action="/bookmarks/myLinks">
					<input type="text" name="search" id="search" placeholder="Search Keywords" />
					<button type="submit" class="btn btn-default">Go</button>
					<p id="searchError"></p>
				</form>
			</div>
			
			<!-- LoggedIn User INFO
			=========================================== -->
			<h1><?=$user->first_name;?> <?=$user->last_name;?></h1>
			<p>
				<b><?=count($bookmarks);?></b> <small>links</small>&nbsp;&nbsp;
				<b><?php echo (count($connections));?></b> <small>following</small>&nbsp;&nbsp; 
				<b><?php echo (count($follower));?></b> <small>follower</small> 
			</p> 
			<br/>
			
			<div class="pull-right">
				<p>+<a data-toggle="modal" data-target="#myModal" href="#"> Add New Link</a></p>
			</div>
			
			<div class="pull-left">
				<p><a href="/bookmarks/myLinks">Show all</a></p>
			</div><br/><br/>
		<?php endif; ?>
		
		<!-- Show this if there is no bookmark
		=========================================== -->
		<?php if(count($bookmarks) == 0): ?>
			
			<!-- Show if search is not set
			=========================================== -->
	   		 <?php if(!isset($_POST['search'])): ?>
				<div class="feed-danger-display">
					<h4> Start by <a data-toggle="modal" data-target="#myModal" href="#">adding your first link</a></h4>
					<blockquote>
						<p>There's no activity in your account.</p>
					</blockquote>
				</div>	
			
			<!-- Show if search is set
			=========================================== -->	
			<?php else: ?>
				<div class="feed-danger-display">
					<h4>No Match Found!!!</h4>
					<blockquote>
						<p>Refine your search. 
						TIPS: Use key words to search. 
						You can search by Link's Title, URL or Description.
						</p>
					</blockquote>
				</div>
			<?php endif; ?>
		<?php endif; ?>
		
		<!-- Show Links 
		=========================================== -->
		<?php foreach($bookmarks as $bookmark): ?>
		
			<!-- Remove url http:// and end slash -->
			<?php $url_print = $bookmark['url'];
				$url_print = str_replace(array('http://','https://','www.'), '', $url_print);
				$url_print = rtrim($url_print, "/");
			?>
		
			<div class="feed-display">
				<h4><a href="<?=$bookmark['url']?>" target="_blank"><?=$bookmark['title']?> <span class="url-print"><?=$url_print;?></span></a></h4>
				<blockquote>
					<p><?=$bookmark['notes']?></p>
					<time datetime="<?=Time::display($bookmark['created'],'Y-m-d')?>">
						<?=Time::display($bookmark['created'],'Y-m-d g:i a')?>
					</time>
				</blockquote>
				
				<div class="text-right delete-btn">
					<a data-toggle="modal" data-target="#myModalDelete" class="btn btn-danger btn-sm">Delete</a>
					<a data-toggle="modal" data-target="#myModalEdit"  class="btn btn-default btn-sm">Edit</a>
				</div>		
			</div> <!-- / .feed-display -->
			
			<!-- Modal Delete
			=========================================== -->
			<div class="modal fade" id="myModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<p>Are you sure to delete this link?</p><br/>&nbsp;&nbsp;&nbsp;&nbsp;
							<a class="btn btn-danger btn-sm" href="/bookmarks/delete/<?=$bookmark['bookmark_id']?>">Delete</a>
							<a class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Cancel</a>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		
			<!-- Modal Edit
			 =========================================== -->
			<div class="modal fade" id="myModalEdit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-body">
							<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
							<form method="post" action="/bookmarks/edit/<?=$bookmark['bookmark_id']?>" id="addLink">
							
								<!-- URL input -->
								<label for="url">URL</label>
								<input class="form-control" size="50" value="<?=$bookmark['url']?>" placeholder="url" id="url" type="text" name="url" required><br/>
								<p id="urlError"></p>
								
								<!-- Title input -->
								<label for="title">Title</label>
								<input class="form-control" size="50" value="<?=$bookmark['title']?>" placeholder="title" id="title" type="text" name="title" required><br/>
								<p id="titleError"></p>
								
								<!-- Comment Textarea -->
								<label for='notes'>Comment</label><br>
								<textarea class="form-control" rows="3" name='notes' id='notes' placeholder="What's your comment?" required><?=$bookmark['notes']?></textarea><br/>
								<p id="notesError"></p>
											 
								<div class="text-right">
									<button  type="submit" class="btn btn-success btn-sm">Update Link</button>&nbsp;&nbsp;<a class="btn btn-default btn-sm" data-dismiss="modal" aria-hidden="true">Cancel</a>
								</div>
							</form>
						</div>
					</div><!-- /.modal-content -->
				</div><!-- /.modal-dialog -->
			</div><!-- /.modal -->
		<?php endforeach;?>
		
	</div> <!-- / .col-md-offset-2 .col-xs-12 .col-sm-10 .col-md-8 -->
</div> <!-- / .row -->




