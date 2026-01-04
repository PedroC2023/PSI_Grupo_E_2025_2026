<?php

$this->title = 'Calendário de Eventos';

$this->registerCssFile('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.css');
$this->registerJsFile('https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/main.min.js', ['depends' => [\yii\web\JqueryAsset::class]]);
?>

<div id="calendar"></div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let calendarEl = document.getElementById('calendar');

        let calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: '/event/events-json',
            eventClick: function(info) {
                window.location.href = '/event/view?id=' + info.event.id;
            }
        });

        calendar.render();
    });
</script>
