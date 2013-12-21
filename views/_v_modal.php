<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Add Link</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="/bookmarks/p_add" id="addLink">
			
			<!-- URL input -->
			<label for="url">URL</label>
			<input class="form-control" size="50" max="250"  placeholder="url" id="url" type="text" name="url" required><br/>
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
				<button  type="submit" class="btn btn-primary">Add Link</button>
			</div>
		</form>
      </div>
      <div class="modal-footer">
       <span>&copy; Web BookMark 2013, All rights reserved.</span>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->










 
