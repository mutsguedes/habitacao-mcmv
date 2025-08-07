<?php

use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelA Agenda */
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
        <div class="row" style="font-size: large; text-align: center;  padding: 0px 5px 30px 5px">
            <p style="font-size: x-large; margin: 0;"><strong>Prefeitura Municipal de Itaboraí</strong></p>
            <p style="font-size: large; margin: 0;"><strong>Secretaria Municipal de Habitação e Serviços Sociais</strong></p>
            <p style="font-size: x-large;">Comprovante de Agenda do Programa Minha Casa Minha Vida</p>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: left;  padding: 0px 0px 30px 5px;">
                Srº(ª) <strong><?= $modelA->nm_nom_cid ?></strong>, sua inscrição foi realizada com sucesso.
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="font-size: 16px; text-align: center;  padding: 0px 0px 30px 5px;">
                <strong>Número da agenda: </strong><?= $modelA->id_num_age ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: justify; padding: 0px 0px 0px 0px;">
                <ul style="text-align: justify; padding: 0px 0px 0px 0px;">
                    <strong>TERMO DE COMPROMISSO:</strong><br>
                    <ul>
                        <li>
                            Declaro que as informações acima indicadas foram por mim respondidas livremente,
                            representando fielmente a realidade dos fatos, estando neste ato, ciente de que qualquer
                            falsidade torna nulo, por inteiro, o presente documento.
                        </li>
                        <li>
                            Obs: Estou ciente que o projeto M.C.M.V tem que formar demanda e esteja incluído na
                            área das ZEIS (Zona de Especial Interesse Social/e tiver água potável CEDAE e/ou SAAE.
                        </li>
                        <li>
                            Obs²: Conforme portaria 595 de 18 dez/2013, do Ministério das Cidades, referente ao
                            Programa M.C.M.V autorizo a divulgação no site da PMI o meu nome nas listagens dos candidatos
                            inscritos no Programa do Município de Itabaraí. SMHSS.
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
        <div class="row" style="width: 60%; padding: 0px 0px 0px 150px;">
            <div class="col-xs-6 col-xs-offset-3" style="text-align: center; padding: 30px 5px 30px 5px;">
                <?= 'Itaboraí, ' . strftime('%A, %d de %B de %Y', strtotime(date("Y-m-d"))) . '.'; ?><p>
            </div>
            <div class="col-xs-6 col-xs-offset-3" style="text-align: center; padding: 30px 5px 30px 5px;">
                <hr style="margin: 1px">
                Assinatura do BENEFICIÁRIO<br>
                <?= $modelA->nm_nom_cid ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="font-size: 12px; text-align: justify; padding: 0px 0px 0px 0px;">
                Ao receber esse comprovante verifique se existe pendências, se existir corrija o mais rápido possível, pois
                isso implicará no seu cadastro. Caso tenha dúvidas procure um atendente.
            </div>
        </div>
    </div>
</body>

</html>