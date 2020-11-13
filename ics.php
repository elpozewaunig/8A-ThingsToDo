<?php
include 'modules/common/master_include.php';
include 'modules/icalify_conferences.php';

header('Content-Type: text/calendar');

$conferences = file('data/conferences/conferences.txt');

if(isset($_GET['user']) && valid_user($_GET['user'])) {
  $user = $_GET['user'];
}
else {
  $user = "all";
}
echo icalify_conferences($conferences, $user);
?>