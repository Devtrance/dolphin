<?php

/**
 *  dolphin. Collection of useful PHP skeletons.
 *  Copyright (C) 2013  Johannes 'Banana' Keßler
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
 *
 * You should have received a copy of the
 * COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
 * along with this program.  If not, see http://www.sun.com/cddl/cddl.html
 */


/**
 * convert bash terminal color codes to html element with a css class
 * works with this colour echo function: https://github.com/jumpin-banana/klimbim/blob/master/bash/colour-text-echo.sh
 * eg. the $string as a direct return from the system call which return a string formatted with the above
 * colour echo function.
 *
 * it can work with other functions but this is not tested.
 *
 * your can change the replace text with the html code you need. Also the css classes are needed.
 */
function bashColortoHtml($string) {
	$ret = false;
	
	if(!empty($string)) {
		$_colorPattern = array(
			'/\\033\[1;33m(.*?)\\033\[0m/s',
			'/\\033\[0;31m(.*?)\\033\[0m/s',
			'/\\033\[0;34m(.*?)\\033\[0m/s',
			'/\\033\[0;36m(.*?)\\033\[0m/s',
			'/\\033\[0;35m(.*?)\\033\[0m/s',
			'/\\033\[0;33m(.*?)\\033\[0m/s',
			'/\\033\[1;37m(.*?)\\033\[0m/s',
			'/\\033\[0;30m(.*?)\\033\[0m/s',
			'/\\033\[0;32m(.*?)\\033\[0m/s'
		);
		$_colorReplace = array(
			'<span class="yellow">$1</span>',
			'<span class="red">$1</span>',
			'<span class="blue">$1</span>',
			'<span class="cyan">$1</span>',
			'<span class="purple">$1</span>',
			'<span class="brown">$1</span>',
			'<span class="white">$1</span>',
			'<span class="black">$1</span>',
			'<span class="green">$1</span>'
		);

		$ret = preg_replace($_colorPattern, $_colorReplace, $string);
	}

	return $ret;
}

?>

