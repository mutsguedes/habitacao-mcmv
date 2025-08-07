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
        <?php
        if ($modelR->id_num_proj == 2) {
        ?>
            <img style="float: right; margin-top: 5px" src="img/minhacasa4.jpeg" border="0" width="35" height="35">
        <?php
        } else {
        ?>
            <img style="float: right; margin-top: 5px" src="img/bandeiraItaborai.png" border="0" width="40" height="30">
        <?php
        }
        ?>
        <div class="row" style="font-size: large; text-align: center;  padding: 0px 5px 20px 5px">
            <p style="font-size: x-large; margin: 0;"><strong>Prefeitura Municipal de Itaboraí</strong></p>
            <p style="font-size: large; margin: 0;"><strong>Secretaria Municipal de Habitação e Serviços Sociais</strong></p>
            <p style="font-size: x-large;">Declaração Negativa de União Estável</p>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: justify; line-height: 2; padding: 0px 50px 50px 50px;">
                <p>
                    Eu <strong><?= $modelR->nm_nom_res ?></strong>,&nbsp;<?= $modelR->numNac->nm_nom_nac ?>,&nbsp;
                    <?= $modelR->estCiv->nm_est_civ ?>,&nbsp;<?= $modelR->numCbo->nm_des_cbo ?>,&nbsp;
                    portador(a) do <strong>RG:</strong> n°
                    <?=
                    (strlen($modelR->nu_num_ide) == 0) ?
                        'NÃO INFORMADO' :
                        MarArtHelpers::mascaraString(MarArtHelpers::masId($modelR->nu_num_ide), $modelR->nu_num_ide)
                    ?> e do <strong>CPF:</strong>
                    <?=
                    (strlen($modelR->nu_num_cpf) == 0) ?
                        'NÃO INFORMADO' :
                        MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf)
                    ?>, declaro expressamente, sob responsabilidade civil e criminal, que <strong>NÃO</strong>
                    mantenho relação de vida comum ou união estável com outra pessoa, nas condições dos
                    artigos 1.723 e seguintes do Código Civil Brasileiro, Título III – “Da União Estável”,
                    permanecendo no estado civil de
                    <?=
                    (strlen($modelR->estCiv->nm_est_civ) == 0) ?
                        'NÃO INFORMADO' :
                        $modelR->estCiv->nm_est_civ
                    ?>,
                <p>
                    Declaro ainda estar ciente de que, comprovada a falsidade nesta declaração, estarei sujeito
                    (a) às penas previstas no Art. 299 do Código Penal Brasileiro.
                </p>
            </div>
        </div>

        <div class="row" style="padding: 0px 50px 0px 50px;">
            <div class="col-xs-6" style="text-align: center; padding: 30px 5px 30px 5px;">
                <?= $dtDoc ?><p>
            </div>
            <div class="col-xs-6" style="text-align: center; padding: 30px 0px 30px 0px;">
                <strong> Declarante:</strong>
                <p>
            </div>
            <div class="col-xs-6" style="text-align: center; padding: 30px 5px 30px 5px;">
                <hr style="margin: 1px">
                Assinatura do BENEFICIÁRIO<br>
                <?= $modelR->nm_nom_res ?><br>
            </div>
            <div class="row">
                <div class="col-xs-12" style="font-size: 10px; text-align: justify;  padding: 80px 0px 0px 0px;">
                    Dispõe o Artigo 299 do Código Penal Brasileiro: “Omitir, em documento público ou particular, declaração
                    que dele devia constar, ou nele inserir ou fazer inserir declaração falsa ou diversa da que devia ser
                    escrita, com o fim de prejudicar direito, criar obrigação ou alterar a verdade sobre fato juridicamente
                    relevante: Pena - reclusão, de 1 (um) a 5 (cinco) anos, e multa, se o documento é público, reclusão
                    de 1 (um) a 3 (três) anos. e multa, se o documento é particular."
                </div>
            </div>
        </div>
    </div>
</body>

</html>