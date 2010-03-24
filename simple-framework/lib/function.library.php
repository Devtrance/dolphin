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
