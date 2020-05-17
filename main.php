<?php
session_start();
if (isset($_SESSION['login_successful']) && $_SESSION['login_successful']) {
}
else{
  header("Location: index.php");
  exit();
}

$_SESSION['origin'] = "main.php";
?>

<!DOCTYPE html>
<html>

<head>
<title>6A - Things To Do</title>
<meta charset="utf-8">
<link rel="icon" href="icon.svg">
<link rel="apple-touch-icon" href="touch-icon.png">


<link rel="stylesheet" href="stylesheets/common.css">
<link rel="stylesheet" href="stylesheets/table.css">
<link rel="stylesheet" href="stylesheets/subjects.css">

<link rel="stylesheet" media="print" href="stylesheets/print.css">
  
</head>

<body>
  
  <?php
  include 'topbar.php';
  generate_topbar();
  ?>
  
  <br>
  
<?php 
include 'table_build.php';
  
$work = file('data/work/work.txt');
      
if (isset($_COOKIE['user']) == false) {
  $user = "all";
}
else {
  $user = $_COOKIE['user'];
}

table_build($work, $user);
?>

<script src="js/tablefilter/tablefilter.js"></script>

<script data-config>
<?php
if ($user == "all") {
echo <<<TABLEFILTERCONFIG
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
TABLEFILTERCONFIG;
}
else {
echo <<<TABLEFILTERCONFIG
    var filtersConfig = {
        base_path: 'js/tablefilter/',
        state: {
          types: ['local_storage'],
          filters: true
        },
        col_0: 'select',
        col_1: 'select',
        col_2: 'none',
        col_3: 'none',
        col_4: 'none',
        popup_filters: true,
        alternate_rows: true,
        rows_counter: false,
        btn_reset: false,
        loader: false,
        status_bar: false,
        mark_active_columns: true,
        highlight_keywords: false,
        col_types: [
            'string', 'string', 'string', 'string', { type: 'date', locale: 'de' }
        ],
        extensions: [{ name: 'sort',
          types: ['none', 'none', 'none', 'none', { type: 'date', locale: 'de' }]
         }]
    };
TABLEFILTERCONFIG;
}
?>

    var tf = new TableFilter('work', filtersConfig);
    tf.init();

</script>  
   
</body>
</html>