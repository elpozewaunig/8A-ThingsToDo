<?php

function icalify_conferences($input, $user) {
  
  include_once 'get_subjects.php';
  include_once 'constants.php'; // contains array of all subjects
  
  if ($user !== "all") {
    $user_subjects = explode(', ', file_get_contents("data/users/$user"));
    $subjects = get_subjects($user_subjects); // resolves groups to individual subjects
  }
  else {
    $subjects = SUBJECTS; // subjects as defined in constants.php
  }
  
  $json = "BEGIN:VCALENDAR\r\n"."VERSION:2.0\r\n"."PRODID:-//elpozewaunig//8A-ThingsToDo\r\n"."METHOD:PUBLISH\r\n";
  
  foreach($input as $l) {
    if($l !== PHP_EOL) {
      $json = $json.build_event($l, $subjects);
    }
  }
  
  $json = $json."END:VCALENDAR";
  
  return $json;
  
}

function build_event($line, $subjects) {

  $cell_array = str_getcsv($line,"|");
  $cell_array = array_map("trim", $cell_array);

  if(in_array($cell_array[0], $subjects ))  { // only show item if subject is enabled
    
    $output = "BEGIN:VEVENT\r\n";
  
    // Properties
    
    $hash_input = "";
    foreach($cell_array as $e) {
      $hash_input = $hash_input.$e;
    }
    $output = $output."UID:".hash('sha1', $hash_input)."\r\n";
    
    $output = $output."SUMMARY:".$cell_array[0]." - ".$cell_array[1]."\r\n";
    $output = $output."DESCRIPTION:".$cell_array[1]."\r\n";
        
    if(filter_var($cell_array[2], FILTER_VALIDATE_URL)) {
      $output = $output."URL:".$cell_array[2]."\r\n";
    }
    
    $output = $output."DTSTAMP:".icalify_date($cell_array[3])."\r\n";
    $output = $output."DTSTART:".icalify_date($cell_array[3])."\r\n";
        
    if(!array_key_exists(4, $cell_array)) {
      $output = $output."DTEND:".icalify_date(add_to_date($cell_array[3], "+1 hour"))."\r\n";
    }
    elseif($cell_array[4] == '#') {
      $output = $output."DTEND:".icalify_date(add_to_date($cell_array[3], "+".lesson_length))."\r\n"; // lesson length is defined in config.txt
    }
    else {
      $output = $output."DTEND:".icalify_date($cell_array[4])."\r\n";
    }
      

    $output = $output."END:VEVENT\r\n";
    
    return $output;
  }
}

function icalify_date($datestring) {
  $timestamp = date_timestamp_get( date_create_from_format("d.m.Y, H:i", $datestring) );
  $converted_date = date("Ymd", $timestamp)."T".date("His", $timestamp);
  
  return $converted_date;
}

function add_to_date($datestring, $addition) {
  $timestamp = date_timestamp_get( date_create_from_format("d.m.Y, H:i", $datestring) );
  $new_timestamp = strtotime($addition, $timestamp);
  
  $date = date("d.m.Y, H:i", $new_timestamp);
  
  return $date;
}

?>