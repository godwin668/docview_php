$(document).ready(function() {
	/* ---------------------------------------------------------------------- */
	/*	Check Login
	/* ---------------------------------------------------------------------- */
	$.get("/user/do_check_login", function(data) {
		
		var username = data.username;
		if (username !== undefined) {
			// SUCCESS - is login
			var userHtml = 
			  '<div class="nav-collapse collapse">' +
	            '<div class="pull-right">' +
	              '<ul class="nav pull-right">' +
	                '<li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user icon-white"></i> ' + username + ' <b class="caret"></b></a>' +
	                  '<ul class="dropdown-menu">' +
	                    '<li><a href="/user/preferences" style="text-decoration: none;"><i class="icon-cog"></i> Preferences</a></li>' +
	                    '<li><a href="http://www.idocv.com/en/contact.html" style="text-decoration: none;"><i class="icon-envelope"></i> Contact Support</a></li>' +
	                    '<li class="divider"></li>' +
	                    '<li><a id="button-logout" href="#" style="text-decoration: none;"><i class="icon-off"></i> Logout</a></li>' +
	                  '</ul>' +
	                '</li>' +
	              '</ul>' +
	            '</div>' +
	         '</div><!-- user info end -->';
			$('.navbar-inner .container-fluid').append(userHtml);
			initializeUser();
		} else {
			// FAIL - NOT login
			var loginHtml = 
				'<!-- SIGN UP & SIGN IN -->' +
		          '<ul class="nav pull-right">' +
		          	'<li><a href="/signup.html">Sign Up</a></li>' +
		          	'<li class="divider-vertical"></li>' +
		            '<li class="dropdown">' +
		              '<a class="dropdown-toggle" href="#" data-toggle="dropdown">Sign In <strong class="caret"></strong></a>' +
		              '<div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">' +
		                '<!-- Login form here -->' +
		                '<form id="form-signin" class="form-horizontal" action="" method="post" accept-charset="UTF-8">' +
		                  '<div id="sign-in-result"></div>' +
						  '<input id="login_username" placeholder="Username" style="margin-bottom: 15px;" type="text" name="login_username" size="30" data-validation="validate_min_length length3" />' +
						  '<input id="login_password" placeholder="Password" style="margin-bottom: 15px;" type="password" name="login_password" size="30" data-validation="validate_min_length length4" />' +
						  '<input id="login_rememberme" style="float: left; margin-right: 10px;" type="checkbox" name="login_rememberme" value="1" />' +
						  '<label class="string optional" for="user_remember_me"> Remember me</label>' +
						  '<input class="btn btn-primary" style="clear: left; width: 100%; height: 32px; font-size: 13px;" type="submit" name="commit" value="Sign In" />' +
						'</form>' +
		              '</div>' +
		            '</li>' +
		          '</ul>';
			$('.navbar-inner .container-fluid').append(loginHtml);
			initializeLoginForm();
		}
	}, "json");
	
	/* ---------------------------------------------------------------------- */
	/*	User Info - already login
	/* ---------------------------------------------------------------------- */
	function initializeUser() {
		$("#button-logout").click(function() {
			$.get("/user/do_logout", function(data) {
				window.location.reload();
			}, "json");
			return false;
		});
	}
	
	/* ---------------------------------------------------------------------- */
	/*	Login form - NOT login
	/* ---------------------------------------------------------------------- */
	
	function initializeLoginForm() {
		$("#user_username").focus();
		
		/* FORM VALIDATOR */
		var validationSettings = {
				errorMessagePosition : 'element',
		};
		
		$('#form-signin').submit(function() {
			if ($(this).validate(false, validationSettings)) {
				var $form = $( this ),
				username = $form.find('input[name="login_username"]').val(),
				password = $form.find('input[name="login_password"]').val();
				
				/* Send the data using post */
				$.post("/user/do_login",
						{
							user: username,
							password: password
						},
						function(data, status){
							var sid = data.sid;
							if (sid !== undefined) {
								// SUCCESS
								// $.cookie('IDOCVSID', sid, { path: '/' });
								window.location.reload();
							} else {
								// FAIL
								$('#sign-in-result').empty().append('<div class="alert alert-error">ERROR: ' + data.error + '</div>');
							}
						}, "json");
			}
			return false;
		})
		.validateOnBlur(false, validationSettings)
		.showHelpOnFocus();
	}
	
});