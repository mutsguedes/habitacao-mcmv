$(document).ready(function () {
  const swalWithBootstrapButtons = Swal.mixin({
    customClass: {
      actions: "d-flex justify-content-around",
      confirmButton: "btn btn-sm btn-outline-success",
      cancelButton: "btn btn-sm btn-outline-secondary",
    },
    buttonsStyling: false,
  });
  swal.closeModal(); //Fecha SWAL aberto.
  $formID = $("form").prop("id");
  $formN = $("#" + $formID);
  $formConsulta = $("#consulta-form");

  $formN.on("beforeSubmit", function (e) {
    // $($formN).yiiActiveForm('validate', true);
    if ($formN.find(".is-invalid").length) {
      $("#process").css("display", "none");
    } else {
      $("#btn_envia").attr("disabled", "disabled");
      $("#process").css("display", "block");
    }
  });
  $formN.on("afterSubmit", function () {
    $("#process").css("display", "none");
  });

  $("#calendar")
    .datepicker()
    .on("changeDate", function (e) {
      $("#calendar").change();
    });
  $("#calendar").change(function () {
    date = { date: $("#calendar").val() };
    //date = { date: $(this).select2("data")[0].text.substr(0, 10) };
    //var urlAllTimeDev = "https://mcmvapi.hab.lan/web/agendas/get-all-day-time";

    //var urlAllTimeDev = "https://api.mcmv.itaborai.rj.gov.br/web/agendas/get-all-day-time";

    //var urlAllTimeDev = "https://mcmv.itaborai.rj.gov.br/web/api/agendas/get-all-day-time";

    var urlAllTimeDev =
      "https://mcmv.hab.lan/web/api/agendas/get-all-day-time";
    var urlAgeCreDev = "https://mcmv.hab.lan/web/agenda/agendas/create?";
    var urlAgeUpdDev = "https://mcmv.hab.lan/web/agenda/agendas/update?";
    var idAge = $('#idAge').val();
    console.log(idAge);
    var urlAgeCreUpd = (idAge.length == 0) ? urlAgeCreDev : urlAgeUpdDev;
    var col = 1;
    var tot = 1;
    var divCol =
      '<div id="colrigth" class="col-sm justify-content-center align-items-center border border-secondary rounded" style="margin-right: 10px">' +
      '<h4 id="h4text" class="text-center mt-2">Selecione um Horário Disponível</h4>' +
      "</div>";

    $.getJSON(urlAllTimeDev, date, {
      tagmode: "any",
    })
      .done(function (json) {
        $("#colrigth").remove();
        $("#rowleft").append(divCol);
        $.each(json.data, function (i, obj) {
          var value = obj.ti_age_hor;
          var qtdTime = obj.nu_qtd_hor;
          var creupd = (idAge.length == 0)
            ? "date=" + $("#calendar").val() + "&time=" + value
            : "idAge=" +
            $("#idAge").val() +
            "&date=" +
            $("#calendar").val() +
            "&time=" +
            value;
          var button =
            '<button type="button" id="' +
            value +
            '" class="btn btn-outline-success position-relative"' +
            ' data - toggle="button" aria - pressed="false"' +
            ' title = "Horário do agendamento - ' +
            value +
            '" ' +
            'onClick="window.location.href =' +
            "'" +
            urlAgeCreUpd +
            creupd +
            "'" +
            '"' +
            ">" +
            '<span class="fa-solid fa-clock" aria-hidden="true"></span><br>' +
            "<span>" +
            value +
            "</span>" +
            '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger text-white">' +
            qtdTime +
            "</span>";
          ("</button>"); //col
          if (col == 1) {
            r = i;
            $("#colrigth").append(
              $(
                '<div id="row' +
                r +
                '"' +
                ' class="row justify-content-between mt-5"></div>'
              )
            );
          }
          $("#row" + r).append(
            $(
              '<div id="col' + i + '"' + ' class="col-sm flex-sm-grow-0"></div>'
            )
          );
          $("#col" + i).append($(button));
          if (col == 5 || tot == json.data.length) {
            var buttonFake =
              '<button type="button"' +
              ' class="btn btn btn-outline-light disabled"' +
              ">" +
              '<span class="fa-solid fa-clock" style="margin-right: 0px;" aria-hidden="true"></span><br>' +
              "<span>" +
              value +
              "</span>" +
              "</button>"; //col
            if (tot == json.data.length) {
              fim = 5 - col;
              for (x = 1; x <= fim; x++) {
                $("#row" + r).append(
                  $(
                    '<div id="col1' +
                    (i + x) +
                    '"' +
                    ' class="col-sm flex-sm-grow-0"></div>'
                  )
                );
                $("#col1" + (i + x)).append($(buttonFake));
              }
            }
            col = 0;
          }
          col++;
          tot++;
        });
      })
      .fail(function (jqxhr, textStatus, error) {
        $("#ti_age_hor").prop("disabled", true);
        var err = textStatus + ", " + error;
        console.log("Request Failed: " + err);
      });
    console.log($("#calendar").val());
  });

  var width = $(".g-recaptcha").parent().width();
  if (width < 302) {
    var scale = width / 302;
    $(".g-recaptcha").css("transform", "scale(" + scale + ")");
    $(".g-recaptcha").css("-webkit-transform", "scale(" + scale + ")");
    $(".g-recaptcha").css("transform-origin", "0 0");
    $(".g-recaptcha").css("-webkit-transform-origin", "0 0");
  }

  $(".counter").each(function () {
    $(this)
      .prop("Counter", 0)
      .animate(
        {
          Counter: $(this).text(),
        },
        {
          duration: 4000,
          easing: "swing",
          step: function (now) {
            $(this).text(Math.ceil(now));
          },
        }
      );
  });

  $("select").on("select2:close", function (e) {
    //console.log("val = " + $(this).val());
    //console.log("value = " + $(this).value);
    //        if (!$(this).val()) {
    //        if (!$(this).selectdIndex) {

    if ($(this).val() == "") {
      var formGroup = $(this).parent().parent();
      formGroup.addClass("has-error");
      elelabel = $("label[for=" + this.id + "]").text();
      $(".help-block:first", formGroup).html(
        '"' + elelabel + '" ' + "não pode ficar em branco."
      );
    }
  });
  var selUser = function () {
    swalWithBootstrapButtons.fire({
      title: "<h3>Qual usuário que deseja utilizar?</h3>",
      icon: "question",
      input: "select",
      inputOptions: {
        2: "CIDADÃO",
        3: "FUNCIONÁRIO",
      },
      inputPlaceholder: "-- Sel perfil --",
      confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;Enviar',
      cancelButtonText: '<span class="fa fa-xmark"></span>&nbsp;&nbsp;Cancelar',
      allowEscapeKey: false,
      allowOutsideClick: false,
      showCancelButton: true,
      backdrop: "rgba(41,43,44,0.4)",
      focusConfirm: false,
      inputValidator: (value) => {
        return new Promise((resolve) => {
          if (value === "2" || value === "3") {
            $.ajax({
              url: "/web/site/get-signup",
              type: "POST",
              data: { idSig: value },
              dataType: "json",
              success: resolve(),
            });
          } else {
            resolve("Nenhum tipo de Usuário foi selecionado :)");
          }
        });
      },
    });
  };

  var getMonth = function () {
    dayName = new Array(
      "domingo",
      "segunda",
      "terça",
      "quarta",
      "quinta",
      "sexta",
      "sábado"
    );
    monName = new Array(
      "janeiro",
      "fevereiro",
      "março",
      "abril",
      "maio",
      "junho",
      "agosto",
      "outubro",
      "novembro",
      "dezembro"
    );
    now = new Date();
    swalWithBootstrapButtons.fire({
      title: "<h3>Qual mês que deseja consultar?</h3>",
      icon: "question",
      input: "select",
      inputOptions: monName,
      inputPlaceholder: "-- Sel sistema --",
      confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;Enviar',
      cancelButtonText: '<span class="fa fa-xmark"></span>&nbsp;&nbsp;Cancelar',
      allowEscapeKey: false,
      allowOutsideClick: false,
      showCancelButton: true,
      backdrop: "rgba(41,43,44,0.4)",
      focusConfirm: false,
      inputValidator: (value) => {
        return new Promise((resolve) => {
          if (value === "2" || value === "3") {
            $.ajax({
              url: "/web/site/get-system",
              type: "POST",
              data: { idSis: value },
              dataType: "json",
              success: resolve(),
            });
          } else {
            resolve("Nenhum sistema foi selecionado :)");
          }
        });
      },
    });
  };

  function snwNavLinkSignUp(e) {
    e.preventDefault();
    selUser();
  }

  $("#snwNavLinkSignUp").click(".remove", function (e) {
    e.preventDefault();
    selUser();
  });

  $("#snwNavLinkSignUp1").click(".remove", function (e) {
    e.preventDefault();
    selUser();
  });

  $("#snwNavLinkSignUp2").click(".remove", function (e) {
    e.preventDefault();
    selUser();
  });

  /* function vacanciesMonth(e) {
    e.preventDefault();
    getVacanciesMonth();
  } */
});

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    actions: "d-flex justify-content-around",
    confirmButton: "btn btn-sm btn-outline-success",
    cancelButton: "btn btn-sm btn-outline-secondary",
  },
  buttonsStyling: false,
});

function snwNavLinkVacanciesMonth(event) {
  event.preventDefault();
  //urlCountMonthDev = "https://mcmvapi.hab.lan/web/agendas/get-counter-month";

  //urlCountMonthDev = "https://api.mcmv.itaborai.rj.gov.br/web/agendas/get-counter-month";

  //urlCountMonthDev = "https://mcmv.itaborai.rj.gov.br/web/api/agendas/get-counter-month";

  urlCountMonthDev =
    "https://mcmv.hab.lan/web/api/agendas/get-counter-month";
  urlCountIniDev = "https://mcmv.hab.lan/web/agenda/agendas/index-ini";
  swalWithBootstrapButtons.fire({
    title: "<h3>Agendas Disponíveis...</h3>",
    html: 'Favor aguarde...',
    icon: "info",
    allowOutsideClick: false,
    allowEscapeKey: true,
    showConfirmButton: false,
    //timer: 2000,
    backdrop: "rgba(91,192,222,0.4)",
    didOpen: function () {
      Swal.showLoading();
      return new Promise(function (resolve) {
        $.getJSON(urlCountMonthDev)
          .done(function (json) {
            $.post(
              urlCountIniDev,
              {
                dataType: "html",
                data: json.data,
              },
              function (data) {
                //get the url

                redirect = data.redirect;

                //if everything is OK, redirect to that url

                if (data.status == "200") window.location.href = redirect;
                //if not, do something...
                else
                  swalWithBootstrapButtons.fire({
                    title: "<h3>Erro de Conexão!</h3>",
                    icon: "error",
                    text: "Entre em contato com administrador do Sistema.",
                    backdrop: "rgba(217, 83, 79, 0.4)",
                    allowOutsideClick: false,
                    allowEscapeKey: true,
                    showConfirmButton: true,
                  });
              },
              "json"
            );

            resolve();
          })
          .fail(function (jqxhr, textStatus, error) {
            var err = textStatus + ", " + error;
            console.log("Request Failed: " + err);
            // Swal.hideLoading();
            swalWithBootstrapButtons.fire({
              title: "<h3>Error ao carregar Agendas!</h3>",
              icon: "error",
              text: "Entre em contato com administrador do Sistema.",
              backdrop: "rgba(217, 83, 79, 0.4)",
              allowOutsideClick: false,
              allowEscapeKey: true,
              showConfirmButton: true,
            });
          });
      }).then(() => {
        swalWithBootstrapButtons.fire({
          title: "<h3>Concluido!</h3>",
          icon: "success",
          backdrop: "rgba(92, 184, 92, 0.4)",
          //timer: 8000,
          allowOutsideClick: false,
          allowEscapeKey: true,
          showConfirmButton: false,
        });
        //Swal.close();
      });
    },
    text: "Carregando...",
  });
}

$("#snwNavLinkSystem").click(".remove", function (e) {
  e.preventDefault();
  swalWithBootstrapButtons.fire({
    title: "<h3>Qual sistema deseja utilizar?</h3>",
    icon: "question",
    input: "select",
    inputOptions: {
      2: "MCMV",
      3: "PAC",
      5: "PHPMI",
    },
    inputPlaceholder: "-- Sel sistema --",
    showCancelButton: true,
    confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;Enviar',
    cancelButtonText: '<span class="fa fa-xmark"></span>&nbsp;&nbsp;Cancelar',
    allowEscapeKey: false,
    allowOutsideClick: false,
    backdrop: "rgba(41,43,44,0.4)",
    focusConfirm: false,
    inputValidator: (value) => {
      return new Promise((resolve) => {
        if (value === "2" || value === "3" || value === "5") {
          $.ajax({
            url: "/web/site/get-system",
            type: "POST",
            data: { idSis: value },
            dataType: "json",
            success: resolve(),
          });
        } else {
          resolve("Nenhum sistema foi selecionado :)");
        }
      });
    },
  });
});

$("#snwNavLinkCras").click(".remove", function (e) {
  e.preventDefault();
  swalWithBootstrapButtons.fire({
    title: "<h3>Busca de CRAS</h3>",
    icon: "info",
    text: "Informe o Bairro",
    input: "text",
    backdrop: "rgba(91,192,222,0.4)",
    confirmButtonText: '<span class="fa fa-check"></span>&nbsp;&nbsp;Enviar',
    cancelButtonText: '<span class="fa fa-xmark"></span>&nbsp;&nbsp;Cancelar',
    allowEscapeKey: false,
    allowOutsideClick: false,
    showCancelButton: true,
    inputValidator: (value) => {
      return new Promise(function (resolve, reject) {
        if (value !== "") {
          console.log(value.toUpperCase());
          $.ajax({
            url: "/web/site/get-cras",
            type: "POST",
            data: { nmCra: value.toUpperCase() },
            dataType: "json",
            success: function (data) {
              if (data["nomeCras"] !== "BAIRRO NÃO VINCULADO") {
                swalWithBootstrapButtons.fire({
                  title:
                    "<h3>Bairro '" +
                    value.toUpperCase() +
                    "' pertence ao CRAS.</h3>",
                  icon: "success",
                  text: data["nomeCras"],
                  backdrop: "rgba(92,184,92,0.4)",
                  allowOutsideClick: false,
                });
              } else {
                swalWithBootstrapButtons.fire({
                  title: "<h3>Busca CRAS Error!</h3>",
                  icon: "error",
                  text:
                    "Não foi encontrado um CRAS para o Bairro '" +
                    value.toUpperCase() +
                    "' fornecido.",
                  backdrop: "rgba(217,83,79,0.4)",
                  allowOutsideClick: false,
                });
              }
            },
            error: function (xhr, ajaxOptions, thrownError) {
              swalWithBootstrapButtons.fire({
                title: "<h3>Busca CRAS Error!</h3>",
                icon: "error",
                text:
                  "Não foi encontrado um CRAS para o Bairro '" +
                  value.toUpperCase() +
                  "' fornecido.",
                backdrop: "rgba(217,83,79,0.4)",
                allowOutsideClick: false,
              });
            },
          });
        } else {
          resolve("Nenhum bairro foi informado :)");
        }
        resolve();
      });
    },
  });
});

$("#emails-nm_nom_ema").emailautocomplete({
  // $('#email').emailautocomplete({
  domains: [
    "terra.com.br",
    "hotmail.com",
    "bol.com.br",
    "globo.com",
    "yahoo.com.br",
    "outlook.com",
    "gmail.com",
    "live.com",
    "facebook.com",
    "aol.com",
  ],
});

$("#bologna-list a").on("click", function (e) {
  e.preventDefault();
  $(this).tab("show");
});

$("#dt_age_dat").change(function () {
  $("#ti_age_hor").prop("disabled", true);
  if ($(this).val().length === 0) {
    $("#ti_age_hor").prop("selectedIndex", 0);
  } else {
    $("#ti_age_hor").prop("selectedIndex", 0);
    date = { date: $(this).val() };
    //date = { date: $(this).select2("data")[0].text.substr(0, 10) };
    //urlGetAllTimeDev = "https://mcmvapi.hab.lan/web/agendas/get-all-day-time";

    //urlGetAllTimeDev = "https://api.mcmv.itaboai.rj.gov.br/web/agendas/get-all-day-time";

    //urlGetAllTimeDev = "https://mcmv.itaboai.rj.gov.br/web/api/agendas/get-all-day-time";

    urlGetAllTimeDev =
      "https://mcmv.hab.lan/web/api/agendas/get-all-day-time";


    $("#ti_age_hor").find("option").remove().end();
    $.getJSON(urlGetAllTimeDev, date, {
      tagmode: "any",
    })
      .done(function (json) {
        var freeTime = "";
        freeTime +=
          '<option value data-select2-id="200">-- Sel. horário --</option>';
        /*  freeTime = json.data.map((times) => ({
          value: times.id_age_hor,
          text: times.ti_age_hor,
        })); */
        $.each(json.data, function (i, obj) {
          freeTime += `<option value =${obj.ti_age_hor}>${obj.ti_age_hor} | Vaga(s) -  ${obj.nu_qtd_hor}</option>`;
        });
        $("#ti_age_hor").html(freeTime);
        $("#ti_age_hor").prop("disabled", false);
      })
      .fail(function (jqxhr, textStatus, error) {
        $("#ti_age_hor").prop("disabled", true);
        var err = textStatus + ", " + error;
        console.log("Request Failed: " + err);
      });
  }
});

$("#nu_num_cep").keyup(function () {
  function limpa_formulario_cep() {
    // Limpa valores do formulário de cep.
    $("#nm_nom_log").val("");
    $("#nm_nom_bai").val("");
    $("#nm_nom_mun").val("");
    $("#nm_nom_est").val("");
    //  $("#ibge").val("");
  }
  //Quando o campo cep perde o foco.
  //$("#nu_num_cep").blur(function() {
  //Nova variável "cep" somente com dígitos.
  var cep = $(this).val().replace(/\D/g, "");
  //Verifica se campo cep possui valor informado.
  if (cep.length == 8) {
    //Expressão regular para validar o CEP.
    var validacep = /^[0-9]{8}$/;
    //Valida o formato do CEP.
    if (validacep.test(cep)) {
      //Preenche os campos com "..." enquanto consulta webservice.
      $("#nm_nom_log").val("...");
      $("#nm_nom_bai").val("...");
      $("#nm_nom_mun").val("...");
      $("#nm_nom_est").val("..");
      // $("#ibge").val("...");
      //Consulta o webservice viacep.com.br/
      $.getJSON(
        "//viacep.com.br/ws/" + cep + "/json/?callback=?",
        function (dados) {
          if (!("erro" in dados)) {
            //Atualiza os campos com os valores da consulta.
            $.ajax({
              url: "/res/responsaveis/get-cras",
              type: "POST",
              data: { nmCra: dados.bairro.toUpperCase() },
              dataType: "json",
              success: function (data) {
                var str =
                  "Centro de Referência da Assistência Social - CRAS  -  ";
                var cra = data["nomeCras"];
                var result = cra.fontcolor("blue");
                document.getElementById("crasRes").innerHTML = str + result;
              },
            });
            $("#nm_nom_log").val(dados.logradouro);
            $("#nm_nom_bai").val(dados.bairro);
            $("#nm_nom_mun").val(dados.localidade);
            $("#nm_nom_est").val(dados.uf);
            $("#nu_cas_fun").focus();
            $("#contact-form").on("beforeSubmit", function (e) {
              if (!confirm("Everything is correct. Submit?")) {
                return false;
              }
              return true;
            });
            // $("#ibge").val(dados.ibge);
          } //end if.
          else {
            //CEP pesquisado não foi encontrado.
            limpa_formulario_cep();
            swalWithBootstrapButtons.fire({
              title: "<h3>Error CEP</h3>",
              icon: "error",
              text: "CEP não encontrado.",
              animation: false,
              allowOutsideClick: false,
              backdrop: "rgba(217, 83, 79, 0.4)",
            });
            $("#cras").text("");
          }
        }
      );
    } //end if.
    else {
      //cep é inválido.
      limpa_formulario_cep();
      swalWithBootstrapButtons.fire({
        title: "<h3>Error CEP</h3>",
        icon: "error",
        text: "Formato de CEP inválido.",
        allowOutsideClick: false,
        backdrop: "rgba(217, 83, 79, 0.4)",
      });
      $("#cras").text("");
    }
  } //end if.
  else {
    //cep sem valor, limpa formulário.
    limpa_formulario_cep();
  }
});
function pesbloqueio() {
  var elemento = [];
  $.each($("input[name^='elementos']:checked"), function () {
    elemento.push($(this).val());
    // console.log(elemento);
  });
  $("#checkedall").on("change", function () {
    $(".form-check-input").prop("checked", $(this).prop("checked"));
    if (
      $(".form-check-input:checked").length === $(".form-check-input").length
    ) {
      $("#nome").show();
      $("#mae").show();
      $("#cns").show();
      $("#cpf").show();
      $("#data").show();
      $("#ide").show();
      $("#btn_pesquisar").show();
      $("#btn_redefinir").show();
    } else {
      $("#nmNon").val("");
      $("#nome").hide();
      $("#nmMae").val("");
      $("#mae").hide();
      $("#nuCns").val("");
      $("#cns").hide();
      $("#nuCpf").val("");
      $("#cpf").hide();
      $("#dtNas").val("");
      $("#data").hide();
      $("#nuIde").val("");
      $("#ide").hide();
      $("#btn_pesquisar").hide();
      $("#btn_redefinir").hide();
    }
  });
  $(".form-check-input").change(function () {
    if (
      $(".form-check-input:checked").length === $(".form-check-input").length
    ) {
      $("#checkedall").prop("checked", true);
    } else {
      $("#checkedall").prop("checked", false);
    }
  });
  if ($.inArray("nome", elemento) !== -1) {
    $("#nome").show();
  } else {
    $("#nmNon").val("");
    $("#nome").hide();
  }
  if ($.inArray("mae", elemento) !== -1) {
    $("#mae").show();
  } else {
    $("#nmMae").val("");
    $("#mae").hide();
  }
  if ($.inArray("cns", elemento) !== -1) {
    $("#cns").show();
  } else {
    $("#nuCns").val("");
    $("#cns").hide();
  }
  if ($.inArray("cpf", elemento) !== -1) {
    $("#cpf").show();
  } else {
    $("#nuCpf").val("");
    $("#cpf").hide();
  }
  if ($.inArray("data", elemento) !== -1) {
    $("#data").show();
  } else {
    $("#dtNas").val("");
    $("#data").hide();
  }
  if ($.inArray("ide", elemento) !== -1) {
    $("#ide").show();
  } else {
    $("#nuIde").val("");
    $("#ide").hide();
  }

  if ($(".form-check-input:checked").length !== 0) {
    $("#btn_pesquisar").show();
    $("#btn_redefinir").show();
  } else {
    $("#btn_pesquisar").hide();
    $("#btn_redefinir").hide();
  }
}

function impbloqueio() {
  var ficha = [];
  $.each($("input[name^='fichas']:checked"), function () {
    ficha.push($(this).val());
    // console.log( elemento );
  });
  if ($.inArray("solinu", ficha) !== -1) {
    $("#solinu").show();
  } else {
    $("#solinu").hide();
  }
  if ($.inArray("solinufam", ficha) !== -1) {
    $("#solinufam").show();
  } else {
    $("#solinufam").hide();
  }
}

$(document).ready(function () {
  $("#qua").change(function () {
    $("#lot").val(null).trigger("change");
    //$("#lot").select2("val", "0");
    $("#lot option:not(:selected)").remove();
    //$('#blo option:not(:selected)').remove();
    if ($(this).val() == "1" || $(this).val() == "2" || $(this).val() == "5") {
      $("#lot")
        .append("<option value='1'>Lote - 01</option>")
        .trigger("change");
      $("#lot")
        .append('<option value="2">Lote - 02</option>')
        .trigger("change");
    } else if ($(this).val() === "4") {
      $("#lot")
        .append('<option value="1">Lote - 01</option>')
        .trigger("change");
      $("#lot")
        .append('<option value="2">Lote - 02</option>')
        .trigger("change");
      $("#lot")
        .append('<option value="3">Lote - 03</option>')
        .trigger("change");
    } else if ($(this).val() === "6") {
      $("#lot")
        .append('<option value="1">Lote - 01</option>')
        .trigger("change");
    }
  });

  $("#qua").on("select2:unselect", function (e) {
    var unselected_value = e.params.data.id;
    $("#blo").val(null).trigger("change");
    $("#lot").prop("disabled", true);
  });
  $("#qua").on("select2:select", function (e) {
    var selected_value = e.params.data.id;
    $("#blo").val(null).trigger("change");
    $("#lot").prop("disabled", false);
  });

  $("#lot").on("krajeeselect2:unselectall", function (e) {
    $("#blo").val(null).trigger("change");
    $("#blo").prop("disabled", true);
  });

  $("#lot").on("krajeeselect2:selectall", function (e) {
    $("#blo").val(null).trigger("change");
    $("#blo").prop("disabled", false);
  });

  $("#lot").on("select2:unselect", function (e) {
    $("#blo").val(null).trigger("change");
    var unselected_value = e.params.data.id;
    var data = $("#lot :selected").length;
    if (data === 0) {
      $("#blo").select2("val", "0");
      $("#blo").prop("disabled", true);
    }
  });
  $("#lot").on("select2:select", function (e) {
    $("#blo").val(null).trigger("change");
    var selected_value = e.params.data.id;
    $("#blo").prop("disabled", false);
  });
});

function relbloqueio() {
  var list = [];
  $.each($("input[name^='situacoes']:checked"), function () {
    list.push($(this).val());
    // console.log( elemento );
  });
  var listsort = [];
  $.each($("input[name^='listasorte']:checked"), function () {
    listsort.push($(this).val());
    // console.log( elemento );
  });
  if ($.inArray("aptsor", list) !== -1) {
    $("#lisapto").show();
    listsort = [];
    $("#qua").val(null).trigger("change");
    $("#lot").val(null).trigger("change");
    $("#lot").prop("disabled", true);
    $("#blo").val(null).trigger("change");
    $("#blo").prop("disabled", true);
  } else {
    $("#lisapto").hide();
  }
  if ($.inArray("penden", list) !== -1) {
    $("#lispen").show();
    listsort = [];
    $("#qua").val(null).trigger("change");
    $("#lot").val(null).trigger("change");
    $("#lot").prop("disabled", true);
    $("#blo").val(null).trigger("change");
    $("#blo").prop("disabled", true);
  } else {
    $("#lispen").hide();
  }

  if ($.inArray("sortea", list) !== -1) {
    $("#lissort").show();
  } else {
    $("#lissort").hide();
  }

  if (
    $.inArray("lisblo", listsort) !== -1 ||
    $.inArray("lissin", listsort) !== -1 ||
    $.inArray("todossorte", listsort) !== -1
  ) {
    $("#lisdata").show();
  } else {
    $("#lisdata").hide();
  }
}
