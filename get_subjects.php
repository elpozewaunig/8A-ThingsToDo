<?php 

function get_subjects($subjects_array) { // contains [groups] and subjects
  
  $subjects = array();
  $group_subjects = array();
  
  foreach($subjects_array as $element) {
    if (preg_match('/\[.*?\]/', $element)) {  // regex matches everything in []
      $group_name = trim($element, '[] ');

      $group_subjects = str_getcsv( str_replace (' ', '', file_get_contents("data/groups/$group_name")), ',');
      
      $subjects = array_merge($subjects, $group_subjects);
    }
  else {
    $subjects[] = $element;
    } 
  }
  
  return $subjects;

}

 ?>