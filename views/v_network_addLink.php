<div class="modal-dialog">
	<div class="modal-content">
		<div class="modal-body">
			<button type="button" class="close cancel" data-dismiss="modal" aria-hidden="true">&times;</button>
			<form method="post" action="/bookmarks/p_add" id="addLink">
			
				<!-- URL input -->
				<label for="url">URL</label>
				<input class="form-control" size="50" value="<?=$bookmark[0]['url']?>" placeholder="url" id="url" type="text" name="url" required><br/>
				<p class="urlError"></p>
				
				<!-- Title input -->
				<label for="title">Title</label>
				<input class="form-control" size="50" placeholder="title" id="title" type="text" name="title" required><br/>
				<p class="titleError"></p>
				
				<!-- Comment Textarea -->
				<label for='notes'>Comment</label><br>
				<textarea class="form-control" rows="3" name='notes' id='notes' placeholder="What's your comment?" required></textarea><br/>
				<p class="notesError"></p>
							 
				<div class="text-right">
					<button  type="submit" class="btn btn-success btn-sm"">Add Link</button>&nbsp;&nbsp;<a class="btn btn-default btn-sm cancel" data-dismiss="modal" aria-hidden="true">Cancel</a>
				</div>
			</form>
		</div>
	</div><!-- /.modal-content -->
</div><!-- /.modal-dialog -->
