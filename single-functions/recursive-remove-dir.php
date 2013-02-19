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
 * delete and/or empty a diretory
 *
 * $empty = true => empty the diretory but do not delete it
 *
 * @param string $directory
 * @param boolean $empty
 * @param int $fTime If not false remove files older then this value in sec.
 * @return boolean
 */
function recursive_remove_directory($directory, $empty=false,$fTime=false) {
	// if the path has a slash at the end we remove it here
	if(substr($directory,-1) == '/') {
		$directory = substr($directory,0,-1);
	}

	// if the path is not valid or is not a directory ...
	if(!file_exists($directory) || !is_dir($directory)) {
		// ... we return false and exit the function
		return false;

	// ... if the path is not readable
	}elseif(!is_readable($directory)) {
		// ... we return false and exit the function
		return false;

	// ... else if the path is readable
	}
	else {
		// we open the directory
		$handle = opendir($directory);

		// and scan through the items inside
		while (false !== ($item = readdir($handle))) {
			// if the filepointer is not the current directory
			// or the parent directory
			//if($item != '.' && $item != '..' && $item != '.svn') {
			if($item[0] != '.') {
				// we build the new path to delete
				$path = $directory.'/'.$item;

				// if the new path is a directory
				if(is_dir($path)) {
				   // we call this function with the new path
					recursive_remove_directory($path);

				// if the new path is a file
				}
				else {
					// we remove the file
					if($fTime !== false && is_int($fTime)) {
						// check filemtime
						$ft = filemtime($path);
						$offset = time()-$fTime;
						if($ft <= $offset) {
							unlink($path);
						}
					}
					else {
						unlink($path);
					}
				}
			}
		}
		// close the directory
		closedir($handle);

		// if the option to empty is not set to true
		if($empty == false) {
			// try to delete the now empty directory
			if(!rmdir($directory)) {
				// return false if not possible
				return false;
			}
		}
		// return success
		return true;
	}
}

?>
