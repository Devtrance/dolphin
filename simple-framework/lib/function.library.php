<?php
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
