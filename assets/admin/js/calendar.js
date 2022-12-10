/*
    Abre modal para adicionar novo evento
*/
function modalAddEventCalendar(info) {
    $.ajax({
        url: "../App/Controllers/EventsCalendarController.php",
        method: "post",
        data: {
            "modal-insert-event": true
        },
        dataType: "text",
        success: function (response) {
            $("#addEventCalendarModal").html(response);
            $("#modalCalendar").show();
            $("#color-picker").spectrum();
            addNewEventCalendar(info);

            $('#users_on_event').select2({
                dropdownParent: $('#addEventCalendarModal'),
                multiple: true,
                closeOnSelect:false
            })

            $(".btn-document").click(function (event) {

                $(this)
                    .siblings()
                    .children("input")
                    .trigger("click");
        
                $(this)
                    .siblings()
                    .children("input")
                    .change(function () {
                        let file_name = this.files[0].name;
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#file_uploaded').html(file_name);
                        };

                        reader.readAsDataURL(this.files[0]);
                    });
            });
        }
    })
}

function closeModalEventCalendar(){
    $("#modalCalendar").hide();
}

function modalUpdateEventCalendar(id) {

    $.ajax({
        url: "../App/Controllers/EventsCalendarController.php",
        method: "post",
        data: {
            "modal-update-event": true,
            'id_event': id
        },
        dataType: "text",
        success: function (response) {

            $("#addEventCalendarModal").html(response);
            $("#modalCalendar").show();
            $("#color-picker").spectrum();

            updateEventCalendar(id);

            $('#users_on_event').select2({
                dropdownParent: $('#addEventCalendarModal'),
                multiple: true,
                closeOnSelect:false
            })

            let selecteds = JSON.parse($('#users_selected').val());
            $('#users_on_event').val(selecteds).trigger('change');

            $(".btn-document").click(function (event) {

                $(this)
                    .siblings()
                    .children("input")
                    .trigger("click");
        
                $(this)
                    .siblings()
                    .children("input")
                    .change(function () {
                        let file_name = this.files[0].name;
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#file_uploaded').html(file_name);
                        };

                        reader.readAsDataURL(this.files[0]);
                    });
            });
        }
    })
}
function popoverViewInfos(event, id){
    $.ajax({
        url: "../App/Controllers/EventsCalendarController.php",
        method: "post",
        data: {
            "popover-infos": true,
            'id_event': id
        },
        dataType: "text",
        success: function (response) {
            $("#listViewInfos").html(response);
            $('#popoverViewInfos').attr('style', 'position:absolute;top:'+event.pageY+'px;left:'+event.pageX+'px;')
            $('#popoverViewInfos').show();
            //addNewEventCalendar(info);
        }
    })

}

function closePopoverViewInfos(){
    $('#popoverViewInfos').hide();
}

function closeModalEventCalendar(){
    $("#modalCalendar").hide();
}

function addNewEventCalendar(info) {

    if(info){
        if(info.startStr && info.endStr){
            $('#start').val(info.startStr+"T00:00");
            $('#end').val(info.endStr+"T00:00");
        }else {
            $('#start').val(info.dateStr+"T00:00");
        }
    }

    let form = $('#form_new_event');
    form.submit(function (event) {
        $('#insertEvent').attr("disabled", true)
        let formData = new FormData(document.getElementById("form_new_event"));
        $.ajax({
            url: "../App/Controllers/EventsCalendarController.php",
            method: "post",
            data: formData,
            beforeSend: function(){
                $('#insertEvent').attr("disabled", true)
                $("#insertEvent").html(`<i class="fas fa-spinner fa-spin"></i> Inserting...`)
            },
            success: function (res) {

                res = JSON.parse(res);
                data = JSON.parse(res['data']);

                if (data['status']) {
                    iziToast.success({
                        title: 'OK',
                        message: "Event add with success!",
                    });
                    loadCalendar();
                    closeModalEventCalendar();
                    if(res['users_on_event']){
                        sendInviteToAllUsers(res['from_name'], res['from_email'], data['event_id']);
                    }
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: "Erro to add event!",
                    });
                }

                $('#insertEvent').attr("disabled", false)
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () { // Custom XMLHttpRequest
                let myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        })
        event.preventDefault();
    });

};

function updateEventCalendar(id) {
    $('#insertEvent').click(function (event) {
        event.preventDefault();

        let formData = new FormData(document.getElementById("form_update_event"));

        formData.append('id_event', id);

        $('#insertEvent').attr("disabled", true)

        $.ajax({
            url: "../App/Controllers/EventsCalendarController.php",
            method: "post",
            data: formData,
            beforeSend: function(){
                $('#insertEvent').attr("disabled", true)
                $("#insertEvent").html(`<i class="fas fa-spinner fa-spin"></i> Editing...`)
            },
            success: function (res) {
                
                if (res) {
                    iziToast.success({
                        title: 'OK',
                        message: "Event update with success!",
                    });
                    loadCalendar();
                    closeModalEventCalendar();
                } else {
                    iziToast.error({
                        title: 'Error',
                        message: "Erro to update event!",
                    });
                }

                $('#insertEvent').attr("disabled", false)
            },
            cache: false,
            contentType: false,
            processData: false,
            xhr: function () { // Custom XMLHttpRequest
                let myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        })

    });
};

function showHandleEvents(info){
    
    if(info.event.extendedProps.user_id == $('#idUser').val()){
        //DIV HANDLE EVENT
        let div =  document.createElement('div');
        div.setAttribute("id", "handle_event");
        div.style.cssText = 'display:inline;';
        //BUTTON EDIT
        let button_edit = document.createElement('button');
        button_edit.setAttribute("id", "edit_event");
        button_edit.setAttribute("onclick", "modalUpdateEventCalendar("+info.event.id+")");
        button_edit.style.cssText = 'padding-left:5px;padding-right:5px;background:transparent;border:none;border-right: 1px solid #ccc;color:white;';

        let icon_edit = document.createElement('i');
        icon_edit.setAttribute("class", "fa fa-pen");

        button_edit.appendChild(icon_edit);
        //BUTTON DELETE
        let button_delete = document.createElement('button');
        button_delete.setAttribute("id", "delete_event");

        button_delete.setAttribute("onclick", 'deleteEventCalendar('+info.event.id+')');
        button_delete.style.cssText = 'padding-left:5px;padding-right:5px;background:transparent;border:none;border-right: 1px solid #ccc;color:white;';

        let icon_delete = document.createElement('i');
        icon_delete.setAttribute("class", "fa fa-trash");

        button_delete.appendChild(icon_delete);
        //BUTTON VIEW
        let button_view = document.createElement('button');
        button_view.setAttribute("id", "view_infos");

        button_view.setAttribute("onclick", 'popoverViewInfos(event, '+info.event.id+')');
        button_view.style.cssText = 'padding-left:5px;padding-right:5px;background:transparent;border:none;border-right: 1px solid #ccc;color:white;';

        let icon_view = document.createElement('i');
        icon_view.setAttribute("class", "fa fa-eye");

        button_view.appendChild(icon_view);

        div.appendChild(button_view);
        div.appendChild(button_edit);
        div.appendChild(button_delete);

        info.el.firstChild.childNodes.forEach((item) => {
            $(item).hide();
        });

        info.el.firstChild.prepend(div)
    }

}

function hideHandleEvents(info){
    if(info.event.extendedProps.user_id == $('#idUser').val()){
        info.el.firstChild.childNodes.forEach((item) => {
            $(item).show();
        });
        $('#handle_event').remove();
    }
}

function deleteEventCalendar(id){

    $.ajax({
        url: "../App/Controllers/EventsCalendarController.php",
        method: "post",
        data: {
            "delete-eventscalendar": true,
            "id": id
        },
        dataType: "text",
        success: function (res) {
            if (res) {
                iziToast.success({
                    title: 'OK',
                    message: "Event delete with success!",
                });
                loadCalendar()
            } else {
                iziToast.error({
                    title: 'Error',
                    message: "Erro to delete event!",
                });
            }
        },
    })
}

function loadCalendar(){

    let calendarEl = document.getElementById('calendar');

    calendarEl.innerHTML = ''

    let calendar = new FullCalendar.Calendar(calendarEl, {
        locale: 'en-gb',
        headerToolbar: {
            left: 'dayGridMonth,timeGridFourDay' // buttons for switching between views
          },
          views: {
            timeGridFourDay: {
              type: 'timeGrid',
              duration: { days: 4 },
              buttonText: '4 day'
            }
          },
        plugins: ['interaction', 'dayGrid', 'timeGrid'],
        //defaultDate: '2019-04-12',
        theme: true,
        selectable: true,
        //editable: true,
        eventLimit: true,
        displayEventTime: true,
        nextDayThreshold: '20:00:00',
        displayEventEnd: true,
        events: [{"tilte": "yaya"}],
        // events: '../App/Models/ListEventsCalendar.php',
        /*eventDataTransform: function( eventData ) {
        },*/
        extraParams: function () {
            return {
                cachebuster: new Date().valueOf()
            };
        },
        /*dateClick: function(info) {
        },*/
        select: function(info) {
            //alert('selected ' + info.startStr + ' to ' + info.endStr);
            modalAddEventCalendar(info);
        },
        eventClick: function(event){
            event.jsEvent.cancelBubble = true;
            event.jsEvent.preventDefault();
        },
        eventMouseEnter: function(info){
            console.log(info);
            showHandleEvents(info);
        },
        eventMouseLeave: function(info ){
            console.log(info);
            hideHandleEvents(info);
        }
    });

    calendar.render();

}

document.addEventListener('DOMContentLoaded', function () {
    loadCalendar();
    $('body').click(function (event) 
    {
    if(!$(event.target).closest('#popoverViewInfos').length && !$(event.target).is('#popoverViewInfos')) {
        $("#popoverViewInfos").hide();
    }     
    });
});