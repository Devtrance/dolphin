<?php
/**
 *                   |                                 |             |
 *  __ \   _ \   __| __| |   |  __|    __|  _ \  __ \  __|  __| _ \  |
 *  |   | (   | |    |   |   |\__ \   (    (   | |   | |   |   (   | |
 * _|  _|\___/ _|   \__|\__, |____/_)\___|\___/ _|  _|\__|_|  \___/ _|
 *                      ____/
 *
 * nortys.control
 * Websiten Statistik Tool
 *
 * Copyright (C) 2010 Johannes Keßler
 * nortys Gmbh
 * E3, 13
 * 68159 Mannheim
 *
 * @version: $Id: index.php 11 2010-01-12 14:31:05Z jk $
 */

mb_internal_encoding("UTF-8");

if(ini_get("magic_quotes_gpc") == 1)
    die('Magic quotes is set to "on", and system is not able to change it. Please update Your php.ini file');

 /**
 * load the main configuration
 */
require('conf/main.php');

/**
 * require the function.library.inc.php
 * this holds global functions
 */
require(PATH_LIB.'/function.library.php');

/**
 * set the error reporting
 */
if(DEBUG === true) {
	ini_set('error_reporting',8191); // E_ALL & E_STRICT
	ini_set('display_errors',true);
}
else {
	ini_set('error_reporting',8191); // E_ALL & E_STRICT
	ini_set('display_errors',false);
	ini_set('log_errors',true);
	ini_set('log_errors_max_len',"10M");
	ini_set('error_log',TMP_DIR.'/error/error.file');
}

/**
 * inlcude check and process before we output any content
 */
$includeFile = false;
if(!empty($_GET['p'])) {
	$check = validateString($_GET['p']);
	$check1 = file_exists('./site/script/'.$_GET['p'].'.php');
	if($check === true && $check1 === true) {
		$includeFile = './site/script/'.$_GET['p'].'.php';
		$template = $_GET['p'].'.html';
	}
	else {
		$includeFile = './site/script/error.php';
		$template = 'error.html';
	}
}
else {
	if(file_exists('./site/script/start.php')) {
		$includeFile = './site/script/start.php';
	}
	$template = 'start.html';
}

/**
 * setup smarty
 */
require_once(PATH_LIB.'/smarty/Smarty.class.php');
$smarty = new Smarty();
$smarty->caching = 0;
$smarty->template_dir = 'site/template';
$smarty->compile_dir = 'site/cache/';
$smarty->cache_dir = 'site/cache/';

/**
 * start a session
 * we only use cookies and do not allow the overwrite via get or post
 */
if(ini_set('session.use_only_cookies',true) === false ||
		ini_set('session.cookie_httponly',true) === false ||
		ini_set('session.use_cookies',true) === false) {
	die('Cant use session cookies');
}
$garbage_timeout = SESSION_LIFETIME + 300;
ini_set('session.gc_maxlifetime', $garbage_timeout);
// the % rate how often the session.gc is run
// http://de.php.net/manual/en/session.configuration.php#ini.session.gc-probability
ini_set('session.gc_probability',10); // 100 = everytime = 100%

session_save_path(TMP_DIR.'/session');
session_set_cookie_params(SESSION_LIFETIME);
session_name(SESSION_NAME);
session_start();
session_regenerate_id(true);

/**
 * database connection
 * wihtout it it would be not working
 */
require('./conf/db.php');
$mysql_con = mysql_connect(DB_HOST,DB_USER,DB_PASSWORD) OR die('Datenbankserver nicht erreichbar');
$mysql_sel = mysql_select_db(DB_DATABASE,$mysql_con) OR die('Datenbank konnte nicht selektiert werden');
mysql_query("SET NAMES 'utf8'");

// the main varible to store the data for the template
$data = array();

// load the script file
if($includeFile !== false) {
	require($includeFile);
}

// the template we are using now to load the css and stuff correctly
$smarty->assign(array('template_dir' => WEBROOT_PATH.'/site/template',
						'img_path' => WEBROOT_PATH.'/site/template/img',
						'template' => $template,
						'data' => $data));

if(!empty($data['_setHeader'])) {
	// this comes from the individual pages
	header($data['_setHeader']);
}

header('Content-type: text/html; charset=UTF-8');
header("Date: ".gmdate("D, d M Y H:i:s", time())." GMT");
header("Last-Modified: ".gmdate("D, d M Y H:i:s", time())." GMT");
$smarty->display('main.html');

?>
