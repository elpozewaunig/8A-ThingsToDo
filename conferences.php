<?php
session_start();
if (isset($_SESSION['login_successful']) || $_SESSION['login_successful']) {
}
else{
  header("Location: index.php");
  exit();
  }
  
$_SESSION['origin'] = "conferences.php";
?>

<!DOCTYPE html>
<html>

<head>
<title>6A - Conferences</title>
<meta charset="utf-8">
<link rel="icon" href="icon.svg">
<link rel="apple-touch-icon" href="touch-icon.png">


<link rel="stylesheet" href="stylesheets/common.css">
<link rel="stylesheet" href="stylesheets/table.css">
<link rel="stylesheet" href="stylesheets/subjects.css">
<link rel="stylesheet" href="stylesheets/conferences.css">
  
</head>

<body>
  
<?php
include 'topbar.php';
generate_topbar();
?>

<br>
  
<?php 
include 'conferences_build.php';
  
$conferences = file('data/conferences/conferences.txt');
      
if (isset($_COOKIE['user']) == false) {
  $user = "all";
}
else {
  $user = $_COOKIE['user'];
}

conferences_build($conferences, $user);
?>

<script src="js/tablefilter/tablefilter.js"></script>

<script data-config>
    var filtersConfig = {
        base_path: 'js/tablefilter/',
        state: {
          types: ['cookie'],
          filters: true
        },
        col_0: 'select',
        col_1: 'none',
        col_2: 'none',
        col_3: 'none',
        popup_filters: true,
        alternate_rows: true,
        rows_counter: false,
        btn_reset: false,
        loader: false,
        status_bar: false,
        mark_active_columns: true,
        highlight_keywords: false,
        col_types: [
            'string', 'string', 'string', { type: 'date', locale: 'de' }
        ],
        extensions: [{ name: 'sort',
          types: ['none', 'none', 'none', { type: 'date', locale: 'de' }]
         }]
    };

    var tf = new TableFilter('conferences', filtersConfig);
    tf.init();

</script>  
   
</body>
</html>