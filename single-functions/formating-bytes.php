<?php
/**
 *  dolphin. Collection of useful PHP skeletons.
 *  Copyright (C) 2012  Johannes 'Banana' Keßler
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the COMMON DEVELOPMENT AND DISTRIBUTION LICENSE
 *
 * You should have received a copy of the
 * COMMON DEVELOPMENT AND DISTRIBUTION LICENSE (CDDL) Version 1.0
 * along with this program.  If not, see http://www.sun.com/cddl/cddl.html
 */

/**
 * convert given bytes into human readable string
 * @author banana mail@bananas-playground.net
 * @author Guillaume Amringer g.amringer@gmail.com
 *
 * @param int $amount Bytes
 * @param string $unit
 * @param int $decimals
 * @param int $powerMax
 * @param boolean $binary
 * @param int $powerBase
 * @return string Human readable format
 */
function unit($amount, $unit, $decimals = 2, $powerMax = 100, $binary = true, $powerBase = 0) {
    if ($binary) {
        $powerBase = $powerBase == 0 ? 1024 : $powerBase;
        $prefixes = array('','Ki','Mi','Gi','Ti','Pi','Ei','Zi','Yi');
    } else {
        $powerBase = $powerBase == 0 ? 1000 : $powerBase;
        $prefixes = array('','K','M','G','T','P','E','Z','Y');
    }

    $power = 0;
    while($amount > $powerBase && $power < $powerMax) {
        $power++;
        $amount /= $powerBase;
    }

    return round($amount, $decimals) . ' ' . $prefixes[$power] . $unit;
}

?>