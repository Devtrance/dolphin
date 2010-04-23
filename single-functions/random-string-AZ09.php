<?php
/**
 *  dolphin. Collection of usefull PHP skeletons.
 *  Copyright (C) 2009  Johannes 'Banana' Keßler
 *
 *  This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * create a random A-Z 0-9 string with the given length
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
