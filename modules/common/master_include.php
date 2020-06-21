<?php

// Includes common modules needed by pages to prevent functions from being redefined when modules call other necessary modules
// Some are just included here so that it is not necessary to include these modules scattered over the page, but just include this one file and then be able to use the functions.

include 'check_login.php';
include 'userlist_build.php';
include 'versionify.php';
include 'topbar.php';

?>