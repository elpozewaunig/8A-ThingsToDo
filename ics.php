<?php
include 'modules/common/master_include.php';
include 'modules/icalify_conferences.php';

$conference_path = 'data/conferences/conferences.txt';
$archive_path = 'data/conferences/archive.txt';

if(file_exists($conference_path)) {
  $conferences = file($conference_path);
}
else {
  $conferences = [];
}

if(file_exists($archive_path)) {
  $archive = file($archive_path);
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