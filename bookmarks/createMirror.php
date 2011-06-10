<?php
/**
 * bookmark management
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
 *
 * You should have received a copy of the
 * COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
 * along with this program.  If not, see http://www.sun.com/cddl/cddl.html
 */

/**
 * this script calls via exec() the httrack command.
 * to use this you need http://www.httrack.com/ installed
*/

ini_set('error_reporting',-1); // E_ALL & E_STRICT
ini_set('display_errors',false);
ini_set('log_errors',true);
ini_set('log_errors_max_len',"10M");
ini_set('error_log','./error.file');

$link = false;
$to = false;
$command = false;

$path = dirname(__FILE__).'/';

if(isset($_POST['link'])) $link = trim($_POST['link']);
if(isset($_POST['saveTo'])) $to = trim($_POST['saveTo']);

if(!empty($link) && !empty($to)) {
	$command = "nohup /usr/bin/httrack  -T3  -F'Mozilla/5.0' -r2 -* +*.gif +*.jpg +*.png +*.css +*.js '".$link."' -O ".$path.$to.'/ 1>&2 > /dev/null &';
	$run = exec($command);
}
?>