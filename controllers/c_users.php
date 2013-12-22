<?php
class users_controller extends base_controller {
	
	public function __construct() {
		parent::__construct();
	
	} # End of method
	
	public function index() {
		
		# Route to @connection page
		Router::redirect("/users/findfriends/");
	
	} # End of method
	
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
	
	} # End of method
	
	public function p_signup() {
		
		# Sanitize the user entered data
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		#function to remove space
		function trim_value(&$value) {
			$value = trim($value);
		}
			
		#remove space
		array_walk($_POST, 'trim_value');
		
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
			
			# Build the Query
			$q = "SELECT token
			FROM users
			WHERE email = '".$_POST['email']."'
			";
			
			# Find Match
			$token = DB::instance(DB_NAME)->select_field($q);
			
			# Set to, from, subject and body for a Welcome Email
			$to[]    = Array("name" => $_POST['first_name'], "email" => $_POST['email']);
			$from    = Array("name" => APP_NAME, "email" => APP_EMAIL);
			$subject = "Welcome!!! You have signed up for Web BookMark";
			$body = View::instance('v_users_email_welcome');
			$body->token = $token;
			# Send Welcome email
			$email = Email::send($to, $from, $subject, $body, true, '');
			
			# Route to login Page
			Router::redirect("/users/signup_result/");
		}
	
	} # End of method
	
	public function signup_result($error1 = NULL, $error2 = NULL) {
		
		# If user is logged in; redirect it to the Profile page
		if($this->user) {
		
			# Route to Profile page
			Router::redirect('/users/profile');
		}
		
		# Set View
		$this->template->content = View::instance('v_users_verify');
		
		# Set Page Title
		$this->template->title = "Verification";
		
		# Pass error data to the view
		$this->template->content->error1 = $error1;
		
		# Pass error data to the view
		$this->template->content->error2 = $error2;
		
		# Render View
		echo $this->template;
	
	} # End of method
	
	public function verify($email= NULL,$token = NULL ) {
			
		if(($email == NULL) || ($token == NULL)) {
				
			# Route to login Page
			Router::redirect("/users/signup_result/error1");
				
		} else {
			
			# Build the Query
			$q = "SELECT *
				FROM users
				WHERE email = '".$email."'
				AND token = '".$token."'
				AND active = 0
				";
		    		
			# Find Match
			$match = DB::instance(DB_NAME)->select_field($q);
		    	
			if($match > 0) { 
				
				# Build a Query
				$q = "UPDATE users
					SET active = 1
					WHERE email = '".$email."'
					AND token = '".$token."'
					AND active = 0
					";
							
				# Run the command
				DB::instance(DB_NAME)->query($q);
						
						
				# Route to profile page
				Router::redirect("/users/login/loginMessage");
				
			} else {
			    		
				# Route to login Page
				Router::redirect("/users/signup_result/match/error");
			}
		}
	
	} # End of method
	
	public function login($loginMessage = NULL, $error = NULL ) {
		
		# If user is logged in; redirect it to the Profile page
		if($this->user) {
		
			# Route to Profile page
			Router::redirect('/users/profile');
		}
		
		# Set View
		$this->template->content = View::instance('v_users_login');
		
		#Set SuccessMessage
		$this->template->content->loginMessage = $loginMessage;
		
		# Set Error
		$this->template->content->error = $error;
		
		
		# Set Title
		$this->template->title = "Login";
		
		# Render View
		echo $this->template;
	
	} # End of method
	
	public function p_login() {
		
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
			AND active = 1		
			";
		
		# Find Match
		$token = DB::instance(DB_NAME)->select_field($q);
		
		# If we didn't find a matching token in the database, it means login failed
		if(!$token){
           
			# Send them back to the login page
			Router::redirect("/users/login/loginMessage/error");

		# if we found the Match, login succeeded!
		} else {
			
			#set cookie
			setcookie("token", $token, strtotime('+1 year'), '/');
			
			
			#Send them to the main page
			Router::redirect("/bookmarks/myLinks");
		}
	
	} # End of method
	
	public function forgot_password($error = NULL, $email = NULL) {
	
		# If user is logged in; redirect it to the Profile page
		if($this->user) {
	
		# Route to Profile page
			Router::redirect('/users/profile');
		}
	
		# Set View
		$this->template->content = View::instance('v_users_forgot_password');
		
		#Set Error
		$this->template->content->error = $error;
		
		#Set Error
		$this->template->content->email = $email;
		
		# Set Title
		$this->template->title = "Forgot password?";

		# Render View
		echo $this->template;
	
	} # End of method
	
	public function p_forgot_password() {
		
		# Sanitize the user entered data
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		# Search the db for this email and password
		# Retrieve the token if it's available
		$q = "SELECT token
			FROM users
			WHERE email = '".$_POST['email']."'
			";
		
		# Find Match
		$token = DB::instance(DB_NAME)->select_field($q);
		
		# If we didn't find a matching token in the database, it means login failed
		if(!$token){
			 
			# Send them back to the login page
			Router::redirect("/users/forgot_password/error/".$_POST['email']);

		# if we found the Match, do this
		} else {
			
			# Build a Query
			$q = "UPDATE users
				SET active = 0
				WHERE email = '".$_POST['email']."'
				AND token = '".$token."'
				";
				
			# Run the command
			DB::instance(DB_NAME)->query($q);
			
			# Set to, from, subject and body for a Welcome Email
			$to[]    = Array("name" => $_POST['email'], "email" => $_POST['email']);
			$from    = Array("name" => APP_NAME, "email" => APP_EMAIL);
			$subject = "Forgot your password? Web BookMark";
			$body = View::instance('v_users_email_recover_password');
			$body->token = $token;
			# Send Welcome email
			$email = Email::send($to, $from, $subject, $body, true, '');
				
			# Route to login Page
			Router::redirect("/users/recover_password_result/");
		}
	
	} # End of method
	
	public function recover_password_result($success= NULL, $error1 = NULL, $error2 = NULL) {
	
		# If user is logged in; redirect it to the Profile page
		if($this->user) {
	
			# Route to Profile page
			Router::redirect('/users/profile');
		}
	
		# Set View
		$this->template->content = View::instance('v_users_recovery');

		# Set Page Title
		$this->template->title = "Recover Password";
		
		# Pass error data to the view
		$this->template->content->success = $success;

		# Pass error data to the view
		$this->template->content->error1 = $error1;

		# Pass error data to the view
		$this->template->content->error2 = $error2;

		# Render View
		echo $this->template;
	
	} # End of method
	
	public function reset_password($email = NULL, $token = NULL) {
	
		# If user is logged in; redirect it to the Profile page
		if($this->user) {
	
			# Route to Profile page
			Router::redirect('/users/profile');
		}
	
		# Set View
		$this->template->content = View::instance('v_reset_password');
	
		# Set Page Title
		$this->template->title = "Recover Password";
	
		# Pass error data to the view
		$this->template->content->email = $email;
	
		# Pass error data to the view
		$this->template->content->token = $token;
	
		# Render View
		echo $this->template;
	
	} # End of method
	
	public function p_reset_password() {
		
		# Sanitize the user entered data
		$_POST = DB::instance(DB_NAME)->sanitize($_POST);
		
		#function to remove space
		function trim_value(&$value) {
			$value = trim($value);
		}
			
		#remove space
		array_walk($_POST, 'trim_value');
		
		# Build the Query
		$q = "SELECT count(user_id)
			FROM users
			WHERE email = '".$_POST['email']."'
			AND token = '".$_POST['token']."'
			AND active = 0
			";
	
		# Find Match
		$match = DB::instance(DB_NAME)->select_field($q);
		
		if($match > 0) {
		
			# Sanitize the user entered data
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);
			
			#Hash submitted password so we can compare it against one in the db
			$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
			
			
			# Build a Query
			$q = "UPDATE users
				SET password =  '".$_POST['password']."',
				active = 1
				WHERE email = '".$_POST['email']."'
				AND token = '".$_POST['token']."'
				AND active = 0
				";
				
			# Run the command
			DB::instance(DB_NAME)->query($q);
			
			# Route to profile page
			Router::redirect("/users/recover_password_result/success");
			
		} else {
					
			# Route to login Page
			Router::redirect("/users/recover_password_result/result/match/error");
		}	
	
	} # End of method
	
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
	
	} # End of method
	
	public function profile($error = NULL, $unique_email_error = null) {
		
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
		
		# Set Error
		$this->template->content->unique_email_error = $unique_email_error;
		
		# Get IP addres
		$ip= Geolocate::ip_address();
		
		# Get Location using IP Address
		$this->template->content->location = Geolocate::geoplugin($ip);
		
		# Render View
		echo $this->template;
	
	} # End of method
	
	public function p_profileEdit(){
		
		# If user is not logged in; redirect it to the login page
		if(!$this->user) {
				
			# If user is not logged in, route to login page
			Router::redirect('/users/login');
			
		} else {
			
			# Sanitize the user entered data
			$_POST = DB::instance(DB_NAME)->sanitize($_POST);
			
			#function to remove space
			function trim_value(&$value) {
				$value = trim($value);
			}
				
			#remove space
			array_walk($_POST, 'trim_value');
			
			# Retrieve the token if it's available
			$q = "SELECT count(email)
				FROM users
				WHERE email = '".$_POST['email']."'
				";
			
			# Find Match
			$all_match = DB::instance(DB_NAME)->select_field($q);
			
			# Retrieve the token if it's available
			$q = "SELECT count(email)
				FROM users
				WHERE email = '".$_POST['email']."'
				AND user_id = '".$this->user->user_id."'
				";
			
			# Find Match
			$user_match = DB::instance(DB_NAME)->select_field($q);
			
			if ($all_match - $user_match < 1) {
				
				# Sanitize the user entered data
				$_POST = DB::instance(DB_NAME)->sanitize($_POST);
				
				#Time Modified
				$_POST['modified'] = Time::now();
					
				# Encrypt the password
				$_POST['password'] = sha1(PASSWORD_SALT.$_POST['password']);
			
				# Build a Query
				$q = "UPDATE users
					SET first_name =  '".$_POST['first_name']."',
					last_name =  '".$_POST['last_name']."',
					password =  '".$_POST['password']."',
					email = '".$_POST['email']."',
					modified = '".$_POST['modified']."'
					WHERE user_id = '".$this->user->user_id."'
					";
					
				# Run the command
				DB::instance(DB_NAME)->query($q);
				
				
				# Route to profile page
				Router::redirect("/users/profile");
				
			} else {
				
				# Route to profile page
				Router::redirect("/users/profile/error/unique_email/");
				
			} 
		}
	
	} # End of method
	
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
	
	} # End of method
	
	public function findfriends() {
		
		# Make sure user is logged in
		if(!$this->user) {
			
			# If not, Route to Login page
			Router::redirect("/users/login");
			
		} else {
			
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
					
					$arr_q[$key] = " first_name LIKE '%".$word."%' OR last_name LIKE '%".$word."%' ";
				}
				
				# Build the query
				$q= "SELECT *
					FROM users
					WHERE " . implode(' OR ', $arr_q) . " LIMIT 0,10";
					
				//echo $query;
				$users = DB::instance(DB_NAME)->select_rows($q);
			
			} else {
			
				# Build the query
				$q = "SELECT *
					FROM users
					"; 
				
				# Run the query
				$users = DB::instance(DB_NAME)->select_rows($q);
			}
				
			# Who are they following
			$q = "SELECT *
				From users_users
				WHERE user_id = '".$this->user->user_id."'
				";
	
			# Store our results (an array) in the variable $connections
			$connections = DB::instance(DB_NAME)->select_array($q, 'user_id_followed');
			
			# Setup view
			$this->template->content = View::instance('v_users_find_friends');
			$this->template->title = "Find Friends";
			
			# Pass data to the View
			$this->template->content->users = $users;
			$this->template->content->connections = $connections;

			# Render the View
			echo $this->template;
		}
		
	} # End of method
	
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
	
	} # End of method
	
	public function unfollow($user_id_followed) {
	
		# Delete this connection
			$where_condition = 'WHERE user_id = '.$this->user->user_id.' AND user_id_followed = '.$user_id_followed;
			DB::instance(DB_NAME)->delete('users_users', $where_condition);
	
			# Send them back
			Router::redirect("/users/findfriends");
	
	} # End of method
	
} # End of class