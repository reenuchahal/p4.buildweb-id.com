$(document).ready(function() {
	
	//global vars
	var form = $("#registrationForm");
	var form_password = $("#formPassword");
	var form_login = $("#forgotPasswordLogin");
	var form_addLink = $("#addLink");
	var firstName = $("#firstName");
	var lastName = $("#lastName");
	var firstNameInfo = $("#firstNameInfo");
	var lastNameInfo = $("#lastNameInfo");
	var yourEmail = $("#yourEmail");
	var yourEmailInfo = $("#yourEmailInfo");
	var yourPassword = $("#yourPassword");
	var yourPasswordInfo = $("#yourPasswordInfo");
	var url = $("#url");
	var title = $("#title");
	var notes = $("#notes");
	var urlError = $("#urlError");
	var titleError = $("#titleError");
	var notesError = $("#notesError");
	var url_validate = /^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i;
	
	
	//On key press
	firstName.keyup(validateFirstName);
	lastName.keyup(validateLastName);
	yourEmail.keyup(validateYourEmail);
	yourPassword.keyup(validateYourPassword);
	url.keyup(validateURL);
	title.keyup(validateTitle);
	notes.keyup(validateNotes);
	
	
	//On Submitting
	form.submit(function() {
		if(validateFirstName() & validateLastName() & validateYourEmail() & validateYourPassword())
			return true
		else
			return false;
	});
	
	//On Submitting
	form_password.submit(function() {
		if(validateYourPassword())
			return true
		else
			return false;
	});
	
	//On Submitting
	form_login.submit(function() {
		if(validateYourEmail())
			return true
		else
			return false;
	});
	
	//On Submitting
	form_addLink.submit(function() {
		if(validateURL() & validateTitle() & validateNotes())
			return true
		else
			return false;
	});
	
	// Email validation function
	function validateYourEmail() {
		
		//testing regular expression
		var a = $("#yourEmail").val();
		var filter = /^[a-zA-Z0-9]+[a-zA-Z0-9_.-]+[a-zA-Z0-9_-]+@[a-zA-Z0-9]+[a-zA-Z0-9.-]+[a-zA-Z0-9]+.[a-z]{2,4}$/;
		
		//if it's valid email
		if($.trim(yourEmail.val()) == "") {
			yourEmail.addClass("error");
			yourEmailInfo.text("No Blank spaces");
			yourEmailInfo.addClass("error");
			return false;
			
		} else if(filter.test(a)) {
			yourEmail.removeClass("error");
			yourEmailInfo.text(" ");
			yourEmailInfo.removeClass("error");
			return true;
			
		//if it's NOT valid
		} else {
			yourEmail.addClass("error");
			yourEmailInfo.text("Type a valid e-mail");
			yourEmailInfo.addClass("error");
			return false;
		}
	}
	
	// First Name validation function
	function validateFirstName() {
		
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
			
		} else if  (firstName.val().length > 254){
			firstName.addClass("error");
			firstNameInfo.text("Max 254 characters.");
			firstNameInfo.addClass("error");
			return false; 
		
		//if it's valid
		} else {
			firstName.removeClass("error");
			firstNameInfo.text(" ");
			firstNameInfo.removeClass("error");
			return true;
		}
	}
	
	// Last Name validation function
	function validateLastName() {
		
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
			
		} else if  (lastName.val().length > 254){
			lastName.addClass("error");
			lastNameInfo.text("Max 254 characters.");
			lastNameInfo.addClass("error");
			return false; 
		
		//if it's valid
		} else{
			lastName.removeClass("error");
			lastNameInfo.text(" ");
			lastNameInfo.removeClass("error");
			return true;
		}
	}
	
	// Password validation function
	function validateYourPassword(){
		
		//it's NOT valid
		if($.trim(yourPassword.val()) == ""){
			yourPassword.addClass("error");
			yourPasswordInfo.text("No Blank Spaces");
			yourPasswordInfo.addClass("error");
			return false;
			
		} else if (yourPassword.val().indexOf(' ') >= 0){
			yourPassword.addClass("error");
			yourPasswordInfo.text("Remove blank space(s) in your password.");
			yourPasswordInfo.addClass("error");
			
		} else if (yourPassword.val().length < 5){
			yourPassword.addClass("error");
			yourPasswordInfo.text("Minimum 5 characters.");
			yourPasswordInfo.addClass("error");
			
		} else {			
			yourPassword.removeClass("error");
			yourPasswordInfo.text(" ");
			yourPasswordInfo.removeClass("error");
			return true;
		}
	}
	
	// URL validation function
	function validateURL(){
		
		//if it's NOT valid
		if($.trim(url.val()) == "" ){
			url.addClass("error");
			urlError.text("No Blank Spaces.");
			urlError.addClass("error");
			return false;
			
		} else if  (url.val().length > 254){
			url.addClass("error");
			urlError.text("Max 254 characters.");
			urlError.addClass("error");
			return false;
			
		} else if(!url_validate.test($.trim(url.val()))){
			url.addClass("error");
			urlError.text("Invalid URL !!!");
			urlError.addClass("error");
			return false;
		
		//if it's valid	
		} else {
			url.removeClass("error");
			urlError.text(" ");
			urlError.removeClass("error");
			return true;
		}
	}
	
	// Title validation function
	function validateTitle() {
		
		//if it's NOT valid
		if($.trim(title.val()) == "" ){
			title.addClass("error");
			titleError.text("No Blank Spaces.");
			titleError.addClass("error");
			return false;
			
		} else if  (title.val().length > 254){
			title.addClass("error");
			titleError.text("Max 254 characters.");
			titleError.addClass("error");
			return false;
		
		//if it's valid
		} else {
			title.removeClass("error");
			titleError.text(" ");
			titleError.removeClass("error");
			return true;
		}
	}
	
	// Notes validation function
	function validateNotes() {
		
		//if it's NOT valid
		if($.trim(notes.val()) == "" ) {
			notes.addClass("error");
			notesError.text("No Blank Spaces.");
			notesError.addClass("error");
			return false;
			
		} else if  (notes.val().length > 1000) {
			notes.addClass("error");
			notesError.text("Max 1000 characters.");
			notesError.addClass("error");
			return false;
			
		//if it's valid	
		} else {
			notes.removeClass("error");
			notesError.text(" ");
			notesError.removeClass("error");
			return true;
		}
	}
});

// Profile Edit Hide and Show
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