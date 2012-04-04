<?php

/**
 *  dolphin. Collection of useful PHP skeletons.
 *  Copyright (C) 2012  Johannes 'Banana' Keßler
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
 *
 * You should have received a copy of the
 * COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
 * along with this program.  If not, see http://www.sun.com/cddl/cddl.html
 */

/**
 * simple session based user auth
 * There is no security check against enything. 
 * Use this only as an example and not productive
 */

# session
define('SESSION_LIFETIME',28800); # default is 28800 => 8 hours
define('SESSION_NAME','TheSessionName');

define('AUTH_USER','the user name');
define('AUTH_PASS','the password');
define('AUTH_KEY','the special key');

session_set_cookie_params(SESSION_LIFETIME);
session_name(SESSION_NAME);
session_start();
session_regenerate_id(true);

$needsLogin = true;

if(isset($_GET['do']) && $_GET['do'] == "logout") {
	# clear session info
	session_destroy();
	$_COOKIE = array();
	$_SESSION = array();
	
	# "reload" the page
	header("Location: ./session-based.php"); # rename to the correct file!
}
elseif(isset($_SESSION[SESSION_NAME]['someKey']) && $_SESSION[SESSION_NAME]['someKey'] === AUTH_KEY) {
	$needsLogin = false;
}

# process the login form
if(isset($_POST['doLogIn'])) {
	if(isset($_POST['username']) && isset($_POST['password'])) {
		$username = trim($_POST['username']);
		$password = trim($_POST['password']);

		if(!empty($username) && $username === AUTH_USER
			&& !empty($password) && $password === AUTH_PASS) {
					
				# register the session
				$_SESSION[SESSION_NAME]['someKey'] = AUTH_KEY;
				$needsLogin = false;
				
				# "reload" the page
				header('Location: session-based.php'); # rename to the correct file!
			}
	}
}

header('Content-type: text/html; charset=UTF-8');
?>
<html>
	<head>
		<title>SESSION based user auth</title>
		<meta charset='utf-8' />
	</head>
	<body>
	<h1>Simple $_SESSION based auth method</h1>
	<?php if($needsLogin === true) { ?>
		<h2>Login form</h2>
		<form method="post" action="">
			<label>Username</label>
			<input type="text" name="username" value="" />
			<br />
			<br />
			<label>Password</label>
			<input type="password" name="password" value="" /><br />
			<br />
			<button type="submit" name="doLogIn" title="Login">LogIn</button>
		</form>
	<?php }	else { ?>
		<p>You are logged in.</p>
		<p><a href='?do=logout'>Do you want to logout ?</a></p>
	<?php } ?>
	</body>
</html>	
	