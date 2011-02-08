<?php
/**
 *  dolphin. Collection of usefull PHP skeletons.
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
* return recursive all data from the given directory
* @author banana mail@bananas-playground.net
* @param string $directory The directory to read
* @return array $files
*/
function getSubFiles($directory) {
	$files = array();

	$dh = opendir($directory);
	while(false !== ($file = readdir($dh))) {
		if($file[0] ==".") continue;

		if(is_file($directory."/".$file)) {
			array_push($files, $directory."/".$file);
		}
		else {
			$files = array_merge($files, getSubFiles($directory."/".$file));
		}
	}
	closedir($dh);
	return $files;
}
?>
