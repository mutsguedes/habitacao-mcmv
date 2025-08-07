$("#btn_save").click(function () {
  var form = $("#dep");
  //e.preventDefault();
  error = false;

  /*  if (form.find(".has-error").length) {
    error = true;
  }  */

  elelabeltot = "";
  elelabel = "";
  var fields = $(".required").find("*").serializeArray();
  $.each(fields, function (i, field) {
    if (!field.value) {
      eleid = document.getElementsByName(field.name)[0].id;
      if (eleid.length > 0) {
        elelabel = $("label[for=" + eleid + "]").text();
        elelabeltot = elelabeltot + " " + elelabel;
        error = true;
        /* ele = document.getElementsByName(field.name);
        var formGroup = $(ele).parent().parent();
        formGroup.addClass("has-error");
        $(".help-block:first", formGroup).html(
          '"' + elelabel + '" ' + "não pode ficar em branco."
        ); */
      } else {
        ele = document.getElementsByName(field.name + "[]");
        if (!ele[0].value) {
          elelabel = $("label[for=" + ele[0].id + "]").text();
          elelabeltot = elelabeltot + " " + elelabel;
          error = true;
          /*   var formGroup = $(ele).parent().parent();
          formGroup.addClass("has-error");
          $(".help-block:first", formGroup).html(
            '"' + elelabel + '" ' + "não pode ficar em branco."
          );*/
        }
      }
    }
  });
  console.log($("form").attr("id"));
  console.log(fields);
});

/**
 * Override the default yii confirm dialog. This function is
 * called by yii when a confirmation is requested.
 *
 * @param message the message to display
 * @param okCallback triggered when confirmation is true
 * @param cancelCallback callback triggered when cancelled
 */
yii.confirm = function (message, okCallback, cancelCallback) {
  var resActionSub = message.substr(message.search("_") + 1);
  var resModel = message.substr(0, message.search(" ") + 1);
  var resAction = $(this).attr("value");
  //var resIndex = resAction.substr(resAction.search(" ") +1);
  var resTitle = $(this).attr("title");
  var fmt = document.getElementById($("form").attr("id"));
  var href = $(fmt).attr("base-_uri");

  var resUrl = $(this).data("url");
  var resUrlReturn = $(this).data("url-return");

  //if ((resActionSub !== "sub") ?? (resIndex !== 'i')) {
  if (resActionSub !== "sub") {
    switch (resAction) {
      case "criar":
        if (error !== true) {
          swalWithBootstrapButtons
            .fire({
              title: "<h3>" + resTitle + ".</h3>",
              icon: "success",
              text: resModel + " salvo com susseso.",
              allowOutsideClick: false,
              backdrop: "rgba(92, 184, 92, 0.4)",
              focusConfirm: false,
            })
            .then((result) => {
              if (result.value) {
                okCallback();
              }
            });
        } else {
          swalWithBootstrapButtons
            .fire({
              title: "<h3>" + resTitle + ".</h3>",
              icon: "error",
              text: "Error. " +
                resModel +
                ", exite(m) error(os) no formulário. No(s) campo(s).",
              footer: elelabeltot,
              allowOutsideClick: false,
              backdrop: "rgba(217, 83, 79, 0.4)",
              focusConfirm: false,
            })
            .then((result) => {
              if (result.value) {
                okCallback();
              }
            });
        }
        // okCallback();
        break;
      case "editar":
        if (error !== true) {
          swalWithBootstrapButtons.fire({
            title: "<h3>" + resTitle + ".</h3>",
            icon: "success",
            text: resModel + " editado com susseso.",
            allowOutsideClick: false,
            backdrop: "rgba(92, 184, 92, 0.4)",
            focusConfirm: false,
          }).then((result) => {
            if (result.value) {
              okCallback();
            }
          });
        } else {
          swalWithBootstrapButtons.fire({
            title: "<h3>" + resTitle + ".</h3>",
            icon: "error",
            text:
              "Error." + resModel + ", exite(m) error(os) no formulário. No(s) campo(s).",
            footer: elelabeltot,
            allowOutsideClick: false,
            backdrop: "rgba(217, 83, 79, 0.4)",
            focusConfirm: false,
          }).then((result) => {
            if (result.value) {
              okCallback();
            }
          });
        }
        break;
      case "deletar":
        swalWithBootstrapButtons.fire({
          title: "<h3>" + resTitle + "</h3>",
          icon: "warning",
          text: message,
          confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;Sim, excluir',
          cancelButtonText: '<span class="fa fa-xmark"></span>&nbsp;&nbsp;Não, excluir',
          allowEscapeKey: false,
          allowOutsideClick: false,
          showCancelButton: true,
          backdrop: "rgba(240, 173, 78, 0.4)",
          focusConfirm: false,
        }).then((value) => {
          if (value.isConfirmed) {
            $.post(resUrl, function () {
              swalWithBootstrapButtons.fire({
                title: "<h3>" + resTitle + ".</h3>",
                icon: "success",
                text: resModel + ", excluído com susseso.",
                allowEscapeKey: false,
                allowOutsideClick: false,
                backdrop: "rgba(92, 184, 92, 0.4)",
                focusConfirm: false,
              }).then((value) => {
                if (value.dismiss !== "cancel") {
                  window.location.href = resUrlReturn;
                }
              });
            }).fail(function (jqxhr, settings, ex) {
              swalWithBootstrapButtons.fire({
                title: "</h3>Deletar " + resTitle + ".</h3>",
                icon: "error",
                text:
                  "Não foi possível deletar " +
                  resModel.toUpperCase() +
                  ", entre em contato com o Admiistrador.",
                allowEscapeKey: false,
                allowOutsideClick: false,
                backdrop: "rgba(217,83,79,0.4)",
                focusConfirm: false,
              });
            });
            okCallback();
          } else {
            cancelCallback();
          }
        });
        break;
      default:
        swalWithBootstrapButtons.fire(
          {
            title: "<h3>" + message + "</h3>",
            icon: "warning",
            cancelButtonText:
              '<span class="fa fa-xmark"></span>&nbsp;&nbsp;Cancelar',
            showCancelButton: true,
            closeOnConfirm: true,
            allowOutsideClick: false,
            focusConfirm: false,
          },
          okCallback()
        );
    }
  }
  //resolve();
};
