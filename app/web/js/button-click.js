$(document).ready(function ($) {
  /**
   * Override the default yii confirm dialog. This function is
   * called by yii when a confirmation is requested.
   *
   * @param message the message to display
   * @param okCallback triggered when confirmation is true
   * @param cancelCallback callback triggered when canceled
   */
  yii.confirm = function (message, okCallback, cancelCallback) {
    var value = $(this).attr("data-value");
    var title = $(this).attr("data-title");
    var module = $(this).attr("data-module");
    //var message = $(this).attr("data-confirm") + ' ' + module.toUpperCase();
    var message = $(this).attr("data-confirm");
    switch (value) {
      case "create": case "update": {
        error = false;
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
            } else {
              ele = document.getElementsByName(field.name + "[]");
              if (!ele[0].value) {
                elelabel = $("label[for=" + ele[0].id + "]").text();
                elelabeltot = elelabeltot + " " + elelabel;
                error = true;
              }
            }
          }
        });
        if (error !== true) {
          swalWithBootstrapButtons.fire({
            title: "<h3>" + title + "</h3>",
            icon: "success",
            text: message,
            confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;&nbsp;&nbsp;Ok&nbsp;&nbsp;&nbsp;&nbsp;',
            allowOutsideClick: false,
            backdrop: "rgba(92, 184, 92, 0.4)",
            focusConfirm: true,
          }).then((result) => {
            if (result.isConfirmed) {
              okCallback();
            }
          });
        } else {
          swalWithBootstrapButtons.fire({
            title: "<h3>" + "Opss!!! Error " + title + "</h3>",
            icon: "error",
            text: "Exite(m) error(os) no formulário " + title.toUpperCase() + ". No(s) campo(s).",
            allowEscapeKey: false,
            allowOutsideClick: false,
            confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;&nbsp;&nbsp;Ok&nbsp;&nbsp;&nbsp;&nbsp;',
            showConfirmButton: true,
            footer: elelabeltot,
            backdrop: "rgba(217, 83, 79, 0.4)",
            focusConfirm: true,
            focusCancel: false,
          }).then((result) => {
            if (result.isConfirmed) {
              okCallback();
            }
          });
        }
      }
        break;
      case "delete":
        {
          var url = $(this).attr("data-url");
          var urlReturn = $(this).attr("data-urlReturn");
          swalWithBootstrapButtons.fire({
            title: "<h3>" + title + "</h3>",
            icon: "warning",
            text: message,
            didOpen: () => {
              swalWithBootstrapButtons.getCancelButton().focus();
            },
            confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;Sim, excluir',
            cancelButtonText: '<span class="fa fa-xmark"></span>&nbsp;&nbsp;Não, excluir',
            allowEscapeKey: false,
            allowOutsideClick: false,
            showCancelButton: true,
            backdrop: "rgba(240, 173, 78, 0.4)",
            focusConfirm: false,
            focusCancel: true,
          }).then((result) => {
            if (result.isConfirmed) {
              $.post(url, function () {
                swalWithBootstrapButtons.fire({
                  title: "<h3>" + title + ".</h3>",
                  icon: "success",
                  text: module.toUpperCase() + ", excluído(a) com susseso.",
                  confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;&nbsp;&nbsp;Ok&nbsp;&nbsp;&nbsp;&nbsp;',
                  allowEscapeKey: false,
                  allowOutsideClick: false,
                  backdrop: "rgba(92, 184, 92, 0.4)",
                  focusConfirm: true,
                }).then((result) => {
                  if (result.isConfirmed) {
                    window.location.href = urlReturn;
                  }
                });
              }).fail(function (jqxhr, settings, ex) {
                swalWithBootstrapButtons.fire({
                  title: "</h3>" + title + ".</h3>",
                  icon: "error",
                  text:
                    "Não foi possível deletar " +
                    module.toUpperCase() +
                    ", entre em contato com o Administrador.",
                  confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;&nbsp;&nbsp;Ok&nbsp;&nbsp;&nbsp;&nbsp;',
                  allowEscapeKey: false,
                  allowOutsideClick: false,
                  backdrop: "rgba(217,83,79,0.4)",
                  focusConfirm: true,
                });
              });
              //okCallback();
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === swalWithBootstrapButtons.DismissReason.cancel
            ) {
              swalWithBootstrapButtons.fire({
                title: "</h3>" + title + ".</h3>",
                icon: "info",
                text: module.toUpperCase() + ", não excluído(a).",
                confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;&nbsp;&nbsp;Ok&nbsp;&nbsp;&nbsp;&nbsp;',
                allowEscapeKey: false,
                allowOutsideClick: false,
                backdrop: "rgba(91,192,222,0.4)",
                focusConfirm: true,
              });
            }
            //cancelCallback();
          });
        }
        break;
    }
  };

  /* $("#btn_delete").click(function () {
    var value = $(this).attr("data-value");
    var title = $(this).attr("data-title");
    var module = $(this).attr("data-module");
    var message = $(this).attr("data-confirm");
    var url = $(this).attr("data-url");
    var urlReturn = $(this).attr("data-urlReturn");
    Swal.fire({
      title: "<h3>" + title + "</h3>",
      icon: "warning",
      text: message,
      confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;Sim, excluir',
      cancelButtonText: '<span class="fa fa-xmark"></span>&nbsp;&nbsp;Não, excluir',
      allowEscapeKey: false,
      allowOutsideClick: false,
      showCancelButton: true,
      backdrop: "rgba(240, 173, 78, 0.4)",
      focusConfirm: false,
      focusCancel: true,
    }).then((result) => {
      if (result.isConfirmed) {
        $.post(url, function () {
          Swal.fire({
            title: "<h3>" + title + ".</h3>",
            icon: "success",
            text: module.toUpperCase() + ", excluído com susseso.",
            confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;&nbsp;&nbsp;Ok&nbsp;&nbsp;&nbsp;&nbsp;',
            allowEscapeKey: false,
            allowOutsideClick: false,
            backdrop: "rgba(92, 184, 92, 0.4)",
            focusConfirm: false,
          }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = urlReturn;
            }
          });
        }).fail(function (jqxhr, settings, ex) {
          Swal.fire({
            title: "</h3>" + title + ".</h3>",
            icon: "error",
            text:
              "Não foi possível deletar " +
              module.toUpperCase() +
              ", entre em contato com o Administrador.",
            allowEscapeKey: false,
            allowOutsideClick: false,
            backdrop: "rgba(217,83,79,0.4)",
            focusConfirm: false,
          });
        });
        //okCallback();
      } else if (
        /* Read more about handling dismissals below */
  /*  result.dismiss === Swal.DismissReason.cancel
  ) {
    Swal.fire({
      title: "</h3>" + title + ".</h3>",
      icon: "info",
      text: module.toUpperCase() + ", não excluído.",
      confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;&nbsp;&nbsp;Ok&nbsp;&nbsp;&nbsp;&nbsp;',
      allowEscapeKey: false,
      allowOutsideClick: false,
      backdrop: "rgba(91,192,222,0.4)",
      focusConfirm: false,
    });
  }
  //cancelCallback();
});
});*/
}); 