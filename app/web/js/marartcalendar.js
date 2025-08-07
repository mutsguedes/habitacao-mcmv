/* global FullCalendar */
var today = new Date();
var nowDate =
  today.getFullYear() + "-" + (today.getMonth() + 1) + "-" + today.getDate();
var hd = new Date("2021-7-26");

document.addEventListener("DOMContentLoaded", function () {
  var calendarEl = document.getElementById("calendar");
  var initialLocaleCode = "pt-Br";
  var arrays = [{
    "title": "All Day Event",
    "start": "2021-07-01 00:00:00",
    "color": "#40E0D0"
  },];
  var calendar = new FullCalendar.Calendar(calendarEl, {
    themeSystem: "standard",
    headerToolbar: {
      left: "",
      //left: "prev,next today",
      center: "title",
      //right: "dayGridMonth,timeGridWeek,timeGridDay,listMonth",
      right: "",
    },


    locale: initialLocaleCode,
    weekends: false,
    validRange: function (nowDate) {
      $("td[data-date=" + "2021-07-27" + "]").addClass('fc-day-disabled');
      return {
        start: nowDate,
        end: new Date(nowDate.getFullYear(), nowDate.getMonth() + 1, 0), // retorna o último dia do mês.
      };
    },

    dayRender: function(info) {
      console.log(info.date.toISOString());
      console.log(info.el);
      console.log(info.view.type);
    },

    slotLabelFormat: { hour: "2-digit", minute: "2-digit", hour12: false },
    selectable: true,
    selectMirror: true,
    nowIndicator: true,
    editable: true,
    events: [
      {
        start: 07,
        end: '2021-07-28',
        display: '#3085d6'
        
      }
    ],
    select: async function (arg) {
      $("td[data-date=" + "2021-07-27" + "]").addClass('fc-day-disabled');
      var selDate = new Date(arg.start);
      var dt =
        selDate.getFullYear() +
        "-" +
        (selDate.getMonth() + 1) +
        "-" +
        selDate.getDate();
      holyDay = new Date("2021-7-26");

      if (selDate.getDate() !== holyDay.getDate()) {
        const { value: title } = await swal.fire({
          //            swal.fire({
          onOpen: function (el) {
            var container = $(el);
            container.find("#swal-nu_num_cpf").mask("000.000.000-00");
            container.find("#swal-nu_num_tel").mask("(00) 0000-00009");
            console.log(dt);

            dateTime = { dateTime: dt };
            $.getJSON(
              "https://mcmv-api.hab.lan/web/agenda/agenda/get-all-time",
              dateTime
            )
              .done(function (json) {
                var option = "";
                console.log("JSON Data: " + json.data[0].ti_age_hor);
                option += "<option>-- Selecione horário -- " + "</option>";
                $.each(json.data, function (i, obj) {
                  option += `<option value =${obj.ti_age_hor}>${obj.ti_age_hor} - Número de vaga(s) ${obj.nu_qtd_hor}</option>`;
                });
                container.find("#swal-ti_num_hor").html(option);
              })
              .fail(function (jqxhr, textStatus, error) {
                var err = textStatus + ", " + error;
                console.log("Request Failed: " + err);
              });
          },
          title: "Agenda Responsável",
          html:
            '<input id="swal-nm_nom_res" class="swal2-input" placeholder="Nome responsável" onkeyup="this.value = this.value.toUpperCase();">' +
            '<input id="swal-nu_num_cpf" class="swal2-input" required placeholder="Cpf responsável">' +
            '<select class="js-data-example-ajax swal2-input "id="swal-ti_num_hor">' +
            '<option value="">-- Selecione horário --</option>' +
            "</select>" +
            '<input id="swal-nu_num_tel" class="swal2-input" required placeholder="Tel. responsável">' +
            '<select name="color" class="swal2-input" id="swal-color">' +
            '<option value="">-- Selecione cor --</option>' +
            '<option style="color:#FFD700;" value="#FFD700">Amarelo</option>' +
            '<option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>' +
            '<option style="color:#FF4500;" value="#FF4500">Laranja</option>' +
            '<option style="color:#8B4513;" value="#8B4513">Marrom</option>' +
            '<option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>' +
            '<option style="color:#436EEE;" value="#436EEE">Royal Blue</option>' +
            '<option style="color:#A020F0;" value="#A020F0">Roxo</option>' +
            '<option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>' +
            ' <option style="color:#228B22;" value="#228B22">Verde</option>' +
            '<option style="color:#8B0000;" value="#8B0000">Vermelho</option>' +
            "</select>",
          type: "info",
          confirmButtonColor: "#3085d6",
          cancelButtonColor: "#d33",
          confirmButtonText: "Agendar",
          cancelButtonText: "Cancelar",
          allowEscapeKey: false,
          allowOutsideClick: false,
          showCancelButton: true,
          animation: false,
          customClass: "animated wobble",
          backdrop: "rgba(11,126,248,0.4)",
          focusConfirm: false,
          preConfirm: () => {
            $(".swal2-input").unmask();
            return [
              document.getElementById("swal-nm_nom_res").value,
              document.getElementById("swal-nu_num_cpf").value,
              document.getElementById("swal-nu_num_tel").value,
              document.getElementById("swal-ti_num_hor").value,
              document.getElementById("swal-color").value,
            ];
          },
        });

        if (title) {
          if (title[0] !== "" && title[1] !== "") {
            if (vercpf(title[1])) {
              calendar.addEvent({
                title: title[0] + " - " + title[1],
                start: arg.start,
                end: arg.end,
                allDay: arg.allDay,
                backgroundColor: arg.color,
                textColor: arg.textColor,
              });
              var start = arg.start.toLocaleString();
              var end = arg.end.toLocaleString();
              $.ajax({
                url: "create-calendar",
                type: "POST",
                data: {
                  title: title[0],
                  nu_num_cpf: title[1],
                  nu_num_tel: title[2],
                  start: start,
                  end: end,
                  allDay: arg.allDay,
                  backgroundColor: title[3],
                  textColor: arg.textColor,
                },
                success: function () {
                  swal({
                    type: "success",
                    title: "Agenda Criada!",
                    text: "Agenda criada com susseso.",
                    allowOutsideClick: false,
                    backdrop: "rgba(92,184,92,0.4)",
                  });
                },
              });
            } else {
              swal({
                type: "error",
                title: "Cpf Error!",
                text: "Cpf do responsável Inválido.",
                allowOutsideClick: false,
                backdrop: "rgba(255,0,0,0.4)",
              });
            }
          } else {
            swal({
              type: "error",
              title: "Agenda Error!",
              text: "Favor entrar com Nome e Cpf do responsável.",
              allowOutsideClick: false,
              backdrop: "rgba(255,0,0,0.4)",
            });
          }
        }
      }
      calendar.unselect();
    },

    eventClick: function (arg) {
      swal({
        title: "Você tem certeza de deletar essa agenda?",
        text: "Você não será capaz de recuperar esta agenda!",
        type: "warning",
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Sim, excluir",
        cancelButtonText: "Não, excluir",
        allowEscapeKey: false,
        allowOutsideClick: false,
        showCancelButton: true,
        animation: false,
        customClass: "animated wobble",
        backdrop: "rgba(240,173,78,0.4)",
      }).then((result) => {
        if (result.value) {
          swal({
            type: "success",
            title: "Agenda Excluída!",
            text: "Agenda excluída com susseso.",
            // showConfirmButton: false,
            allowOutsideClick: false,
            backdrop: "rgba(92,184,92,0.4)",
          });
          arg.event.remove();
        }
      });
    },

    /*    eventSources: [
      {
        url: "index-calendar",
        extraParams: function () {
          return {
            cachebuster: new Date().valueOf(),
          };
        },
        failure: function () {
          alert("Ocorreu um erro ao buscar Agenda!");
        },
        loading: function (bool) {
          document.getElementById("loading").style.display = bool
            ? "block"
            : "none";
        },
      },
    ], */
    eventDidMount: function(view) {
      //$("td[data-date=" + "2021-07-26" + "]").css('background', '#d33');
      $("td[data-date=" + "2021-07-27" + "]").addClass('fc-day-disabled');
      //loop through json array
      /* $(arrays).each(function(i, val) {
        //find td->check if the title has same value-> get closest daygird ..change color there
        $("td[data-date=" + "2021-07-26" + "] .fc-event-title:contains(" + val.title + ")").closest(".fc-daygrid-event-harness").css("background-color", '#d33');
      }) */
    },
  });

  calendar.render();
});

function VerificaCPF() {
  if (vercpf(document.frmcpf.cpf.value)) {
    document.frmcpf.submit();
  } else {
    errors = "1";
    if (errors)
      //            alert('CPF NÃO VÁLIDO');
      document.retorno = errors === "";
  }
}
function vercpf(cpf) {
  if (
    cpf.length !== 11 ||
    cpf === "00000000000" ||
    cpf === "11111111111" ||
    cpf === "22222222222" ||
    cpf === "33333333333" ||
    cpf === "44444444444" ||
    cpf === "55555555555" ||
    cpf === "66666666666" ||
    cpf === "77777777777" ||
    cpf === "88888888888" ||
    cpf === "99999999999"
  )
    return false;
  add = 0;
  for (i = 0; i < 9; i++) add += parseInt(cpf.charAt(i)) * (10 - i);
  rev = 11 - (add % 11);
  if (rev === 10 || rev === 11) rev = 0;
  if (rev !== parseInt(cpf.charAt(9))) return false;
  add = 0;
  for (i = 0; i < 10; i++) add += parseInt(cpf.charAt(i)) * (11 - i);
  rev = 11 - (add % 11);
  if (rev === 10 || rev === 11) rev = 0;
  if (rev !== parseInt(cpf.charAt(10))) return false;
  //    alert('O CPF INFORMADO É VÁLIDO.');
  return true;
}
