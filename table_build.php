<?php

function table_build($input) {
  echo "<table>";
  echo "<tr class=\"head\"><td> Subject </td><td> UID </td><td> Description </td><td> Where? </td><td> Deadline </td></tr>";
  
  foreach ($input as $l) {
    if ($l!==PHP_EOL) {
      echo "<tr>". build_cells($l) ."</tr>";
    }
  }
  
  echo "</table>";
}

function build_cells($line) {
  $output="<td>";
  $output=$output.str_replace("|", "</td><td>", $line);
  $output=$output."</td>";
  return $output;
}

?>