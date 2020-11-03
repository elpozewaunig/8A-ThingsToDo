<?php
include 'modules/common/master_include.php';
check_login();
check_user();
?>

<!DOCTYPE html>
<html>

<head>
<title> <?= title ?> - Conferences </title>
<meta charset="utf-8">

<link rel="icon" href="<?= icon ?>">
<link rel="apple-touch-icon" href="<?= touch_icon ?>">

<?php
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/common.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/table.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/tablefilter_override.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/subjects.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/conferences.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/fullcalendar_override.css')."\">";

echo "<noscript> <link rel=\"stylesheet\" href=\"".versionify('stylesheets/table_nojs.css')."\"> </noscript>"; // add fallback stylesheet if JS is disabled

echo "<link rel=\"stylesheet\" media=\"print\" href=\"".versionify('stylesheets/print.css')."\">";
?>

<script src="node_modules/tablefilter/dist/tablefilter/tablefilter.js"></script>
<script src="node_modules/fullcalendar/main.js"></script>
<link href="node_modules/fullcalendar/main.css" rel="stylesheet">
  
</head>

<body>
  
<?php
generate_topbar();
?>

<br>

<div class="content">

<div class="toggle-container">
  <div class="toggle current" id="toggle-list" onclick="toggleMode('list')"> <img src="images/fa/list-ul.svg"> List </div>
  <div class="toggle" id="toggle-calendar" onclick="toggleMode('calendar')"> <img src="images/fa/calendar-alt.svg"> Calendar </div>
</div>

<script>
  function toggleMode(element) {
    if (element == "list") {
      activate = "list";
      disable = "calendar";
    }
    else if (element == "calendar") {
      activate = "calendar";
      disable = "list";
    }
      var activate_el = document.getElementById(activate);
      var disable_el = document.getElementById(disable);
      activate_el.style.display = "block";
      disable_el.style.display =  "none";
      
      var toggle_activate = document.getElementById("toggle-"+activate);
      var toggle_disable = document.getElementById("toggle-"+disable);
      toggle_activate.classList.add("current");
      toggle_disable.classList.remove("current");
      
  }
</script>

<div id="list">
<?php 
include 'modules/conferences_build.php';
  
$conferences = file('data/conferences/conferences.txt');
      
if (isset($_COOKIE['user']) == false) {
  $user = "all";
}
else {
  $user = $_COOKIE['user'];
}

conferences_build($conferences, $user);
?>

<script data-config>
    var filtersConfig = {
        base_path: 'node_modules/tablefilter/dist/tablefilter/',
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

<div id="calendar"></div>

<script>
  window.onload = function(){
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      events: [
        <?php 
        include "modules/jsonify_conferences.php";
        echo jsonify_conferences($conferences, $user);
         ?>
        ],
      eventClick: function(event) {
        if (event.event.url) {
          event.jsEvent.preventDefault()
          window.open(event.event.url, "_blank");
          }
      },
      height: 'auto',
      initialView: 'timeGridWeek',
      locale: 'de',
      headerToolbar: {
        left: 'timeGridWeek,timeGridDay',
        center: 'title'
      },
      titleFormat: { // will produce something like "Tuesday, September 18, 2018"
        day: 'numeric',
        month: 'numeric',
        year: 'numeric',
      },
      dayHeaderFormat: {
        day: 'numeric',
        month: 'numeric',
      },
      slotLabelFormat: {
        hour: 'numeric',
        minute: '2-digit',
        omitZeroMinute: false,
        meridiem: false,
        hour12: false
      },
      eventTimeFormat: {
        hour: 'numeric',
        minute: '2-digit',
        hour12: false,
        meridiem: false
      },
      firstDay: 1,
      hiddenDays: [0, 6],
      slotDuration: '00:20:00',
      slotMinTime: '07:00:00',
      slotMaxTime: '14:00:00',
      allDaySlot: false
    });
    calendar.render();
    document.getElementById("calendar").style.display = "none";
  };
</script>

</div>

<?php 
include 'modules/bottombar.php';
 ?>

</body>
</html>