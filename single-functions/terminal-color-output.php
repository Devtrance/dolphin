<?php 
/**
 *  dolphin. Collection of useful PHP skeletons.
 *  Copyright (C) 2011  Johannes 'Banana' Keßler
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
 *
 * You should have received a copy of the
 * COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
 * along with this program.  If not, see http://www.sun.com/cddl/cddl.html
 */

/**
 * return given $string with ASCII commands to be colored in terminal
 * works with apple and unix, but not with windows
 *
 * usage: echo cO('Some Text','red');
 * new line is added automatically
 *
 * @param string $string The text to be colored
 * @param string $col The text color
 * @param string $bcol The background color. Default is not set
 * @param string $ret The formatted ( or not ) text
 */
function cO($string,$col,$bcol=false) {
	$ret = false;

	if(empty($string)) return $string;

	$_foregroundColors = array(
        'black'         => '0;30',
        'dark_gray'     => '1;30',
        'blue'          => '0;34',
        'light_blue'    => '1;34',
        'green'         => '0;32',
        'light_green'   => '1;32',
        'cyan'          => '0;36',
        'light_cyan'    => '1;36',
        'red'           => '0;31',
        'light_red'     => '1;31',
        'purple'        => '0;35',
        'light_purple'  => '1;35',
        'brown'         => '0;33',
        'yellow'        => '1;33',
        'light_gray'    => '0;37',
        'white'         => '1;37',
        'black_u'       => '4;30',   // underlined
        'red_u'         => '4;31',
        'green_u'       => '4;32',
        'yellow_u'      => '4;33',
        'blue_u'        => '4;34',
        'purple_u'      => '4;35',
        'cyan_u'        => '4;36',
        'white_u'       => '4;37'
    );
    $_backgroundColors = array(
        'black'         => '40',
        'red'           => '41',
        'green'         => '42',
        'yellow'        => '43',
        'blue'          => '44',
        'magenta'       => '45',
        'cyan'          => '46',
        'light_gray'    => '47'
    );

	if (isset($_foregroundColors[$col])) {
		$ret .= "\033[" . $_foregroundColors[$col] . "m";
	}
    if (isset($_backgroundColors[$bcol])) {
		$ret .= "\033[" . $_backgroundColors[$bcol] . "m";
	}

	if(!empty($ret)) {
		$ret .= $string."\033[0m";
	}
	else {
		$ret = $string;
	}

    return $ret."\n";
}
?>