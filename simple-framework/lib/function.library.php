<?php
/**
* dolphin. Collection of useful PHP skeletons.
* Copyright (C) 2009 Johannes 'Banana' Keßler
*
* This program is free software: you can redistribute it and/or modify
* it under the terms of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
*
* You should have received a copy of the
* COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
* along with this program.  If not, see http://www.sun.com/cddl/cddl.html
*/


/**
 * validate given string if it is in given format
 *
 * @param string $str
 * @param string $mode
 * @return bool
 */
function validateString($str,$mode='alnum') {
	$ret = false;
	if(!empty($str)) {
		$check = '';
		switch($mode) {
			case 'alnumWhitespace':
				$check = preg_replace('/[^\p{L}\p{N}\p{P}\s]/u','',$str);
				if($str === $check) {
					$ret = true;
				}
			break;

			case 'digit':
				$check = preg_replace('/[\p{^N}]/u','',$str);
				if($str === $check) {
					$ret = true;
				}
			break;

			case 'alnum':
			default:
				$check = preg_replace('/[^\p{L}\p{N}\p{P}]/u','',$str);
				if($str === $check) {
					$ret = true;
				}
		}
	}

	return $ret;
}
?>
