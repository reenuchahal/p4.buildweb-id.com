<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-header">
			<a class="close"  href="/network/cancelAddLink/">&times;</a>
			<h4>Add Link to your list</h4>
		</div>
		<div class="modal-body">
			<form method="post" action="/bookmarks/p_add" id="editLink">
			
				<!-- URL input -->
				<label for="urlEdit">URL</label>
				<input class="form-control" size="50" value="<?php if(isset($bookmark[0]['url'])): ?><?=$bookmark[0]['url']?><?php endif;?>" placeholder="url" id="urlEdit" type="text" name="url" required><br/>
				<p class="urlError"></p>
				
				<!-- Title input -->
				<label for="titleEdit">Title</label>
				<input class="form-control" size="50" placeholder="title" id="titleEdit" type="text" name="title" required><br/>
				<p class="titleError"></p>
				
				<!-- Comment Textarea -->
				<label for='notesEdit'>Comment</label><br>
				<textarea class="form-control" rows="3" name='notes' id='notesEdit' placeholder="What's your comment?" required></textarea><br/>
				<p class="notesError"></p>
							 
				<div class="text-right">
					<button  type="submit" class="btn btn-success btn-sm" >Add Link</button>&nbsp;&nbsp;
					<a class="btn btn-default btn-sm cancel" href="/network/cancelAddLink/">Cancel</a>
				</div>
			</form>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
