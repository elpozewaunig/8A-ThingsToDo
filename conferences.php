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
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link rel="icon" href="<?= icon ?>">
<link rel="apple-touch-icon" href="<?= touch_icon ?>">

<?php
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/common.css')."\">";
echo "<link rel=\"stylesheet\" href=\"".versionify('stylesheets/mobile.css')."\">";
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
  <div class="toggle" id="toggle-calendar" onclick="toggleMode('calendar')"> <img src="images/fa/calendar-alt.svg"> Calendar <noscript> (Needs JavaScript) </noscript> </div>
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

if (isset($_COOKIE['user']) == false || valid_user($_COOKIE['user']) == false) {
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

<div id="calendar"> <noscript> Calendar view needs JavaScript enabled to work. </noscript> </div>

<script>
  window.onload = function(){
    var calendarEl = document.getElementById('calendar');
    var calendar = new FullCalendar.Calendar(calendarEl, {
      events: [
        <?php 
        include "modules/jsonify_conferences.php";
        
        if (file_exists('data/conferences/archive.txt')) {
          $archive = file('data/conferences/archive.txt');
          echo jsonify_conferences($archive, $user).",";
        }
        echo jsonify_conferences($conferences, $user);
         ?>
        ],
      eventClick: function(event) {
        if (event.event.url) {
          event.jsEvent.preventDefault()
          window.open(event.event.url, "_blank");
          }
      },
      eventMouseEnter: function(mouseEnterInfo) {
        mouseEnterInfo.el.setAttribute('title', mouseEnterInfo.event.title);
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
      slotEventOverlap: false,
      firstDay: 6,
      hiddenDays: [0, 6],
      slotDuration: '00:20:00',
      slotMinTime: '07:00:00',
      slotMaxTime: '17:00:00',
      allDaySlot: false,
      nowIndicator: true
    });
    calendar.render();
    document.getElementById("calendar").style.display = "none";
  };
</script>

<div class="subscribe">  
<?php
echo '<a href="webcal://'.$_SERVER['HTTP_HOST'].'/ics.php?user='.$user.'" onclick="copy(this.getAttribute(\'href\'))"> <img src="images/fa/plus-square.svg"> Subscribe to this calendar </a>';
echo '<a href="ics.php?user='.$user.'" download="'.title.'_Conferences_'.$user.'.ics"> <img src="images/fa/download.svg"> Download calendar </a>';
?> 
</div>

<script>
function copy(text) {
  navigator.clipboard.writeText(text).then(function() {
    alert("The link has been copied to clipboard and can be pasted in an application.");
  },
  function() {  
  });
}
</script>

</div>

<?php 
include 'modules/bottombar.php';
 ?>

</body>
</html>