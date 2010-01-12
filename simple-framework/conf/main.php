<?php

// to get the system messages make it true
define('DEBUG',true);

// path settings
define('PATH_ABSOLUTE',str_replace('/conf','',dirname(__FILE__)));
if(dirname($_SERVER['SCRIPT_NAME']) === '/') {
	define('WEBROOT_PATH','');
}
else {
	define('WEBROOT_PATH',dirname($_SERVER['SCRIPT_NAME']));
}
define('TMP_DIR',PATH_ABSOLUTE.'/tmp');
define('PATH_LIB','lib');

// time settings
date_default_timezone_set('Europe/Berlin');

// session
define("SESSION_LIFETIME",43200); // 8 hours
define("SESSION_NAME","your-session-name");
define("SESSION_SAVE_PATH",TMP_DIR.'/session');
?>
