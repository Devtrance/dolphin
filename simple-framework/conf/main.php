<?php
/**
* dolphin. Collection of usefull PHP skeletons.
* Copyright (C) 2009 Johannes 'Banana' Keßler
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the GNU General Public License as published by
* the Free Software Foundation, either version 3 of the License, or
* (at your option) any later version.
*
* This program is distributed in the hope that it will be useful,
* but WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
*
* You should have received a copy of the GNU General Public License
* along with this program. If not, see <http://www.gnu.org/licenses/>.
*/

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
