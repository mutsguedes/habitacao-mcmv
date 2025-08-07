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
            <p style="font-size: x-large;">Declaração de Ausência</p>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: justify; line-height: 2; padding: 0px 50px 50px 50px;">
                <p>
                    Eu <strong><?= $modelR->nm_nom_res ?></strong>, <strong><?php
                                                                            if ($modelR->id_num_proj == 2) {
                                                                            ?>Número de inscrição:
                    <?php
                                                                            } else {
                    ?>
                        Manifesto de Interesse:
                    <?php
                                                                            }
                    ?> </strong><?= MarArtHelpers::mascaraString('####.##.##', $modelR->nu_num_ins) . '/' . $modelR->nu_num_seq ?>,
                    <strong>CPF: </strong> <?=
                                            (strlen($modelR->nu_num_cpf) == 0) ?
                                                'NÃO INFORMADO' :
                                                MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf)
                                            ?> ,
                    <strong>RG: </strong><?=
                                            (strlen($modelR->nu_num_ide) == 0) ?
                                                'NÃO INFORMADO' :
                                                MarArtHelpers::mascaraString(MarArtHelpers::masId($modelR->nu_num_ide), $modelR->nu_num_ide)
                                            ?>, residente e domiciliado (a) no município de Itaboraí, relacionado (a) como inscrito (a)
                    pelo
                    <?php
                    if ($modelR->id_num_proj == 2) {
                        echo 'PMCMV - Programa Minha Casa Minha Vida para este Município de Itaboraí, ';
                    } else {
                        echo 'PHPMI - Programa Habitacional da Prefeitura Municipal de Itaboraí, ';
                    }
                    ?>

                    venho através desta <strong>Declaração de Ausência</strong>,
                    declarar a ausência de meu cônjuge, <strong><?= $modelD->nm_nom_dep ?></strong>, o qual
                    se encontra em lugar incerto e não sabido há vários anos.
                </p>
                <p>
                    Quando da data de seu desaparecimento, nós não possuíamos bens, mas agora existe a
                    expectativa da aquisição de um imóvel pelo Programa Minha Casa Minha Vida para municípios
                    com mais de 50 mil habitantes, não sendo este parte integrante do contrato.
                </p>
            </div>
        </div>

        <div class="row" style="padding: 0px 50px 0px 50px;">
            <div class="col-xs-6" style="text-align: center; padding: 30px 5px 30px 5px;">
                <?= $dtDoc ?><p>
            </div>
            <div class="col-xs-6" style="text-align: center; padding: 30px 0px 30px 0px;">
                <strong> Declaro estar ciente.</strong>
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