<?php
include 'modules/common/master_include.php';
include 'modules/icalify_conferences.php';

$conferences = file('data/conferences/conferences.txt');

$users = get_users();

if(isset($_GET['user']) && in_array($_GET['user'], $users)) {
  $user = $_GET['user'];
}
else {
  $user = "all";
}
echo icalify_conferences($conferences, $user);
?>