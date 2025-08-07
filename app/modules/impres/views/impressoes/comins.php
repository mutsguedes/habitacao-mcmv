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
        <div class="row" style="font-size: large; text-align: center;  padding: 0px 5px 30px 5px">
            <p style="font-size: x-large; margin: 0;"><strong>Prefeitura Municipal de Itaboraí</strong></p>
            <p style="font-size: large; margin: 0;"><strong>Secretaria Municipal de Habitação e Serviços Sociais</strong></p>
            <?php
            if ($modelR->id_num_proj == 2) {
            ?>
                <p style="font-size: large;">Comprovante de Inscrição do Programa Minha Casa Minha Vida</p>
            <?php
            } else {
            ?>
                <p style="font-size: large;">Manifesto de Interesse do Programa Habitacional da Prefeitura Municipal de Itaboraí</p>
            <?php
            }
            ?>



        </div>
        <div class="row">
            <div class="col-xs-12" style="text-align: left;  padding: 0px 0px 30px 5px;">
                Srº(ª) <strong><?= $modelR->nm_nom_res ?></strong>,
                <?php
                if ($modelR->id_num_proj == 2) {
                ?>
                    sua inscrição
                <?php
                } else {
                ?>
                    seu manifesto de interesse

                <?php
                }
                ?> foi realizada com sucesso.
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="font-size: 16px; text-align: center;  padding: 0px 0px 30px 5px;">
                <strong><?php
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
                <ul style="text-align: justify; padding: 0px 0px 0px 0px;">
                    <strong>TERMO DE COMPROMISSO:</strong><br>
                    <ul>
                        <li>
                            Declaro que as informações acima indicadas foram por mim respondidas livremente,
                            representando fielmente a realidade dos fatos, estando neste ato, ciente de que qualquer
                            falsidade torna nulo, por inteiro, o presente documento.
                        </li>
                        <?php
                        if ($modelR->id_num_proj == 2) {
                        ?>
                            <li>
                                Obs: Estou ciente que o projeto M.C.M.V tem que formar demanda e esteja incluído na
                                área das ZEIS (Zona de Especial Interesse Social/e tiver água potável CEDAE e/ou SAAE.
                            </li>
                            <li>
                                Obs²: Conforme portaria 595 de 18 dez/2013, do Ministério das Cidades, referente ao
                                Programa M.C.M.V autorizo a divulgação no site da PMI o meu nome nas listagens dos candidatos
                                inscritos no Programa do Município de Itabaraí. SMHSS.
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </ul>
            </div>
        </div>
        <div class="row" style="width: 60%; padding: 0px 0px 0px 150px;">
            <div class="col-xs-6 col-xs-offset-3" style="text-align: center; padding: 30px 5px 10px 5px;">
                <?= $dtDoc ?><p>
            </div>
            <div class="col-xs-6 col-xs-offset-3" style="text-align: center; padding: 10px 5px 10px 5px;">
                <hr style="margin: 1px">
                Assinatura do BENEFICIÁRIO<br>
                <?= $modelR->nm_nom_res ?><br>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="font-size: 12px; text-align: justify; padding: 0px 0px 0px 0px;">
                Ao receber esse comprovante verifique se existe pendências, se existir corrija o mais rápido possível, pois
                isso implicará no seu cadastro. Caso tenha dúvidas procure um atendente.
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="font-size: 12px; text-align: justify; padding: 20px 0px 0px 0px;">
                <strong>INFORMAÇÕES:</strong><br>
                <strong><em>Email.:</em></strong> habitacao@itaborai.rj.gov.br<br>
                <strong><em>Tel.:</em></strong> (21)2635-4276<br>
                <?php
                if ($modelR->id_num_proj == 2) {
                ?>
                    <strong><em>Site:</em></strong> https://mcmv.itaborai.rj.gov.br/web/cli/clientes/consulta<br>
                <?php
                } ?>
                <strong><em>Facebook:</em></strong> https://facebook.com/PrefeituraMunicipaldeItaborai<br>
                <strong><em>Atendimento:</em></strong> De segunda-feira à sexta-feira das 8h às 17h<br>
                <strong><em>Endereço:</em></strong> Rua Antônio José Marins, 256 Centro (Antigo Bolsa Família)
            </div>
        </div>
        <?php
        if ($modelR->id_num_proj != 2) {
        ?>
            <div class="row">
                <div class="col-xs-12" style="font-size: 16px; text-align: justify; padding: 20px 0px 0px 0px;">
                    <strong>ATENÇÃO:</strong><br>
                    <strong>ESSE MANIFESTO É PARA UM PROGRAMA QUE AINDA NÃO TEM DATA PARA COMEÇAR. É DE TOTAL RESPONSABILIDADE DO BENEFICIÁRIO ENTRAR EM CONTATO
                        COM A SECRETARIA DE HABITAÇÃO E SERVIÇOS SOCIAIS DE ITABORAÍ, UMA VEZ POR MÊS PARA SE INFORMAR SE O PROGRAMA JÁ INICIOU.</strong>
                </div>
            </div>
            <div class="row" style="width: 60%; padding: 0px 0px 0px 150px;">
                <div class="col-xs-6 col-xs-offset-3" style="text-align: center; padding: 50px 5px 0px 5px;">
                    <hr style="margin: 1px">
                    Resp. pela INSCRIÇÃO<br>
                    <?= 'Nome: ' . Yii::$app->user->identity->name ?><br>
                    MAT.: <?=
                            (strlen(Yii::$app->user->identity->nu_num_mat) == 0) ?
                                '' :
                                Yii::$app->user->identity->nu_num_mat
                            ?>
                </div>
            </div>
        <?php
        } ?>
    </div>
</body>

</html>