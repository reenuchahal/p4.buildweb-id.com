$(document).ready(function(){
	//global vars
	var form = $("#registrationForm");
	var firstName = $("#firstName");
	var lastName = $("#lastName");
	var firstNameInfo = $("#firstNameInfo");
	var lastNameInfo = $("#lastNameInfo");
	var yourEmail = $("#yourEmail");
	var yourEmailInfo = $("#yourEmailInfo");
	var yourPassword = $("#yourPassword");
	var yourPasswordInfo = $("#yourPasswordInfo");
	//var passwordConfirm = $("#passwordConfirm");
	//var passwordConfirmInfo = $("#passwordConfirmInfo");
	
	
	//On blur
	//firstName.blur(validateFirstName);
	//lastName.blur(validateLastName);
	//yourEmail.blur(validateYourEmail);
	//yourPassword.blur(validateYourPassword);
	//passwordConfirm.blur(validatePasswordConfirm);
	
	//On key press
	firstName.keyup(validateFirstName);
	lastName.keyup(validateLastName);
	yourEmail.keyup(validateYourEmail);
	yourPassword.keyup(validateYourPassword);
	//passwordConfirm.keyup(validatePasswordConfirm);
	
	//On Submitting
	form.submit(function(){
		if(validateFirstName() & validateLastName() & validateYourEmail() & validateYourPassword())
			return true
		else
			return false;
	});
	
	//validation functions
	function validateYourEmail(){
		//testing regular expression
		var a = $("#yourEmail").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		
		//if it's valid email
		if($.trim(yourEmail.val()) == ""){
			yourEmail.addClass("error");
			yourEmailInfo.text("No Blank spaces");
			yourEmailInfo.addClass("error");
			return false;
		} else if(filter.test(a)){
			yourEmail.removeClass("error");
			yourEmailInfo.text(" ");
			yourEmailInfo.removeClass("error");
			return true;
		}
		//if it's NOT valid
		else{
			yourEmail.addClass("error");
			yourEmailInfo.text("Type a valid e-mail");
			yourEmailInfo.addClass("error");
			return false;
		}
	}
	function validateFirstName(){
		//if it's NOT valid
		if($.trim(firstName.val()) == ""){
			firstName.addClass("error");
			firstNameInfo.text("No Blank Spaces.");
			firstNameInfo.addClass("error");
			return false;
		} else if (firstName.val().length < 2){
			firstName.addClass("error");
			firstNameInfo.text("Minimum 2 letters.");
			firstNameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			firstName.removeClass("error");
			firstNameInfo.text(" ");
			firstNameInfo.removeClass("error");
			return true;
		}
	}
	
	function validateLastName(){
		//if it's NOT valid
		if($.trim(lastName.val()) == "" ){
			lastName.addClass("error");
			lastNameInfo.text("No Blank Spaces.");
			lastNameInfo.addClass("error");
			return false;
		} else if  (lastName.val().length < 2){
			lastName.addClass("error");
			lastNameInfo.text("Minimum 2 letters.");
			lastNameInfo.addClass("error");
			return false;
		}
		//if it's valid
		else{
			lastName.removeClass("error");
			lastNameInfo.text(" ");
			lastNameInfo.removeClass("error");
			return true;
		}
	}
	
	function validateYourPassword(){
		
		//it's NOT valid
		if($.trim(yourPassword.val()) == ""){
			yourPassword.addClass("error");
			yourPasswordInfo.text("No Blank Spaces");
			yourPasswordInfo.addClass("error");
			return false;
		} else if (yourPassword.val().length < 5){
			yourPassword.addClass("error");
			yourPasswordInfo.text("Minimum 5 characters.");
			yourPasswordInfo.addClass("error");

		}
		//it's valid
		else{			
			yourPassword.removeClass("error");
			yourPasswordInfo.text(" ");
			yourPasswordInfo.removeClass("error");
			//validatePasswordConfirm();
			return true;
		}
	}
	/*function validatePasswordConfirm(){
		
		//are NOT valid
		if( yourPassword.val() != passwordConfirm.val() ){
			passwordConfirm.addClass("error");
			passwordConfirmInfo.text("Passwords doesn't match!");
			passwordConfirmInfo.addClass("error");
			return false;
		}
		//are valid
		else{
			passwordConfirm.removeClass("error");
			passwordConfirmInfo.text(" ");
			passwordConfirmInfo.removeClass("error");
			return true;
		}
	}*/
	
});

$("#profileEdit").click(function() {
	$("#profileInfoEdit").removeClass("hidden").addClass("show");
	$("#profileInfo").removeClass("show").addClass("hidden");
	$("#profileEdit").removeClass("show").addClass("hidden");
});

$("#profileEditCancel").click(function() {
	$("#profileInfoEdit").removeClass("show").addClass("hidden");
	$("#profileInfo").removeClass("hidden").addClass("show");
	$("#profileEdit").removeClass("hidden").addClass("show");
});