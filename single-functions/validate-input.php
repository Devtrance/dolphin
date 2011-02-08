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
 * validate if given string is correct
 * this can easily exapnded with more match patterns
 *
 * @param string $string
 * @param string $mode
 */
 function validateInput($string,$mode) {
	$ret = false;
    if(!empty($string) && !empty($mode)) {
		switch ($mode) {
			case 'nospace':
				$pattern = '/[^\p{L}\p{N}\p{P}]/u';
				$value = preg_replace($pattern, '', $string);
				if($string === $value) {
					$ret = true;
				}
			break;
			case 'digit':
				$pattern = '/[^\p{N}]/u';
				$value = preg_replace($pattern, '', $string);
				if($string === $value) {
					$ret = true;
				}
			break;
    		case 'text':
				$pattern = '/[^\p{L}\p{N}\p{P}]/u';
				$value = preg_replace($pattern, '', $string);
				if($string === $value) {
					$ret = true;
				}
			break;
		}
    }
    return $ret;
}
?>
