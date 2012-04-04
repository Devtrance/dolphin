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
 * simple HTTP auth method with PHP
 * more details can be found here:
 * http://php.net/manual/en/features.http-auth.php
 */

if (!isset($_SERVER['PHP_AUTH_USER'])) {
    header('WWW-Authenticate: Basic realm="My secret base"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'You canceled the auth process. Reload the page to get the box again.';
    exit;
} else {
    echo "<p>Hello ".$_SERVER['PHP_AUTH_USER'].".</p>";
    echo "<p>You entered ".$_SERVER['PHP_AUTH_PW']." as your password.</p>";
}
?>