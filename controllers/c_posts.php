<?php
class posts_controller extends base_controller {
	
	public function __construct() {
		
		parent::__construct();
		
		#Make sure user is logged in if they want to anythning in this controller
		if (!$this->user) {
			
			# Route to login Page
			Router::redirect("/users/login/");
		}
	}
	
	public function index() {
	
		# Route to posts/add page
		Router::redirect("/posts/add");
	}
	
	public function add($error = NULL) {
		
		# Setup View
		$this->template->content = View::instance('v_posts_add');
		$this->template->title = "News Feed";
		
		# Build the Query to find out user is following himself
		$q = "SELECT user_id
			FROM users_users
			WHERE user_id = '".$this->user->user_id."'
			AND user_id_followed = '".$this->user->user_id."'
			";
		
		# Find Match
		$my_user_id = DB::instance(DB_NAME)->select_field($q);
		
		# If we do not find a matching user id in the database.
		#  Insert following information
		if(!$my_user_id) {
			
			# Make the user to follow himself.
			# Prepare the data array to be inserted
			$data = Array(
				"created" => Time::now(),
				"user_id" => $this->user->user_id,
				"user_id_followed" => $this->user->user_id
			);
				
			# Do the insert, user will follow his status by default
			DB::instance(DB_NAME)->insert('users_users', $data);
		}
			
		#Build the Query
		$q ='SELECT posts.post_id,
					posts.content,
					posts.created,
					posts.user_id AS post_user_id,
					users_users.user_id AS follower_id,
					users.first_name,
					users.last_name
			FROM posts
			INNER JOIN users_users
			ON posts.user_id = users_users.user_id_followed
			INNER JOIN users
			ON posts.user_id = users.user_id
			WHERE users_users.user_id = '.$this->user->user_id.' 
			ORDER BY posts.created DESC';
	
		#Run the Query
		$posts = DB::instance(DB_NAME)->select_rows($q);
		
		#Build the Query for Post Connection
		$q = "SELECT post_id
			FROM likes
			WHERE user_id ='".$this->user->user_id."'
			";
		
		# Store our results (an array) in the variable $connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'post_id');
		
		
		#Build the Query to count the number of likes for posts
		$q = "SELECT post_id, count(post_id) as count
			FROM likes
			GROUP BY post_id
			ORDER BY 1";
		
		# Store our results (an array) in the variable $count
		$count = DB::instance(DB_NAME)->select_array($q, 'post_id');
		
		# Pass data to the view
		$this->template->content->posts = $posts;
		$this->template->content->connections = $connections;
		$this->template->content->count = $count;
		
		# Set Error
		$this->template->content->error = $error;
		
		# Render the view
		echo $this->template;
	}
	
	public function p_add() {
		
		# check for empty content
		if ($_POST['content'] == NULL ) {
		
			# Show error
			Router::redirect("/posts/add/error");
		}
		
		# Associate this post with this user
		$_POST['user_id'] = $this->user->user_id;
		
		#Unic timestamp of when this posts was created and modified
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
		
		#Insert 
		DB::instance(DB_NAME)->insert('posts', $_POST);
		
		# Route to login Page
		Router::redirect("/posts/add/");
	}
	
	public function follow($user_id_followed) {
		
		#Prepare the data array to be inserted
		$data = Array(
			"created" => Time::now(),
			"user_id" => $this->user->user_id,
			"user_id_followed" => $user_id_followed
		);
		
		# Do the insert
		DB::instance(DB_NAME)->insert('users_users', $data);
		
		# Send them back
		Router::redirect("/users/findfriends");
	}
	
	public function unfollow($user_id_followed) {
	
		# Delete this connection
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
		DB::instance(DB_NAME)->delete('users_users', $where_condition);
	
		# Send them back
		Router::redirect("/users/findfriends");
	}
	
	public function delete($post_id_delete) {
		
		# Delete this connection
		$where_condition = 'WHERE post_id = '.$post_id_delete;
		DB::instance(DB_NAME)->delete('posts', $where_condition);
		
		# Send them back
		Router::redirect("/posts/add");
	}
	
	public function like($post_id_like) {
		
		#Prepare the data array to be inserted
		$data = Array(
			"liked" => Time::now(),
			"user_id" => $this->user->user_id,
			"post_id" => $post_id_like
		);
	
		# Insert Like this connection
		DB::instance(DB_NAME)->insert('likes', $data);
		

		# Send them back
		Router::redirect("/posts/add");
	}
	
	public function unlike($post_id_like) {
	
		# Delete this connection
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND post_id = '.$post_id_like;
		DB::instance(DB_NAME)->delete('likes', $where_condition);
	
		# Send them back
		Router::redirect("/posts/add");
	}
	
	
	public function edit($post_id_edit) {
		
		#Build the Query
		$q = "SELECT content
			FROM posts
			WHERE post_id = '".$post_id_edit."'
			";
  		
  		#Run the Query
  		$edit_content = DB::instance(DB_NAME)->select_rows($q);
  	
  		# Setup View and pass data to the view
  		$this->template->content = View::instance('v_posts_edit');
  		$this->template->title = "Edit Your Post";
  		$this->template->content->edit_content = $edit_content[0]['content'];
  		$this->template->content->post_id_edit = $post_id_edit;
  		
  		# Render the view
  		echo $this->template;
  	}	
  
	public function p_edit($post_id_edit){
		
		# check for empty content
		if ($_POST['content'] == NULL ) {
		
			# Show error
			Router::redirect("/posts/add/");
		}
		
		# Prevent SQL injection attacks by sanitizing the data the user entered in the form
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		#Build the Query
		$q = "UPDATE posts
			SET content = '".$_POST['content']."',
			modified = '".Time::now()."'
			WHERE post_id = '".$post_id_edit."'
			";
  	
  		# Run the command
  		DB::instance(DB_NAME)->query($q);
  		
  		# Route to profile page
  		Router::redirect("/posts/add");
  }
  
}

