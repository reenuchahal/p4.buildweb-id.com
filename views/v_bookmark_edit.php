<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<a class="close" href="/bookmarks/cancelEdit/">&times;</a>
			<h4>Edit BookMark</h4>
		</div>
		<div class="modal-body">
			<form method="post" action="/bookmarks/p_edit/<?php if(isset ($bookmark[0]['bookmark_id'])): ?><?=$bookmark[0]['bookmark_id']?><?php endif;?>" id="editLink">
			
				<!-- URL input -->
				<label for="urlEdit">URL</label>
				<input class="form-control" size="50" value="<?php if(isset ($bookmark[0]['url'])): ?><?=$bookmark[0]['url']?><?php endif;?>" placeholder="url" id="urlEdit" type="text" name="url" required><br/>
				<p class="urlError"></p>
				
				<!-- Title input -->
				<label for="titleEdit">Title</label>
				<input class="form-control" size="50" value="<?php if(isset ($bookmark[0]['title'])): ?><?=$bookmark[0]['title']?><?php endif;?>" placeholder="title" id="titleEdit" type="text" name="title" required><br/>
				<p class="titleError"></p>
				
				<!-- Comment Textarea -->
				<label for='notesEdit'>Comment</label><br>
				<textarea class="form-control" rows="3" name='notes' id='notesEdit' placeholder="What's your comment?" required><?php if(isset ($bookmark[0]['notes'])): ?><?=$bookmark[0]['notes']?><?php endif;?></textarea><br/>
				<p class="notesError"></p>
							 
				<div class="text-right">
					<button  type="submit" class="btn btn-success btn-sm">Update Link</button>&nbsp;&nbsp;
					<a class="btn btn-default btn-sm cancel" data-dismiss="modal" aria-hidden="true" href="/bookmarks/cancelEdit/">Cancel</a>
				</div>
			</form>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->

