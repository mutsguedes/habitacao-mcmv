<?php

use yii\helpers\Url;
?>
<html>
    <head>
        <meta charset='utf-8' />
        <script>
            function eventDialog(url, act) {

            var action = '';
            var form = $('#modal .modal-body form');
            if (url == false) {

            action = '&action=' + act;
            url = form.attr('action');
            }

            jQuery.ajax({

            type: 'POST',
                    url: url,
                    data: form.serialize() + action,
                    cache: false,
                    dataType: 'json',
                    success: function (data) {

                    if (data.status == 'fail') {

                    $('#modal .modal-body').html(data.content);
                    $('#modal .modal-footer #save').off().on('click', function (event) {

                    event.preventDefault();
                    eventDialog(false, $(this).attr('name'));
                    });
                    } else {

                    $('#modal .modal-body').html(data.content);
                    if (data.status == 'success') {
                    $('#calendar').fullCalendar('refetchEvents');
                    $('#modal').modal('hide');
                    $('#modal .modal-body').html('<div class=\"progress progress-striped active m-n text-center\"><div class=\"progress-bar progress-bar-success\" style=\"width:100%;\"></div></div>');
                    }

                    };
                    }

            });
            }
            document.addEventListener('DOMContentLoaded', function () {
            var initialLocaleCode = 'pt-br';
            var calendarEl = document.getElementById('calendareve');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
                    initialDate: '2020-09-12',
                    locale: initialLocaleCode,
                    navLinks: true, // can click day/week names to navigate views
                    selectable: true,
                    selectMirror: true,
                    select: async function (arg) {
                    calendar.unselect();
                    },
                     eventClick: function (arg) {
                         
                     },
                    events: [{
                    url: '<?= Url::to('events/list-events'); ?>'
                    }],
//                    eventRender: function (event, element) {
//                        if (event.end === null) {
//                            var tooltip = '<b>' + event.title + '</b><br/>De: ' + moment(event.start).format('ll') + '<br /><br />' + event.text;
//                        } else if (event.allDay === true) {
//                            var tooltip = '<b>' + event.title + '</b><br/>De: ' + moment(event.start).format('ll') + '<br />Até: ' + moment(event.end).format('ll') + '<br /><br />' + event.text;
//                        } else if (event.allDay === true) {
//                            var tooltip = '<b>' + event.title + '</b><br/>De: ' + moment(event.start).format('lll') + '<br />Até: ' + moment(event.end).format('lll') + '<br /><br />' + event.text;
//                        }
//                        $(element).attr('data-original-title', tooltip);
//                        $(element).tooltip({container: 'body', html: true});
//                    },
//                
                    select: async function (arg) {
                    $('#modal').modal('show');
                    $('#modal .modal-title').html('Editar Agenda');
                    eventDialog('<?= Url::to('eventsupdate-ajax'); ?>?id=' + event.id + '&ajax=event');
                    }
            });
            calendar.render();
            });
        </script>
    </head>
    <body>
        <div id='calendareve'></div>

    </body>
</html>