<?php
class users_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		
		# Route to @connection page
		Router::redirect("/users/findfriends/");
	}
	
	public function signup($error = NULL) {
		
		# If user is logged in; redirect it to the Profile page
		if($this->user) {
				
			# Route to Profile page
			Router::redirect('/users/profile');
		}
		
		# Set View
		$this->template->content = View::instance('v_users_signup');
		
		# Set Page Title
		$this->template->title = "Sign Up";
		
		# Pass error data to the view
		$this->template->content->error = $error;
		
		# Render View
		echo $this->template;
	}
	
	public function p_signup() {
		
		# check for empty first name, last name
		# email and password
		if (($_POST['first_name'] == NULL) || 
			($_POST['last_name']  == NULL) || 
			($_POST['email'] == NULL ) ||
			($_POST['password'] == NULL )){

			# Show error
			Router::redirect("/users/signup/error");
		}
		
		# Build the Query
		$q = "SELECT token
			FROM users
			WHERE email = '".$_POST['email']."'
			";
		
		# Find Match
		$token = DB::instance(DB_NAME)->select_field($q);
		
		# If we find a matching token in the database, it means, it's a duplicate email
		if($token) {
			
			# Send them back to the login page
			Router::redirect("/users/signup/error");
			
		} else {
		
			# More data we want stored with the user
			$_POST['created']  = Time::now();
			$_POST['modified'] = Time::now();
			
			# Encrypt the password
			$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
			
			# Create an encrypted token via their email address and a random string
			$_POST['token'] = sha1(TOKEN_SALT.$_POST['email'].Utils::generate_random_string());
			
			# Insert all $_POST Info to database-> users table
			DB::instance(DB_NAME)->insert('users', $_POST);
			
			# Set to, from, subject and body for a Welcome Email
			$to[]    = Array("name" => $_POST['first_name'], "email" => $_POST['email']);
			$from    = Array("name" => APP_NAME, "email" => APP_EMAIL);
			$subject = "Welcome!!! You have signed up for ChitChat";
			$body = View::instance('v_users_email_welcome');
			
			# Send Welcome email
			$email = Email::send($to, $from, $subject, $body, true, '');
			
			# Route to login Page
			Router::redirect("/users/login/");
		}
	}
	
	public function login($error = NULL) {
		
		# If user is logged in; redirect it to the Profile page
		if($this->user) {
		
			# Route to Profile page
			Router::redirect('/users/profile');
		}
		
		# Set View
		$this->template->content = View::instance('v_users_login');
		
		# Set Error
		$this->template->content->error = $error;
		
		# Set Title
		$this->template->title = "Login";
		
		# Render View
		echo $this->template;
	}
	
	
	public function p_login() {
		
		# check for empty email and password
		if (($_POST['email'] == NULL ) ||
		($_POST['password'] == NULL )){
		
			# Show error
			Router::redirect("/users/login/error");
		}
		
		# Sanitize the user entered data
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		#Hash submitted password so we can compare it against one in the db
		$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
		
		# Search the db for this email and password
		# Retrieve the token if it's available
		$q = "SELECT token
			FROM users
			WHERE email = '".$_POST['email']."' 
			AND password = '".$_POST['password']."'
			";
		
		# Find Match
		$token = DB::instance(DB_NAME)->select_field($q);
		
		# If we didn't find a matching token in the database, it means login failed
		if(!$token){
           
			# Send them back to the login page
			Router::redirect("/users/login/error");

		# if we found the Match, login succeeded!
		} else {
			
			#set cookie
			setcookie("token", $token, strtotime('+1 year'), '/');
			
			
			#Send them to the main page
			Router::redirect("/posts/add");
		}
	}
	
	public function logout() {
	
	    # Generate and save a new token for next login
	    $new_token = sha1(TOKEN_SALT.$this->user->email.Utils::generate_random_string());
	
	    # Create the data array we'll use with the update method
	    # In this case, we're only updating one field, so our array only has one entry
	    $data = Array("token" => $new_token);
	
	    # Do the update
	    DB::instance(DB_NAME)->update("users", $data, "WHERE token = '".$this->user->token."'");
	
	    # Delete their token cookie by setting it to a date in the past - effectively logging them out
	    setcookie("token", "", strtotime('-1 year'), '/');
	
	    # Send them back to the main index.
	    Router::redirect("/");
	}
	
	public function profile($error = NULL) {
		
		# If user is not logged in; redirect it to the login page
		if(!$this->user) {
			
			# If user is not logged in, route to login page
			Router::redirect('/users/login');
		}
		
		# Set View
		$this->template->content = View::instance('v_users_profile');
		
		# Set Page Title
		$this->template->title = "Profile of ".$this->user->first_name;
		
		# Set Error
		$this->template->content->error = $error;
		
		# Get IP addres
		$ip= Geolocate::ip_address();
		
		# Get Location using IP Address
		$this->template->content->location = Geolocate::geoplugin($ip);
		
		# Render View
		echo $this->template;
	}
	
	public function p_profile() {
		
		#Create a random number 
		$rand_val = date('YMDHIS') . rand(11111, 99999);
		
		# Get Uploaded file name without extension
		if (!basename($_FILES['profile_image']['name']) == NULL){
			
			$new_file_name = preg_replace("/\\.[^.]*$/", "",basename($_FILES['profile_image']['name']));
		
		} else {
			
			# otherwise route to error
			Router::redirect("/users/profile/error");
		}
		
		# Assign created random number to file.
		$new_file_name = md5($rand_val);
		
		# Upload file 
		$upload = Upload::upload($_FILES, "/uploads/avatars/", array("jpg", "jpeg", "gif", "png"), $new_file_name);
		
		if(isset($upload)){
			
			# Build a Query
			$q = "UPDATE users
				SET profile_image = '".$upload."'
				WHERE email = '".$this->user->email."'
				";
				
			# Run the command
			DB::instance(DB_NAME)->query($q);
			
			
			# Route to profile page
			Router::redirect("/users/profile");
			
		} else {
			
			# Route to profile page's Error
			Router::redirect("/users/profile/error");
		}
	
	}
	
	public function findfriends() {
		
		# Make sure user is logged in
		if(!$this->user) {
			
			# If not, Route to Login page
			Router::redirect("/users/login");
			
		} else {
		
			# Setup view
			$this->template->content = View::instance('v_users_find_friends');
			$this->template->title = "Find Friends";
			
			# Build the query
			$q = "SELECT *
				FROM users
				"; 
			
			# Run the query
			$users = DB::instance(DB_NAME)->select_rows($q);
			
			# Who are they following
			$q = "SELECT *
				From users_users
				WHERE user_id = '".$this->user->user_id."'
				";
			
			# Store our results (an array) in the variable $connections
			$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
			
			# Pass data to the View
			$this->template->content->users = $users;
			$this->template->content->connections = $connections;
			
			# Render the View
			echo $this->template;
		}
	}
}