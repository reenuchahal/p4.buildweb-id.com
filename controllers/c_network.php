<?php
class network_controller extends base_controller {
	
	public function __construct() {
		
		parent::__construct();
	
		#Make sure user is logged in if they want to anythning in this controller
		if (!$this->user) {
			
			# Route to login Page
			Router::redirect("/users/login/");
		}
		
	} # End of method
	
	public function links() {
		
		# Do the following, if search is set
		if(isset($_POST['search'])) {
		
			# Sanitize the user entered data
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
			# Set Variable
			$string = $_POST['search'];
		
			#trim empty space and Tags
			$string = trim(strip_tags($string));
		
			# Explode in words
			$arr_q = explode(' ', $string);
		
			# make a loop for query
			foreach ($arr_q as $key=>$word) {
				
				$arr_q[$key] = " (a.title LIKE '%".$word."%' OR a.url LIKE '%".$word."%' OR a.notes LIKE '%".$word."%' OR c.first_name LIKE '%".$word."%' OR c.last_name LIKE '%".$word."%') ";
			}
		
			# Build the query
			$q ="SELECT a.bookmark_id,
				a.notes,
				a.created,
				a.title,
				a.url,
				a.user_id AS bookmark_user_id,
				b.user_id AS follower_id,
				c.first_name,
				c.last_name,
				c.email
				FROM user_bookmarks a
				INNER JOIN users_users b
				ON a.user_id = b.user_id_followed
				INNER JOIN users c
				ON a.user_id = c.user_id
				WHERE b.user_id = '".$this->user->user_id."'
				AND  " . implode(' OR ', $arr_q) . " 
				ORDER BY a.created DESC";
			
			//echo $query;
			$bookmarks = DB::instance(DB_NAME)->select_rows($q);

		# Do the following, if search is not set
		} else {
		
			#Build the Query
			$q ='SELECT a.bookmark_id,
				a.notes,
				a.created,
				a.title,
				a.url,
				a.user_id AS bookmark_user_id,
				b.user_id AS follower_id,
				c.first_name,
				c.last_name,
				c.email
				FROM user_bookmarks a
				INNER JOIN users_users b
				ON a.user_id = b.user_id_followed
				INNER JOIN users c
				ON a.user_id = c.user_id
				WHERE b.user_id = '.$this->user->user_id.'
				ORDER BY a.created DESC';
		
			#Run the Query
			$bookmarks = DB::instance(DB_NAME)->select_rows($q);
		}
		
		#Build the Query for Post Connection
		$q = "SELECT bookmark_id
			FROM likes
			WHERE user_id ='".$this->user->user_id."'
				";
		# Store our results (an array) in the variable $connections
		$likes = DB::instance(DB_NAME)->select_array($q, 'bookmark_id');

		#Build the Query to count the number of likes for posts
		$q = "SELECT bookmark_id, count(bookmark_id) as count
			FROM likes
			GROUP BY bookmark_id
			ORDER BY 1";
	
		# Store our results (an array) in the variable $count
		$count = DB::instance(DB_NAME)->select_array($q, 'bookmark_id');
	
		# Setup View
		$this->template->content = View::instance('v_network_links');
		$this->template->title = "My Network";
		
		# Pass data to the view
		$this->template->content->bookmarks = $bookmarks;
		$this->template->content->likes = $likes;
		$this->template->content->count = $count;

		# Render the view
		echo $this->template;
	
	} # End of method
	
	public function addLink($bookmark_id_add) {
		
		# Set Query to get bookMarks for the logged In use
		$q = "SELECT * FROM user_bookmarks
					WHERE bookmark_id = '".$bookmark_id_add."'
					";
		
		# Run the command and store it as variable
		$bookmark = DB::instance(DB_NAME)->select_rows($q );
		
		# add this css in head
		$this->template->client_files_head = '<link rel="stylesheet" href="/css/footer-hide.css" type="text/css">';
		
		# Set the view and variables
		$this->template->content = View::instance('v_network_addLink');
		$this->template->title = "Add Link";
		$this->template->content->bookmark = $bookmark;
		
		# Render the template
		echo $this->template;
		
	} # End of method
	
	public function profile($email) {
		
		# Set Query
		$q= "SELECT first_name, last_name, email
			From users
			WHERE email = '".$email."'
			";
		
		# Store our results (an array) in the variable $profile
		$profile= DB::instance(DB_NAME)->select_array($q, 'email');
		
		# Do the following, if search is set
		if(isset($_POST['search'])) {
		
			# Sanitize the user entered data
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
			# Set Variable
			$string = $_POST['search'];
		
			#trim empty space and Tags
			$string = trim(strip_tags($string));
		
			# Explode in words
			$arr_q = explode(' ', $string);
		
			# make a loop for query
			foreach ($arr_q as $key=>$word) {
		
				$arr_q[$key] = " (a.title LIKE '%".$word."%' OR a.url LIKE '%".$word."%' OR a.notes LIKE '%".$word."%' ) ";
			}
			
			# Set Query
			$q = "SELECT  a.bookmark_id, a.title, a.url, a.notes, a.created, b.user_id, b.email, b.first_name, b.last_name
				FROM user_bookmarks a, users b
				WHERE a.user_id = b.user_id
				AND b.email = '".$email."'
				AND  " . implode(' OR ', $arr_q) . " 
				ORDER BY a.created desc
				";
			
			# Run the command and store it as variable
			$bookmarks = DB::instance(DB_NAME)->select_rows($q);

		# Do the following, if search is not set
		} else {
			
			# Set Query to get bookMarks for the profile user
			$q = "SELECT a.bookmark_id, a.title, a.url, a.notes, a.created, b.user_id, b.email, b.first_name, b.last_name
				FROM user_bookmarks a, users b
				WHERE a.user_id = b.user_id
				AND b.email = '".$email."'
				ORDER BY a.created desc
				";
			
			# Run the command and store it as variable
			$bookmarks = DB::instance(DB_NAME)->select_rows($q);
		}
		
		# Set Query
		$q= "SELECT user_id
			From users
			WHERE email = '".$email."'
			";
		
		# Store our results in the variable $profile_user_id 
		$profile_user_id = DB::instance(DB_NAME)->select_field($q);
		
		
		# Whom profile user following
		$q = "SELECT *
			From users_users
			WHERE user_id = '".$profile_user_id."'
			";
			
		# Store our results (an array) in the variable $connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		
		# Who are profile user's follower
		$q = "SELECT *
			From users_users
			WHERE user_id_followed = '".$profile_user_id."'
			";
							
		# Store our results (an array) in the variable $follower
		$follower = DB::instance(DB_NAME)->select_array($q, 'user_id');
		
		# Setup View
		$this->template->content = View::instance('v_network_profile');
		$this->template->title = "My Profile";
		
		# Setup Variables
		$this->template->content->email = $email;
		$this->template->content->profile = $profile;
		$this->template->content->bookmarks = $bookmarks;
		$this->template->content->connections = $connections;
		$this->template->content->follower = $follower;
		
		# Render the template
		echo $this->template;
	
	} # End of method
	
	public function like($bookmark_id_like) {
	
		#Prepare the data array to be inserted
		$data = Array(
			"liked" => Time::now(),
			"user_id" => $this->user->user_id,
			"bookmark_id" => $bookmark_id_like
			);
	
		# Insert Like this connection
		DB::instance(DB_NAME)->insert('likes', $data);
	
	
		# Send them back
		Router::redirect("/network/links");
	
	} # End of method
	
	public function unlike($bookmark_id_like) {
	
		# Delete this connection
		$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND bookmark_id = '.$bookmark_id_like;
		DB::instance(DB_NAME)->delete('likes', $where_condition);

		# Send them back
		Router::redirect("/network/links");
	
	} # End of method

} # End of class