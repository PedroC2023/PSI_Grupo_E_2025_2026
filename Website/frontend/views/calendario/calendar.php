php
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
                // Prefer explicit id from the event
                const id = info.event.id || info.event.extendedProps?.id;
                if (id) {
                    window.location.href = '/calendario/view?id=' + encodeURIComponent(id);
                    return;
                }

                // Fallback: find events on the same day and navigate to first found
                const clickedDay = info.event.start ? info.event.start.toISOString().slice(0,10) : null;
                if (clickedDay) {
                    const sameDayEvents = calendar.getEvents().filter(e => {
                        return e.start && e.start.toISOString().slice(0,10) === clickedDay && (e.id || e.extendedProps?.id);
                    });
                    if (sameDayEvents.length > 0) {
                        const targetId = sameDayEvents[0].id || sameDayEvents[0].extendedProps.id;
                        window.location.href = '/calendario/view?id=' + encodeURIComponent(targetId);
                    }
                }
            }
        });

        calendar.render();
    });
</script>