<?php
$title = '';
$css = [
    'assets/admin/css/plugins/dataTables/datatables.min.css'
];
$script = [
    'assets/admin/js/plugins/dataTables/datatables.min.js'
];
require APP . 'view/admin/_templates/initFile.php';
?>

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="font-awesome/css/font-awesome.css" rel="stylesheet">

<link href="css/animate.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <i class="fa fa-users fa-3x pull-right icon-heading"></i>
        <h2>Agenda</h2>
    </div>
    <div class="col-md-12 m-t-md">
        <div class=" ">
            <div class="ibox-content">
                <div class="ibox-title" style="border: none;
                                            display: flex;
                                            justify-content: end;
                                            margin: 10px auto;
                                            padding: 10px 0;">
                    <a href="<?= URL_ADMIN ?>/agenda/novo" class="btn btn-primary" style="width: 142px;">Novo</a>
                </div>
                <div id="calendar"></div>
            </div>
        </div>
        <!-- Button trigger modal -->
        <button hidden style="display: none" type="button" class="btn btn-primary" id="btn-modal" data-toggle="modal" data-target="#exampleModal">
        </button>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title" id="exampleModalLabel"></h1>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>

<script>
    dados = <?= $response ?>

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            height: 'auto',
            locale: 'pt',
            headerToolbar: {
                center: 'dayGridMonth,timeGridWeek'
            }, // buttons for switching between views            },
            views: {
                timeGridFourDay: {
                    type: 'timeGrid',
                }
            },
            plugins: ['interaction', 'dayGrid', 'timeGrid'],

            dateClick: function(info) {
                alert('(OBS: Essa eu não fiz) - Aqui eu redireciono para para a rota /novo e posso mandar a data para ficar já preenchida... DATA: ' + info.dateStr);
                calendar.refetchEvents();
            },

            eventClick: function(info) {
                $(".modal-title").text(info.event.title)
                $(".modal-body").html('<span>' + info.event._def.extendedProps.description + '</span>' + '<br>' + '<small>' + info.event._def.extendedProps.date__ + '</small>')
                $("#btn-modal").click()
                console.log();
            },

            events: function(info, successCallback, failureCallback) {
                successCallback(dados);
            },
            eventMouseEnter: function(info) {
                showHandleEvents(info);
            },
            eventMouseLeave: function(info) {
                hideHandleEvents(info);
            },
            extraParams: function() {
                return {
                    cachebuster: new Date().valueOf()
                };
            },
        });

        calendar.render();
    });

    function showHandleEvents(info) {

        console.log(info.event.id);
        //DIV HANDLE EVENT
        let div = document.createElement('div');
        div.setAttribute("id", "handle_event");
        div.style.cssText = 'display:inline;';
        //BUTTON EDIT
        let button_edit = document.createElement('button');
        button_edit.setAttribute("id", "edit_event");
        // button_edit.setAttribute("href", "<?= URL_ADMIN ?>/agenda/editar/" + info.event.id + ")");
        button_edit.style.cssText = 'padding-left:5px;padding-right:5px;background:transparent;border:none;border-right: 1px solid #ccc;color:white;';

        button_edit.setAttribute("onclick", "update(" + info.event.id + ")");

        let icon_edit = document.createElement('i');
        icon_edit.setAttribute("class", "fa fa-pen");

        button_edit.appendChild(icon_edit);
        //BUTTON DELETE
        let button_delete = document.createElement('button');
        button_delete.setAttribute("id", "delete_event");

        button_delete.setAttribute("onclick", "deletar(" + info.event.id + ")");
        button_delete.style.cssText = 'padding-left:5px;padding-right:5px;background:transparent;border:none;border-right: 1px solid #ccc;color:white;';

        let icon_delete = document.createElement('i');
        icon_delete.setAttribute("class", "fa fa-trash");

        button_delete.appendChild(icon_delete);
        div.appendChild(button_edit);
        div.appendChild(button_delete);

        info.el.firstChild.childNodes.forEach((item) => {
            $(item).hide();
        });

        info.el.firstChild.prepend(div)
    }

    function hideHandleEvents(info) {
        info.el.firstChild.childNodes.forEach((item) => {
            $(item).show();
        });
        $('#handle_event').remove();
    }

    function update(id) {
        window.location.href = '<?= URL_ADMIN ?>/agenda/editar/' + id
    }

    function deletar(id) {
        window.location.href = '<?= URL_ADMIN ?>/agenda/remover/' + id
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@4.2.0/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fullcalendar/interaction@4.2.0/main.js"></script>
<link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@4.2.0/main.min.css" rel="stylesheet" />
<?php
require APP . 'view/admin/_templates/endFile.php';
?>