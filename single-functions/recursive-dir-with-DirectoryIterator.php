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
* return recursive all data from the given directory
* @see http://www.php.net/manual/de/class.directoryiterator.php
* @author banana mail@bananas-playground.net
* @param string $directory The directory to read
* @return array $files
*/
function readDirRecusrive($directory) {
	$files = array();

	$it = new RecursiveIteratorIterator(new RecursiveDirectoryIterator('../'.STATIC_CACHE_PATH, FilesystemIterator::SKIP_DOTS), RecursiveIteratorIterator::CHILD_FIRST);

	foreach ($it as $file) {
		$files[] = $file->getPathName();
	}
	
	return $files;
}
?>