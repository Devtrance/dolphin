<?php
/**
 *  dolphin. Collection of usefull PHP skeletons.
 *  Copyright (C) 2009  Johannes 'Banana' Keßler
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
 *
 * You should have received a copy of the
 * COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
 * along with this program.  If not, see http://www.sun.com/cddl/cddl.html
 */

/**
 * create a random A-Z 0-9 string with the given length
 * @author banana mail@bananas-playground.net
 * @param string $lentgh Default 5
 * @return string The random string
 */
function randomAZ09($length=5) {
	$str = '';
	for ($i=0; $i<$length; $i++) {
		$d = rand(1,30)%2;
		$str .= $d ? chr(rand(65,90)) : chr(rand(48,57));
	}

	return $str;
}

?>
