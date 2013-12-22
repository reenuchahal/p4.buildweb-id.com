<?php
class bookmarks_controller extends base_controller {
	
	public function __construct() {
		
		parent::__construct();
	
		#Make sure user is logged in if they want to anythning in this controller
		if (!$this->user) {
			
			# Route to login Page
			Router::redirect("/users/login/");
		}
	
	} # End of method
	
	public function index() {
	
		# Route to posts/add page
		Router::redirect("/bookmarks/myLinks");
	
	} # End of method
	
	public function p_add() {
		
		# Sanitize the user entered data
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		# set User_id
		$_POST['user_id'] = $this->user->user_id;
		
		#Unic timestamp of when this posts was created and modified
		$_POST['created'] = Time::now();
		$_POST['modified'] = Time::now();
		
		#function to remove space
		function trim_value(&$value) {
			$value = trim($value);
		}
		
		#remove space 
		array_walk($_POST, 'trim_value');
		
		#Insert 
		DB::instance(DB_NAME)->insert('user_bookmarks', $_POST);
		
		# Route to posts/add page
		Router::redirect("/bookmarks/myLinks");
	
	} # End of method
	
	public function myLinks() {
		
		# Do the following, if search is set
		if(isset($_POST['search'])){
		
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
		
				$arr_q[$key] = " (title LIKE '%".$word."%' OR url LIKE '%".$word."%' OR notes LIKE '%".$word."%') ";
			}
		
			# Set Query to get bookMarks for the logged In use
			$q = "SELECT * FROM user_bookmarks
				WHERE user_id = '".$this->user->user_id."'
				AND  " . implode(' OR ', $arr_q) . "
				ORDER BY created desc
				";
						
			//echo $query;
			$bookmarks = DB::instance(DB_NAME)->select_rows($q);
		
		} else {
			
		
			# Set Query to get bookMarks for the logged In use
			$q = "SELECT * FROM user_bookmarks
					WHERE user_id = '".$this->user->user_id."'
					ORDER BY created desc
					";
		
			# Run the command and store it as variable
			$bookmarks = DB::instance(DB_NAME)->select_rows($q);
			
		} 
		
		# Who are logged in user following
		$q = "SELECT *
				From users_users
				WHERE user_id = '".$this->user->user_id."'
				";
			
		# Store our results (an array) in the variable $connections
		$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
		
		# Who are logged in user's follower
		$q = "SELECT *
				From users_users
				WHERE user_id_followed = '".$this->user->user_id."'
				";
			
		# Store our results (an array) in the variable $follower
		$follower = DB::instance(DB_NAME)->select_array($q, 'user_id');
	
		# Set the view and variables
		$this->template->content = View::instance('v_bookmarks_myLinks');
		$this->template->title = "My Links";
		$this->template->content->bookmarks = $bookmarks;
		$this->template->content->connections = $connections;
		$this->template->content->follower = $follower;
		
		# Render the template
		echo $this->template;
		
	} # End of method
	
	public function delete($bookmark_id_delete) {
	
		# Delete this connection
		$where_condition = 'WHERE bookmark_id = '.$bookmark_id_delete;
		
		DB::instance(DB_NAME)->delete('user_bookmarks', $where_condition);
	
		# Send them back
		Router::redirect("/bookmarks/myLinks");
	
	} # End of method
	
	public function edit($bookmark_id_edit){
		
	    # Prevent SQL injection attacks by sanitizing the data the user entered in the form
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		#function to remove space
		function trim_value(&$value) {
			$value = trim($value);
		}
		
		#remove space
		array_walk($_POST, 'trim_value');
		
		#Unic timestamp of when this posts was created and modified
		$_POST['modified'] = Time::now();

		#Build the Query
		$q = "UPDATE user_bookmarks
			SET url = '".$_POST['url']."',
			title = '".$_POST['title']."',
			notes = '".$_POST['notes']."',
			modified = '".Time::now()."'
			WHERE bookmark_id = '".$bookmark_id_edit."'
			";
		 
		# Run the command
		DB::instance(DB_NAME)->query($q);

		# Route to profile page
		Router::redirect("/bookmarks/myLinks");
	
	} # End of method

} # End of class

