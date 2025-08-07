<?php

use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelR Responsavel */
/* @var $modelD Dependente */
/* @var $dtDoc string */
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="pt-br, pt">
</head>

<body>
    <div class="container-fluid" style="font-family: verdana,geneva; font-size: 16px; padding: 0px 0px 0px 0px">
        <img style="float: left; margin-top: 5px" src="img/brasao-itaboraiNovo.png" border="0" width="35" height="35">
        <img style="float: right; margin-top: 5px" src="img/minhacasa4.jpeg" border="0" width="35" height="35">
        <div class="row" style="font-size: large; text-align: center;  padding: 0px 5px 20px 5px">
            <p style="font-size: x-large; margin: 0;"><strong>Prefeitura Municipal de Itaboraí</strong></p>
            <p style="font-size: large; margin: 0;"><strong>Secretaria Municipal de Habitação e Serviços Sociais</strong></p>
            <p style="font-size: x-large;">Termo de Desistência do Programa Minha Casa Minha Vida</p>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: justify; line-height: 2; padding: 0px 50px 50px 50px;">
                <p>
                    Eu <strong><?= $modelR->nm_nom_res ?></strong>, <strong>Número de inscrição: </strong><?= MarArtHelpers::mascaraString('####.##.##', $modelR->nu_num_ins) . '/' . $modelR->nu_num_seq ?>,
                    <strong>CPF: </strong>
                    <?=
                    (strlen($modelR->nu_num_cpf) == 0) ?
                        'NÃO INFORMADO' :
                        MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf)
                    ?>,
                    <strong>RG: </strong>
                    <?=
                    (strlen($modelR->nu_num_ide) == 0) ?
                        'NÃO INFORMADO' :
                        MarArtHelpers::mascaraString(MarArtHelpers::masId($modelR->nu_num_ide), $modelR->nu_num_ide)
                    ?>
                    residente e domiciliado (a) no município de Itaboraí, relacionado (a) como inscrito (a)
                    pelo PMCMV - Programa Minha Casa Minha Vida para este Município de Itaboraí,
                    venho através deste <strong>Termo de Desistência do Programa Minha Casa Minha Vida</strong>,
                    expressar minha decisão voluntária de desistir deste Programa.
                </p>
                <p>
                    Esclareço ter ciência de que esta decisão implica na minha exclusão do quadro de
                    inscritos deste PMCMV e ainda, que em decorrência dessa decisão, não tenho direito a
                    qualquer tipo de indenização, de qualquer ordem.
                </p>
            </div>
        </div>

        <div class="row" style="padding: 0px 50px 0px 50px;">
            <div class="col-xs-6" style="text-align: center; padding: 30px 5px 30px 5px;">
                <?= $dtDoc ?><p>
            </div>
            <div class="col-xs-6" style="text-align: center; padding: 30px 0px 30px 0px;">
                <strong> Declaro estar ciente da decisão acima tomada.</strong>
                <p>
            </div>
            <div class="col-xs-6" style="text-align: center; padding: 30px 5px 30px 5px;">
                <hr style="margin: 1px">
                Assinatura do BENEFICIÁRIO<br>
                <?= $modelR->nm_nom_res ?><br>
            </div>
        </div>
    </div>
</body>

</html>