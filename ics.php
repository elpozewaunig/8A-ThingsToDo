<?php
include 'modules/common/master_include.php';
include 'modules/icalify_conferences.php';

$conferences = file('data/conferences/conferences.txt');
if(file_exists('data/conferences/archive.txt')) {
  $archive = file('data/conferences/archive.txt');
  $data = array_merge($conferences, $archive);
}
else {
  $data = $conferences;
}

if(isset($_GET['user']) && valid_user($_GET['user'])) {
  $user = $_GET['user'];
}
else {
  $user = "all";
}

header('Content-Type: text/calendar');
header('Content-Disposition: attachment; filename="'.title.'_Conferences_'.$user.'.ics"');

echo icalify_conferences($data, $user);
?>