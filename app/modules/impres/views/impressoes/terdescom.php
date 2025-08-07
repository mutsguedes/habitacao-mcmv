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
        <div class="row" style="font-size: large; text-align: center;  padding: 0px 5px 0px 5px">
            <p style="font-size: x-large; margin: 0;"><strong>Prefeitura Municipal de Itaboraí</strong></p>
            <p style="font-size: large; margin: 0;"><strong>Secretaria Municipal de Habitação e Serviços Sociais</strong></p>
            <!--  <p style="font-size: x-large;">Termo de Desistência da Contemplação por Sorteio Minha Casa Minha Vida</p> -->
            <p style="font-size: x-large;">Requerimento de Desistência e Devolução de Imóvel PMCMV</p>
        </div>
        <div class="row" style="font-size: 10px;">
            <div class="col-xs-12" style="text-align: justify; line-height: 2; padding: 0px 10px 0px 10px;">
                <p>
                    Ao
                </p>
                <p>
                    FUNDO DE ARRENDAMENTO RESIDENCIAL – FAR, representado pelo BANCO DO BRASIL
                    S.A., que atua como instituição financeira oficial federal executora do Programa Minha Casa,
                    Minha Vida – PMCMV, na forma do Decreto nº 7499, de 16 de junho de 2011, que regulamenta
                    dispositivos da Lei nº 11.977, de 07 de junho de 2009, da Portaria Ministério das Cidades nº
                    168, de 12 de abril de 2013 e do Manual do Fundo de Arrendamento Residencial, Minha Casa
                    Minha Vida – FAR – MCMV
                </p>
                <p>
                    Eu <strong><?= $modelR->nm_nom_res ?></strong>, <strong>Número de inscrição: </strong><?= MarArtHelpers::mascaraString('####.##.##', $modelR->nu_num_ins) . '/' . $modelR->nu_num_seq ?>,
                    <strong>CPF: </strong>
                    <?=
                    (strlen($modelR->nu_num_cpf) == 0) ?
                        'NÃO INFORMADO' :
                        MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf)
                    ?>, <strong>RG: </strong>
                    <?=
                    (strlen($modelR->nu_num_ide) == 0) ?
                        'NÃO INFORMADO' :
                        MarArtHelpers::mascaraString(MarArtHelpers::masId($modelR->nu_num_ide), $modelR->nu_num_ide)
                    ?> residente e domiciliado (a) no município de Itaboraí, relacionado (a) como inscrito (a)
                    pelo PMCMV - Programa Minha Casa Minha Vida para este Município de Itaboraí,
                    venho através deste <strong>Termo de Desistência da Contemplação por Sorteio Minha Casa Minha Vida</strong>,
                    expressar minha decisão voluntária de desistir da contemplação por sorteio deste Programa.
                </p>
                <p>
                    na qualidade de BENEFICIÁRIO(S) do Programa Nacional de Habitação – PNHU, por meio do
                    Programa Minha Casa, Minha Vida – PMCMV, tendo como objeto o imóvel
                    Da unidade
                    <strong>
                        <?php
                        if ($modelR->id_con_ocu != '000000000') {
                            echo ' Quadra: ' . substr($modelR->id_con_ocu, 0, 2) . ', ';
                            echo ' Lote: ' . substr($modelR->id_con_ocu, 2, 2) . ', ';
                            echo ' Bloco: ' . substr($modelR->id_con_ocu, 4, 2) . ', ';
                            echo ' Apt.: ' . substr($modelR->id_con_ocu, 6, 3) . ', ';
                            echo ' Tel.: ';
                            if (strlen($modelR->nu_num_tel) == 11) {
                                echo MarArtHelpers::mascaraString(MarArtHelpers::mascTel($modelR->nu_num_tel), $modelR->nu_num_tel);
                            } else {
                                echo '_________________';
                            }
                        } else {
                            echo ' Quadra: ____, ';
                            echo ' Lote: ____, ';
                            echo ' Bloco: ____, ';
                            echo ' Apt.: ______';
                        };
                        echo ', ';
                        ?>
                    </strong>
                    do EMPREENDIMENTO Viver Melhor de Itaboraí</strong>,
                    venho por meio deste instrumento
                    apresentar meu Requerimento de Desistência e Devolução de Imóvel do PMCMV, estando
                    ciente de que com o presente não poderei participar de novos programas governamentais de
                    habitação, por ter recebido benefício habitacional do Programa Nacional de Habitação – PNHU
                    no âmbito do Minha Casa Minha Vida, com a consequente inclusão no Cadastro Nacional de
                    Mutuários (CADMUT).
                    Por força da desistência, informo que o imóvel se encontra por mim desocupado, com suas
                    chaves entregues nesta data, — que atua como instituição
                    financeira oficial federal do Programa Minha Casa, Minha Vida – PMCMV, para fins de vistoria
                    técnica para constatação do estado de conservação do imóvel, se for o caso.
                    Estou ainda ciente de que, conforme legislação vigente, o presente Requerimento somente
                    poderá ser aceito se:
                    a) contiver a ciência/anuência do Ente Público responsável pela seleção da demanda;<br>
                    b) TODAS as obrigações e encargos relativos ao contrato e ao imóvel estejam em adimplentes;<br>
                    c) o imóvel não estiver em situação de ocupação irregular;<br>
                    d) o imóvel estiver nas mesmas condições físicas em que se encontrava à época da
                    contratação, ou seja, habitável;<br>
                    e) todas as obrigações, despesas, custas cartorárias e encargos relativos à rescisão forem por
                    mim suportados.<br>
                    Por ser expressão da verdade firmo o presente,
                </p>
                <p>
                    Foram recebidos pela <strong>Secretaria Municipal de Habitação e Serviços Sociais</strong>,
                    pelo funcionário(a) <?= Yii::$app->user->identity->name ?> CPF: <?= (strlen(Yii::$app->user->identity->nu_num_cpf) == 0) ? '_________________' :
                                                                                        MarArtHelpers::mascaraString('###.###.###-##', Yii::$app->user->identity->nu_num_cpf) ?>
                    os seguintes itens assinalados:<br>
                    <input type="checkbox" name="bo">&nbsp;Chave apartamento;&nbsp;&nbsp;
                    <input type="checkbox" name="bo">&nbsp;Conta AMPLA;&nbsp;&nbsp;
                </p>
            </div>
        </div>

        <div class="row" style="font-size: 10px; padding: 0px 5px 0px 5px;">
            <div class="col-xs-6" style="text-align: center; padding: 5px 5px 5px 5px;">
                <?= $dtDoc ?><p>
            </div>
            <div class="col-xs-6" style="text-align: center; padding: 5px 0px 5px 0px;">
                <strong> Declaro estar ciente da decisão acima tomada.</strong>
                <p>
            </div>
            <div class="col-xs-6" style="text-align: center; padding: 5px 5px 5px 5px;">
                <hr style="margin: 1px">
                Assinatura do BENEFICIÁRIO<br>
                <?= $modelR->nm_nom_res ?><br>
            </div>

            <!-- <div class="col-xs-5 col-xs-offset-2" style="float: right; width: 47%; padding: 100px 0px 0px 0px;">
            <hr style="margin: 1px">
            <?php
            //echo nl2br("Nome:" . "\n" . "Ente Público:");
            ?>
            </div> -->
            <div class="col-xs-6" style="text-align: center; padding: 50px 5px 5px 5px;">
                <hr style="margin: 1px">
                Assinatura do ENTE PÚBLICO<br>
                <?= 'Nome: ' . Yii::$app->user->identity->name ?><br>
                CPF:
                <?=
                (strlen(Yii::$app->user->identity->nu_num_cpf) == 0) ?
                    '' :
                    MarArtHelpers::mascaraString('###.###.###-##', Yii::$app->user->identity->nu_num_cpf)
                ?>
                <br>
                Matrícula:
                <?=
                (strlen(Yii::$app->user->identity->nu_num_mat) == 0) ?
                    '' :
                    MarArtHelpers::mascaraString('###.###', Yii::$app->user->identity->nu_num_mat)
                ?>
            </div>
        </div>
    </div>
</body>

</html>