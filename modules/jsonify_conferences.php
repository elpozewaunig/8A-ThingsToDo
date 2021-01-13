<?php

function jsonify_conferences($input, $user) {
  
  include_once 'get_subjects.php';
  include_once 'constants.php'; // contains array of all subjects
  
  if ($user !== "all") {
    $user_subjects = explode(', ', file_get_contents("data/users/$user"));
    $subjects = get_subjects($user_subjects); // resolves groups to individual subjects
  }
  else {
    $subjects = SUBJECTS; // subjects as defined in constants.php
  }
  
  $json = "";
  
  foreach($input as $l) {
    if($l !== PHP_EOL) {
      $json = $json.build_event($l, $subjects);
    }
  }
  
  $json = trim($json, ', ');
  
  return $json;
  
}

function build_event($line, $subjects) {
  
  $output = "{";
  
  $cell_array = str_getcsv($line,"|");
  $cell_array = array_map("trim", $cell_array);
  
  if(in_array($cell_array[0], $subjects ))  { // only show item if subject is enabled
      
    for ($i = 0; $i < count($cell_array); $i++) { // cycles through every element of one line
      
      if($i == 0) {
        $output = $output."title: '".$cell_array[$i]." - ".$cell_array[1]."', ";
        $output = $output."classNames: ['subject', '".$cell_array[$i]."'], ";
      }
      elseif($i == 2) {
        if(filter_var($cell_array[$i], FILTER_VALIDATE_URL)) {
          $output = $output."url: '".$cell_array[$i]."', ";
        }
      }
      elseif($i == 3) {
        $output = $output."start: '".jsonify_date($cell_array[$i])."', ";
      }
      elseif($i == 4) {
        if($cell_array[$i] == '#') {
          $output = $output."end: '".jsonify_date(add_to_date($cell_array[3], "+".lesson_length))."'"; // lesson length is defined in config.txt
        }
        else {
          $output = $output."end: '".jsonify_date($cell_array[$i])."'";
        }
      }
      
    }
  }
  
  $output = $output."}, ";
  
  return $output;
}

function jsonify_date($datestring) {
  $timestamp = date_timestamp_get( date_create_from_format("d.m.Y, H:i", $datestring) );
  $converted_date = date("Y-m-d", $timestamp)."T".date("H:i:s", $timestamp);
  
  return $converted_date;
}

function add_to_date($datestring, $addition) {
  $timestamp = date_timestamp_get( date_create_from_format("d.m.Y, H:i", $datestring) );
  $new_timestamp = strtotime($addition, $timestamp);
  
  $date = date("d.m.Y, H:i", $new_timestamp);
  
  return $date;
}

?>