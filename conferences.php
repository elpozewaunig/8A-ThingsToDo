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
  var renderEvent = new Event('render');

  document.addEventListener('DOMContentLoaded', function() {
    if( typeof sessionStorage.getItem('conferences-tab') == 'string') {
      toggleMode(sessionStorage.getItem('conferences-tab'));
    }
    else {
      toggleMode('list');
    }
 	}, false);
  
  window.addEventListener('resize', function() {
    if(activate == "calendar") {
      calendar_el = document.getElementById('calendar');
      calendar_el.dispatchEvent(renderEvent);
    }
  });

  function toggleMode(element) {
    if (element == "list") {
      activate = "list";
      disable = "calendar";
    }
    else if (element == "calendar") {
      activate = "calendar";
      disable = "list";
    }

      sessionStorage.setItem('conferences-tab', activate);
    
      var activate_el = document.getElementById(activate);
      var disable_el = document.getElementById(disable);
      activate_el.style.display = "block";
      disable_el.style.display =  "none";
      
      var toggle_activate = document.getElementById("toggle-"+activate);
      var toggle_disable = document.getElementById("toggle-"+disable);
      toggle_activate.classList.add("current");
      toggle_disable.classList.remove("current");
      
      activate_el.dispatchEvent(renderEvent);
  }
</script>

<div id="list">
<?php 
include 'modules/conferences_build.php';

$path = 'data/conferences/conferences.txt';
if(file_exists($path)) {  
  $conferences = file($path);
}
else {
  $conferences = [];
}

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
        col_0: 'checklist',
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
          types: ['string', 'none', 'none', { type: 'date', format: ['{weekday}, {dd}.{MM}.{yyyy}, {hh}:{mm}'] }]
         }]
    };

    var tf = new TableFilter('conferences', filtersConfig);
    tf.init();

</script>

</div>

<div id="calendar"> <noscript> Calendar view needs JavaScript enabled to work. </noscript> </div>

<script>
  var listenEl = document.getElementById('calendar');

  listenEl.addEventListener('render', function(){
    
    if(typeof calendar !== 'undefined') {
      view = calendar.view;
    }
    
    var calendarEl = document.getElementById('calendar');
    calendar = new FullCalendar.Calendar(calendarEl, {
      events: [
        <?php 
        include "modules/jsonify_conferences.php";
        
        $archive_path = 'data/conferences/archive.txt';
        if (file_exists($archive_path)) {
          $archive = file($archive_path);
          echo jsonify_conferences($archive, $user).",";
        }
        echo jsonify_conferences($conferences, $user);
         ?>
        ],
      eventClick: function(event) {
        if (event.event.url) {
          event.jsEvent.preventDefault();
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
      titleFormat: {
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
      slotMaxTime: '20:00:00',
      allDaySlot: false,
      nowIndicator: true
    });
    calendar.render();
    
    if(typeof view !== 'undefined') {
      calendar.changeView(view.type, view.currentStart);
    }
    
  }, false);
</script>

<div class="subscribe">  
<?php
echo '<a href="webcal://'.$_SERVER['HTTP_HOST'].'/ics.php?user='.$user.'" onclick="copy(this.getAttribute(\'href\'))"> <img src="images/fa/plus-square.svg"> Subscribe to this calendar </a>';
echo '<a href="ics.php?user='.$user.'" download> <img src="images/fa/download.svg"> Download calendar </a>';
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