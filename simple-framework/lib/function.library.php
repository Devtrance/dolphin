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
 * validate the given string with the given type. Optional check the string
 * length
 *
 * @param string $input The string to check
 * @param string $mode How the string should be checked
 * @param mixed $limit If int given the string is checked for length
 *
 * @see http://de.php.net/manual/en/regexp.reference.unicode.php
 * http://www.sql-und-xml.de/unicode-database/#pc
 *
 * the pattern replaces all that is allowed. the correct result after
 * the replace should be empty, otherwise are there chars which are not
 * allowed
 *
 */
 function validate($input,$mode='text',$limit=false) {
	// check if we have input
	$input = trim($input);

	if($input == "") return false;

	$ret = false;

	switch ($mode) {
		case 'mail':
			return self::check_email_address($input);
		break;

		case 'url':
			return filter_var($input,FILTER_VALIDATE_URL);
		break;

		case 'nospace':
			// text without any whitespace and special chars
			$pattern = '/[\p{L}\p{N}]/u';
		break;

		case 'nospaceP':
			// text without any whitespace and special chars
			// but with Punctuation
			$pattern = '/[\p{L}\p{N}\p{Po}]/u';
		break;

		case 'digit':
			// only numbers and digit
	  		$pattern = '/[\p{Nd}]/';
		break;

		case 'pageTitle':
			// text with whitespace and without special chars
			// but with Punctuation
			$pattern = '/[\p{L}\p{N}\p{Po}\p{Z}\s]/u';
		break;

		case 'text':
		default:
			$pattern = '/[\p{L}\p{N}\p{P}\p{S}\p{Z}\p{M}\s]/u';
	}

	$value = preg_replace($pattern, '', $input);
	#if($input === $value) {
	if($value === "") {
		$ret = true;
	}

	if(!empty($limit)) {
		# isset starts with 0
		if(isset($input[$limit])) {
			# too long
			$ret = false;
		}
	}

	return $ret;
}
?>
