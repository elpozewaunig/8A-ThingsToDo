<?php
include 'check_login.php';
check_login();
?>

<!DOCTYPE html>
<html>

<head>
<title>6A - Conferences</title>
<meta charset="utf-8">

<link rel="icon" href="icon.svg">
<link rel="apple-touch-icon" href="touch-icon.png">

<?php
include 'versionify.php';

echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/common.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/table.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/subjects.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/conferences.css')."\">";

echo "<noscript> <link rel=\"stylesheet\" href=\"".versionify('stylesheets/table_nojs.css')."\"> </noscript>"; // add fallback stylesheet if JS is disabled

echo "<link rel=\"stylesheet\" media=\"print\" href=\"".versionify('stylesheets/print.css')."\">";
?>
  
</head>

<body>
  
<?php
include 'topbar.php';
generate_topbar();
?>

<br>

<div class="content">

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
          types: ['local_storage'],
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
            'string', 'string', 'string', { type: 'date', format: ['{weekday}, {dd}.{MM}.{yyyy}, {hh}:{mm}'] }
        ],
        extensions: [{ name: 'sort',
          types: ['none', 'none', 'none', { type: 'date', format: ['{weekday}, {dd}.{MM}.{yyyy}, {hh}:{mm}'] }]
         }]
    };

    var tf = new TableFilter('conferences', filtersConfig);
    tf.init();

</script>

</div>

<?php 
include 'bottombar.php';
 ?>

</body>
</html>