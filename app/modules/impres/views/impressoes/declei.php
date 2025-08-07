<?php

use app\components\MarArtHelpers;
/* @var $this View */
/* @var $modelR Responsavel */
/* @var $modelD Dependente */
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
        <div class="row" style="font-size: large; text-align: center;  padding: 0px 5px 30px 5px">
            <p style="font-size: x-large; margin: 0;"><strong>Prefeitura Municipal de Itaboraí</strong></p>
            <p style="font-size: large; margin: 0;"><strong>Secretaria Municipal de Habitação e Serviços Sociais</strong></p>
            <?php
            if ($modelR->id_num_proj == 2) {
            ?>
                <p style="font-size: x-large;">Programa Minha Casa Minha Vida</p>
            <?php
            } else {
            ?>
                <p style="font-size: x-large;">Programa Habitacional da Prefeitura Municipal de Itaboraí</p>
            <?php
            }
            ?>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: left;  padding: 0px 5px 30px 0px;">
                <strong>
                    <?php
                    if ($modelR->id_num_proj == 2) {
                    ?>Número de inscrição:
                <?php
                    } else {
                ?>
                    Manifesto de Interesse:
                <?php
                    }
                ?>
                </strong><?= MarArtHelpers::mascaraString('####.##.##', $modelR->nu_num_ins) . '/' . $modelR->nu_num_seq ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: justify; padding: 0px 0px 0px 0px;">
                <ul style="text-align: justify; line-height: 2; padding: 0px 0px 0px 0px;">
                    <strong>CP - Decreto Lei nº 2.848 de 07 de Dezembro de 1940</strong><br>
                    <ul>
                        <li>
                            - Art. 299 - Omitir, em documento público ou particular, declaração que
                            dele devia constar, ou nele inserir ou fazer inserir declaração falsa ou
                            diversa da que devia ser escrita, com o fim de prejudicar direito, criar
                            obrigação ou alterar a verdade sobre fato juridicamente relevante:
                        </li>
                        <li>
                            - Pena - reclusão, de uma cinco anos, e multa, se o documento é
                            público, e reclusão de um a três anos e multa, se o documento é particular.
                        </li>
                        <li>
                            - Parágrafo único - Se o agente é funcionário público, e comete o crime
                            prevalecendo-se do cargo, ou se a falsificação ou alteração é de
                            assentamento de registro civil, aumenta-se a pena de sexta parte.
                        </li>
                        <li>
                            - Falso reconhecimento de firma ou letra.
                        </li>
                    </ul>
                </ul>
            </div>
        </div>
        <div class="row" style="width: 50%; padding: 0px 0px 0px 170px;">
            <div class="col-xs-6 col-xs-offset-3" style="text-align: center; padding: 30px 0px 30px 0px;">
                <?= $dtDoc ?><p>
            </div>
            <div class="col-xs-6 col-xs-offset-3" style="text-align: center; padding: 30px 0px 30px 0px;">
                <strong>ESTOU CIENTE</strong>
                <p>
            </div>
            <div class="col-xs-6 col-xs-offset-3" style="text-align: center; padding: 30px 0px 30px 0px;">
                <hr style="margin: 1px">
                Assinatura do BENEFICIÁRIO<br>
                <?= $modelR->nm_nom_res ?><br>
            </div>
        </div>
    </div>
</body>

</html>