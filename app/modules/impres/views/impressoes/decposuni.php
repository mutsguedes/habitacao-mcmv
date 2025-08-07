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
            <p style="font-size: x-large;">Declaração Positiva de União Estável</p>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: justify; line-height: 2; padding: 0px 50px 30px 50px;">
                <p>
                    Eu <strong><?= $modelR->nm_nom_res ?></strong>,&nbsp;<?= $modelR->numNac->nm_nom_nac ?>,&nbsp;
                    <?= $modelR->estCiv->nm_est_civ ?>,&nbsp;
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
                    ?> e <strong><?=
                                    (strlen($modelD->nm_nom_dep) == 0) ?
                                        'NÃO INFORMADO' :
                                        $modelD->nm_nom_dep
                                    ?></strong>,&nbsp;<?= $modelD->numNac->nm_nom_nac ?>,&nbsp;<?= $modelD->estCiv->nm_est_civ ?>,&nbsp;
                    portador(a) do <strong>RG:</strong> <?=
                                                        (strlen($modelD->nu_num_ide) == 0) ?
                                                            'NÃO INFORMADO' :
                                                            MarArtHelpers::mascaraString(MarArtHelpers::masId($modelD->nu_num_ide), $modelD->nu_num_ide)
                                                        ?> e do <strong>CPF:</strong> <?=
                                                                                        (strlen($modelD->nu_num_cpf) == 0) ?
                                                                                            'NÃO INFORMADO' :
                                                                                            MarArtHelpers::mascaraString('###.###.###-##', $modelD->nu_num_cpf)
                                                                                        ?>, declaramos, sob as penas da Lei, que convivemos em regime de união estável, de natureza
                    familiar, pública e duradoura, nos termos dos artigos 1.723 e seguintes do Código Civil
                    Brasileiro, Título III – “Da União Estável”.
                <p>
                    Declaramos ainda, estarmos ciente de que, comprovada a falsidade nesta declaração,
                    estaremos sujeitos às penas previstas no Art. 299 do Código Penal Brasileiro.
                </p>
            </div>
            <div class="row">
                <div class="col-xs-6" style="text-align: left; padding: 25px 50px 25px 50px;">
                    <?= $dtDoc ?><p>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-6" style="text-align: left; padding: 25px 50px 30px 50px;">
                <strong> Declarantes:</strong>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-5" style="font-size: 14px; float: left; width: 40%; text-align: left; padding: 25px 30px 25px 30px;">
                <hr style="margin: 1px">
                <br>
                <?= 'Nome: ' . $modelR->nm_nom_res ?><br>
                CPF: <?=
                        (strlen($modelR->nu_num_cpf) == 0) ?
                            '' :
                            MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf)
                        ?>
            </div>
            <div class="col-xs-5 col-xs-offset-2" style="font-size: 14px; float: right; width: 40%; text-align: left; padding: 25px 30px 15px 30px;">
                <hr style="margin: 1px">
                <br>
                <?php if (isset($modelD)) { ?>
                    <?=
                    (strlen($modelD->nm_nom_dep) == 0) ?
                        'Nome: ' . 'XXXXXXXXXX' :
                        'Nome: ' . $modelD->nm_nom_dep
                    ?>
                    <br>CPF: <?=
                                (strlen($modelD->nu_num_cpf) == 0) ?
                                    '' :
                                    MarArtHelpers::mascaraString('###.###.###-##', $modelD->nu_num_cpf)
                                ?>
                <?php } else { ?>
                    Nome: XXXXXXXXXX<br>
                    CPF: XXXXXXXXXX

                <?php } ?>
            </div>

        </div>
        <div class="row">
            <div class="col-xs-12" style="font-size: 10px; text-align: justify;  padding: 50px 50px 0px 50px;">
                Dispõe o Artigo 299 do Código Penal Brasileiro: “Omitir, em documento público ou particular, declaração
                que dele devia constar, ou nele inserir ou fazer inserir deciaração falsa ou diversa da que devia ser
                escrita, com o fim de prejudicar direito, criar obrigação ou alterar a verdade sobre fato jundicamente
                relevante: Pena - reclusão, de 1 (um) a 5 (cinco) anos, e multa, se o documento é público, reclusão
                de 1 (um) a 3 (três) anos. e multa, se o documento é particular."
            </div>
        </div>
    </div>
</body>

</html>