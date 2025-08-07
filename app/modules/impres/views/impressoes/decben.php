<?php

use app\components\MarArtHelpers;
use app\modules\dep\models\Dependente;
/* @var $this View */
/* @var $modelR Responsavel */
/* @var $modelD Dependente */
/* @var $dtDoc string */
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="ptb">
</head>

<body>
    <div class="container-fluid" style="font-family: verdana,geneva; font-size: 12px; padding: 0px 0px 0px 0px">
        <img style="float: left; margin-top: 5px" src="img/brasao-itaboraiNovo.png" border="0" width="35" height="35">
        <?php
        if (strtotime($modelR->dt_tim_cri) < strtotime('2022-05-01')) {
        ?>
            <img style="float: right; margin-top: 5px" src="img/minhacasa4.jpeg" border="0" width="35" height="35">
        <?php
        } else {
        ?>
            <img style="float: right; margin-top: 5px" src="img/bandeiraItaborai.png" border="0" width="40" height="30">
        <?php
        }
        ?>
        <div class="row" style="font-size: large; text-align: center; padding: 0px 0px 0px 0px">
            <p style="font-size: x-large; margin: 0;"><strong>Prefeitura Municipal de Itaboraí</strong></p>
            <p style="font-size: large; margin: 0;"><strong>Secretaria Municipal de Habitação e Serviços Sociais</strong></p>
            <p style="font-size: large; margin: 0;">Declaração de Beneficiários</p>
            <?php
            if (strtotime($modelR->dt_tim_cri) < strtotime('2022-05-01')) {
            ?>
                <p style="font-size: large; margin: 0;">Programa Minha Casa Minha Vida (PMCMV), Familiar até R$ 1.800,00 - Recursos do FAR</p>
            <?php
            } else {
            ?>
                <p style="font-size: large; margin: 0;">Programa Habitacional da Prefeitura Municipal de Itaboraí (PHPMI)</p>
            <?php
            }
            ?>
        </div>
        <div class="row" style="border-style: solid; border-width: 1px; text-align: left;  padding: 0px 5px 5px 5px">
            <div class="row" style="text-align: left;" style="padding: 5px 0px 5px 0px">
                <div class="col-xs-12">
                    <strong><i>Dados do responsável familiar</i></strong>
                </div>
            </div>
            <div class="row" style="text-align: left;">
                <div class="col-xs-12">
                    <strong>Nome: </strong>
                    <?=
                    (strlen($modelR->nm_nom_res) == 0) ?
                        'NÃO INFORMADO' :
                        $modelR->nm_nom_res
                    ?>
                </div>
            </div>
            <div class="row" style="float: left; width: 50%; text-align: left;">
                <div class="col-xs-5">
                    <strong>Cpf: </strong>
                    <?=
                    (strlen($modelR->nu_num_cpf) == 0) ?
                        'NÃO INFORMADO' :
                        MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf)
                    ?>
                </div>
                <div class="col-xs-5">
                    <strong>Rg: </strong>
                    <?=
                    (strlen($modelR->nu_num_ide) == 0) ?
                        'NÃO INFORMADO' :
                        MarArtHelpers::mascaraString(MarArtHelpers::masId($modelR->nu_num_ide), $modelR->nu_num_ide)
                    ?>
                </div>
            </div>
            <div class="row" style="float: right; width: 50%; text-align: left;">
                <div class="col-xs-5">
                    <strong>Telefone: </strong>
                    <?=
                    ((strlen($modelR->nu_num_tel) == 0) ?
                        'NÃO INFORMADO' : ((strlen($modelR->nu_num_tel) == 11) ?
                            MarArtHelpers::mascaraString('(##) ####-#####', $modelR->nu_num_tel) :
                            MarArtHelpers::mascaraString('(##) ####-####', $modelR->nu_num_tel)))
                    ?>
                </div>
                <div class="col-xs-5">
                    <strong>Profissão: </strong>
                    <?=
                    $modelR->numCbo->nm_des_cbo
                    ?>
                </div>
                <div class="col-xs-5">
                    <strong>Estado Civil: </strong>
                    <?=
                    $modelR->estCiv->nm_est_civ
                    ?>
                </div>
            </div>
            <div class="row" style="text-align: left;">
                <div class="col-xs-5">
                    <strong>Renda: R$ </strong><?= number_format($modelR->nu_ren_res, 2, ',', '.') ?>
                </div>
            </div>
            <div class="row" style="text-align: left;" style="padding: 5px 0px 5px 0px">
                <div class="col-xs-12">
                    <strong><i>Dados do cônjuge/companheiro(a)</i></strong>
                </div>
            </div>
            <?php
            $modelCon = Dependente::find()
                ->andWhere(['id_num_res' => $modelR->id_num_res])
                ->andWhere([
                    'OR',
                    ['id_num_par' => 4],
                    ['id_num_par' => 9],
                ])
                ->orderBy('id_num_par')
                ->andWhere(['bo_reg_exc' => 0])
                ->one();
            //if ((isset($modelCon)) && (($modelCon->id_num_par === 4) || ($modelCon->id_num_par === 9))) {
            if (isset($modelCon)) {
            ?>
                <div class="row" style="text-align: left;">
                    <div class="col-xs-12">
                        <strong>Nome: </strong>
                        <?=
                        (strlen($modelCon->nm_nom_dep) == 0) ?
                            'NÃO INFORMADO' :
                            $modelCon->nm_nom_dep
                        ?>
                    </div>
                </div>
                <div class="row" style="float: left; width: 50%; text-align: left;">
                    <div class="col-xs-5">
                        <strong>Cpf: </strong>
                        <?=
                        (strlen($modelCon->nu_num_cpf) == 0) ?
                            'NÃO INFORMADO' :
                            MarArtHelpers::mascaraString('###.###.###-##', $modelCon->nu_num_cpf)
                        ?>
                    </div>
                    <div class="col-xs-5">
                        <strong>Rg: </strong>
                        <?=
                        (strlen($modelCon->nu_num_ide) == 0) ?
                            'NÃO INFORMADO' :
                            MarArtHelpers::mascaraString(MarArtHelpers::masId($modelCon->nu_num_ide), $modelCon->nu_num_ide)
                        ?>
                    </div>
                </div>
                <div class="row" style="float: right; width: 50%; text-align: left;">
                    <div class="col-xs-5">
                        <strong>Telefone: </strong>
                        <?=
                        ((strlen($modelR->nu_num_tel) == 0) ?
                            'NÃO INFORMADO' : ((strlen($modelR->nu_num_tel) == 11) ?
                                MarArtHelpers::mascaraString('(##) ####-#####', $modelR->nu_num_tel) :
                                MarArtHelpers::mascaraString('(##) ####-####', $modelR->nu_num_tel)))
                        ?>
                    </div>
                    <div class="col-xs-5">
                        <strong>Profissão: </strong>
                        <?=
                        $modelCon->numCbo->nm_des_cbo
                        ?>
                    </div>
                    <div class="col-xs-5">
                        <strong>Estado Civil: </strong>
                        <?=
                        $modelCon->estCiv->nm_est_civ
                        ?>
                    </div>
                </div>
                <div class="row" style="text-align: left;">
                    <div class="col-xs-5">
                        <strong>Renda: R$ </strong>
                        <?= number_format($modelCon->nu_ren_dep, 2, ',', '.') ?>
                    </div>
                </div>
            <?php
            } else {
            ?>
                <div class="row" style="text-align: left;">
                    <div class="col-xs-12">
                        <strong>Nome: </strong>XXXXXXXXXX
                    </div>
                </div>
                <div class="row" style="float: left; width: 50%; text-align: left;">
                    <div class="col-xs-5">
                        <strong>Cpf: </strong>XXXXXXXXXX
                    </div>
                    <div class="col-xs-5">
                        <strong>Rg: </strong>XXXXXXXXXX
                    </div>
                </div>
                <div class="row" style="float: right; width: 50%; text-align: left;">
                    <div class="col-xs-5">
                        <strong>Telefone: </strong>XXXXXXXXXX
                    </div>
                    <div class="col-xs-5">
                        <strong>Profissão: </strong>XXXXXXXXXX
                    </div>
                    <div class="col-xs-5">
                        <strong>Estado Civil: </strong>XXXXXXXXXX
                    </div>
                </div>
                <div class="row" style="text-align: left;">
                    <div class="col-xs-5">
                        <strong>Renda: R$ </strong>XXXXXXXXXX
                    </div>
                </div>
            <?php } ?>
            <div class="row" style="text-align: left;" style="padding: 5px 0px 5px 0px">
                <div class="col-xs-12">
                    <strong><i>Endereço do responsável familiar</i></strong>
                </div>
            </div>
            <div class="row" style="float: left; width: 50%; text-align: left;">
                <div class="col-xs-12">
                    <strong>Logradouro: </strong>
                    <?=
                    (strlen($modelR->nm_nom_log) == 0) ?
                        'NI' :
                        $modelR->nm_nom_log
                    ?>
                </div>
            </div>
            <div class="row" style="float: right; width: 10%; text-align: left;">
                <div class="col-xs-12">
                    <strong>Nº: </strong>
                    <?=
                    (strlen($modelR->nu_num_cas) == 0) ?
                        'NI' :
                        $modelR->nu_num_cas
                    ?>
                </div>
            </div>
            <div class="row" style="float: right; width: 35%; text-align: left;">
                <div class="col-xs-12">
                    <strong>Complemento: </strong>
                    <?=
                    (strlen($modelR->nm_nom_com) == 0) ?
                        'NI' :
                        $modelR->nm_nom_com
                    ?>
                </div>
            </div>
            <div class="row" style="float: left; width: 35%; text-align: left;">
                <div class="col-xs-12">
                    <strong>Bairro: </strong>
                    <?=
                    (strlen($modelR->nm_nom_bai) == 0) ?
                        'NI' :
                        $modelR->nm_nom_bai
                    ?>
                </div>
            </div>
            <div class="row" style="float: right; width: 35%; text-align: left;">
                <div class="col-xs-12">
                    <strong>Município: </strong>
                    <?=
                    (strlen($modelR->nm_nom_mun) == 0) ?
                        'NI' :
                        $modelR->nm_nom_mun
                    ?>
                </div>
            </div>
            <div class="row" style="float: right; width: 25%; text-align: left;">
                <div class="col-xs-12">
                    <strong>Estado: </strong>
                    <?=
                    (strlen($modelR->nm_nom_est) == 0) ?
                        'NI' :
                        $modelR->nm_nom_est
                    ?>
                </div>
            </div>
        </div>
        <div class="row" style="text-align: justify; font-size: 10px; padding: 0px 0px 0px 0px;">
            <ul style="text-align: justify; padding: 0px 0px 0px 0px;">
                Para fins de inscrição junto ao
                <?php
                if (strtotime($modelR->dt_tim_cri) < strtotime('2022-05-01')) {
                ?>
                    Programa Minha Casa Minha Vida (PMCMV), Familiar até R$ 1.800,00 - Recursos do FAR,
                <?php
                } else {
                ?>
                    Programa Habitacional da Prefeitura Municipal de Itaboraí (PHPMI),
                <?php
                }
                ?>
                declaro(amos):
                <ul>
                    <li>
                        Que não sou(somos) proprietário(s), cessionário(s), arrendatário(s) ou
                        promitente(s) comprador(es) de imóvel residencial urbano ou rural no local de domicilio
                        nem onde pretende(mos) fixá-lo, e não participo(amos) de qualquer programa de financiamento,
                        parcelamento imobiliário e/ou arrendamento; em qualquer localidade do país;
                    </li>
                    <li>
                        Que não fui(fomos) beneficiado(s) em qualquer época com subsídios diretos ou indiretos
                        provenientes de recursos orçamentários da União e/ou dos Fundos Habitacionais FAR,
                        FDS, FGTS e FNHIS para aquisição de moradia;
                    </li>
                    <li>
                        Ter ciência de que o imóvel ora adquirido destina-se a residência do(s) adquirente(s),
                        não podendo alugá-lo ou cedê-lo;
                    </li>
                    <li>
                        Ter ciência de que serei(seremos) excluído(s) de qualquer outro programa similar caso
                        seja(sejamos) beneficiado(s) como presente programa;
                    </li>
                    <li>
                        Declaro(amos), ainda, que a renda bruta mensal do Grupo Familiar é de <strong>R$
                            <?= ' ' . number_format($modelR->getRenda(), 2, ',', '.') . ' ( ' . MarArtHelpers::extenso($modelR->getRenda(), 0) . ' ) ' ?>
                        </strong> , e que durante o período de parcelamento permitirei(permitiremos) a fiscalização do
                        imóvel pela instituição financeira ou preposto devidamente identificado.
                    </li>
                    <?php if ($modelR->bo_cal_urg) { ?>
                        <li>
                            <?php
                            if (strtotime($modelR->dt_tim_cri) < strtotime('2022-05-01')) {
                            ?>

                                Possuo(Possuímos) renda familiar até 3.275,00 e estou(amos) enquadrado(s) na condição de Calamidade Pública/Situação de
                                Emergência ou operações PMCMV vinculadas ao PAC - Programa de Aceleração do Crescimento.
                            <?php
                            } else {
                            ?>
                                Possuo(Possuímos) renda familiar até 3.275,00 e estou(amos) enquadrado(s) na condição de Calamidade Pública/Situação de
                                Emergência ou operações PHPMI.
                        </li>
                    <?php
                            };
                        };
                        $modelDef = Dependente::findAll(['id_num_res' => $modelR->id_num_res, 'bo_mem_def' => '1']);
                        //if (($modelR->bo_mem_def) || (isset($modelD->bo_mem_def) && ($modelD->bo_mem_def))) {
                        if (($modelR->bo_mem_def) || (!empty($modelDef))) {
                            $codCidR = '';
                            $codCidD = '';
                            $desCidR = '';
                            $desCidD = '';
                            $ade = 0;
                            $fis = 0;
                            $vis = 0;
                            $int = 0;
                            $aud = 0;
                            $nan = 0;
                            $mul = 0;
                    ?>
                    <li>
                        Sou(Somos) pessoa(s) com deficiência e/ou tenho(amos) pessoa(s) da família com deficiência.<br>
                        Nome(s) da(s) pessoa(s) com deficiência(s):<br>
                        <?php
                            if (($modelR->bo_mem_def)) {
                        ?>
                            <div class="row" style="float: left; width: 50%; text-align: left;">
                                <div class="col-xs-12">
                                    <b>
                                        <?=
                                        $modelR->nm_nom_res;
                                        ?>
                                    </b>
                                </div>
                            </div>
                            <div class="row" style="float: right; width: 50%; text-align: left;">
                                <div class="col-xs-12">
                                    <?=
                                    'RESPONSÁVEL'
                                    ?>
                                </div>
                            </div>
                        <?php
                            };
                            if (($modelR->bo_mem_def) && (($modelR->bo_ade_fis) || ($modelR->bo_ade_vis) ||
                                ($modelR->bo_ade_int) || ($modelR->bo_ade_aud) || ($modelR->bo_ade_nan) || ($modelR->bo_ade_mul))) {
                                // echo nl2br("<b>" . $modelR->nm_nom_res . "</b>\n");
                                $codCidR = $modelR->nu_cod_cid;
                                $desCidR = $modelR->nm_des_cid;
                                $ade = $modelR->bo_mem_def;
                                $fis = $modelR->bo_ade_fis;
                                $vis = $modelR->bo_ade_vis;
                                $int = $modelR->bo_ade_int;
                                $aud = $modelR->bo_ade_aud;
                                $nan = $modelR->bo_ade_nan;
                                $mul = $modelR->bo_ade_mul;
                            }
                        ?>
                        <?php
                            $modelDef = Dependente::findAll(['id_num_res' => $modelR->id_num_res, 'bo_mem_def' => '1']);
                            if (is_array($modelDef)) {
                                for ($i = 0; $i < count($modelDef); $i++) {
                                    if (isset($modelDef[$i]->bo_mem_def)) {
                                        if (($modelDef[$i]->bo_mem_def) && (($modelDef[$i]->bo_ade_fis) || ($modelDef[$i]->bo_ade_vis) ||
                                            ($modelDef[$i]->bo_ade_int) || ($modelDef[$i]->bo_ade_aud) || ($modelDef[$i]->bo_ade_nan) || ($modelDef[$i]->bo_ade_mul))) {
                        ?>
                                        <div class="row" style="float: left; width: 50%; text-align: left;">
                                            <div class="col-xs-12">
                                                <b>
                                                    <?=
                                                    $modelDef[$i]->nm_nom_dep;
                                                    ?>
                                                </b>
                                            </div>
                                        </div>
                                        <div class="row" style="float: right; width: 50%; text-align: left;">
                                            <div class="col-xs-12">
                                                <?=
                                                $modelDef[$i]['numPar']->nm_nom_par;
                                                ?>
                                            </div>
                                        </div>
                        <?php
                                            if ((empty($codCidR)) && (empty($codCidD))) {
                                                $codCidD = $codCidD . $modelDef[$i]['nu_cod_cid'];
                                                $desCidD = $desCidD . $modelDef[$i]['nm_des_cid'];
                                            } else {
                                                $codCidD = $codCidD . '/ ' . $modelDef[$i]['nu_cod_cid'];
                                                $desCidD = $desCidD . '/ ' . $modelDef[$i]['nm_des_cid'];
                                            }
                                            $ade = $modelDef[$i]->bo_mem_def;
                                            $fis = $modelDef[$i]->bo_ade_fis;
                                            $vis = $modelDef[$i]->bo_ade_vis;
                                            $int = $modelDef[$i]->bo_ade_int;
                                            $aud = $modelDef[$i]->bo_ade_aud;
                                            $nan = $modelDef[$i]->bo_ade_nan;
                                            $mul = $modelDef[$i]->bo_ade_mul;
                                        }
                                    } else {
                                        echo nl2br("<b>" . $modelD->nm_nom_dep . "</b>\n");
                                        $codCidD = $modelD->nu_cod_cid;
                                        $desCidD = $modelD->nm_des_cid;
                                    }
                                }
                            }
                            if (!(empty($codCidR)) && !(empty($codCidD))) {
                                echo nl2br("CID(Classificação Internacional de Doenças) nº <b>" . $codCidR . ", " . $codCidD . "</b>\n");
                                if (!(empty($desCidR)) && !(empty($desCidD))) {
                                    echo nl2br("Descrição do CID: <b>" . $desCidR . ", " . $desCidD . "</b>\n");
                                } else {
                                    echo nl2br("Descrição do CID: <b>" . "NÃO INFORMADO" . "</b>\n");
                                }
                            } elseif (!(empty($codCidR))) {
                                echo nl2br("CID(Classificação Internacional de Doenças) nº <b>" . $codCidR . "</b>\n");
                                if (!(empty($desCidR))) {
                                    echo nl2br("Descrição do CID: <b>" . $desCidR . "</b>\n");
                                } else {
                                    echo nl2br("Descrição do CID: <b>" . "NÃO INFORMADO" . "</b>\n");
                                }
                            } elseif (!(empty($codCidD))) {
                                echo nl2br("CID(Classificação Internacional de Doenças) nº <b>" . $codCidD . "</b>\n");
                                if (!(empty($desCidD))) {
                                    echo nl2br("Descrição do CID: <b>" . $desCidD . "</b>\n");
                                } else {
                                    echo nl2br("Descrição do CID: <b>" . "NÃO INFORMADO" . "</b>\n");
                                }
                            } else {
                                echo nl2br("CID(Classificação Internacional de Doenças) nº <b>" . "NÃO INFORMADO" . "</b>\n");
                            }
                        ?>
                        Será necessário promover adequação no imóvel pretendido ?
                        <input type="checkbox" name="bo_def_sim" checked="checked">&nbsp;Sim
                        <input type="checkbox" name="bo_def_nao">&nbsp;Não
                        <br>Tipo(s) de adequação do imóvel:
                        <?php if (($ade) && ($fis)) { ?>
                            <input type="checkbox" name="bo_ade_fis" checked="checked">&nbsp;Física
                        <?php } else { ?>
                            <input type="checkbox" name="bo_ade_fis">&nbsp;Física
                        <?php } ?>
                        <?php if (($ade) && ($vis)) { ?>
                            <input type="checkbox" name="bo_ade_vis" checked="checked">&nbsp;Visual
                        <?php } else { ?>
                            <input type="checkbox" name="bo_ade_vis">&nbsp;Visual
                        <?php } ?>
                        <?php if (($ade) && ($int)) { ?>
                            <input type="checkbox" name="bo_ade_int" checked="checked">&nbsp;Intelectual
                        <?php } else { ?>
                            <input type="checkbox" name="bo_ade_int">&nbsp;Intelectual
                        <?php } ?>
                        <?php if (($ade) && ($aud)) { ?>
                            <input type="checkbox" name="bo_ade_aud" checked="checked">&nbsp;Auditiva
                        <?php } else { ?>
                            <input type="checkbox" name="bo_ade_aud">&nbsp;Auditiva
                        <?php } ?>
                        <?php if (($ade) && ($nan)) { ?>
                            <input type="checkbox" name="bo_ade_nan" checked="checked">&nbsp;Nanismo
                        <?php } else { ?>
                            <input type="checkbox" name="bo_ade_nan">&nbsp;Nanismo
                        <?php } ?>
                        <?php if (($ade) && ($mul)) { ?>
                            <input type="checkbox" name="bo_ade_mul" checked="checked">&nbsp;Múltipla
                        <?php } else { ?>
                            <input type="checkbox" name="bo_ade_mul">&nbsp;Multipla
                        <?php } ?>
                    </li>
                <?php } ?>
                <li>
                    Estou(Estamos) ciente(s) de que no caso de qualquer declaração falsa estarei(estaremos) obrigado(s)
                    a devolver a totalidade do subsídio pelo qual fui(fomos) diretamente ou indiretamente beneficiado(s),
                    atualizado pela taxa média diária ajustada dos financiamentos apurados no Sistema Especial
                    de Liquidação e de Custódia - SELIC, sob pena de inscrição nos cadastros restritivos, sem
                    prejuízo das demais ações cabíveis.
                </li>
                <li>
                    Nestas condições, DECLARA(M)-SE suficientemente esclarecido(s) de que eventual
                    falsidade nas informações prestadas/ nesta “declaração configura <strong>OS CRIMES DE
                        FALSIDADE IDEOLÓGICA e ESTELIONATO</strong>, previstos no Código Penal Brasileiro,
                    ensejando o pedido de abertura do competente <strong>INQUÉRITO POLICIAL</strong> junto à Policia
                    Federal.
                </li>
                </ul>
            </ul>
        </div>
        <div class="col-xs-5" style="text-align: left; padding: 15px 5px 20px 5px;">
            <?= $dtDoc ?><p>
        </div>
        <div class="row">
            <div class="col-xs-5" style="float: left; width: 47%; text-align: left; padding: 0px 0px 0px 0px;">
                <hr style="margin: 1px">
                Assi. do BENEFICIÁRIO<br>
                <?php
                echo nl2br("Nome: " . $modelR->nm_nom_res . "\n" . "RG/CPF: ");
                echo nl2br(((strlen($modelR->nu_num_ide) == 0) && (strlen($modelR->nu_num_cpf) == 0)) ?
                    "" :
                    MarArtHelpers::mascaraString(MarArtHelpers::masId($modelR->nu_num_ide), $modelR->nu_num_ide) . " / " .
                    MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf));
                ?>
            </div>
            <div class="col-xs-5 col-xs-offset-2" style="float: right; width: 47%; text-align: left; padding: 0px 0px 0px 0px;">
                <hr style="margin: 1px">
                Assi. do BENEFICIÁRIO[(cônjuge/companheiro(a)]<br>
                <?php
                // if ((isset($modelD)) && (($modelD->id_num_par === 4) || ($modelD->id_num_par === 9))) {
                if (isset($modelCon)) {
                    echo nl2br(
                        (strlen($modelCon->nm_nom_dep) == 0) ?
                            "Nome: XXXXXXXXXX" . "/n" :
                            "Nome: " . $modelCon->nm_nom_dep . "\n" . "RG/CPF: "
                    );
                    echo nl2br(((strlen($modelCon->nu_num_ide) == 0) && (strlen($modelCon->nu_num_cpf) == 0)) ?
                        "" :
                        MarArtHelpers::mascaraString(MarArtHelpers::masId($modelCon->nu_num_ide), $modelCon->nu_num_ide) . " / " .
                        MarArtHelpers::mascaraString('###.###.###-##', $modelCon->nu_num_cpf));
                } else {
                    echo nl2br("Nome: XXXXXXXXXX" . "\n" . "RG/CPF: XXX.XXX.XXX.-XX / XXXXXXXX.XX");
                }
                ?>
            </div>
        </div>
        <div class="col-xs-5" style="text-align: left; padding: 15px 0px 30px 0px;">
            Testemunhas
        </div>
        <div class="row">
            <div class="col-xs-5" style="float: left; width: 47%; text-align: left; padding: 10px 0px 0px 0px;">
                <hr style="margin: 1px">
                <?= 'Nome: ' . Yii::$app->user->identity->name ?><br>
                CPF: <?=
                        (strlen(Yii::$app->user->identity->nu_num_cpf) == 0) ?
                            '' :
                            MarArtHelpers::mascaraString('###.###.###-##', Yii::$app->user->identity->nu_num_cpf)
                        ?>
            </div>
            <div class="col-xs-5 col-xs-offset-2" style="float: right; width: 47%; padding: 10px 0px 0px 0px;">
                <hr style="margin: 1px">
                <?php
                echo nl2br("Nome:" . "\n" . "CPF:");
                ?>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="font-size: 7px; text-align: justify;  padding: 30px 0px 0px 0px;">
                Dispõe o Artigo 299 do Código Penal Brasileiro: “Omitir, em documento público ou particular, declaração
                que dele devia constar, ou nele inserir ou fazer inserir declaração falsa ou diversa da que devia ser
                escrita, com o fim de prejudicar direito, criar obrigação ou alterar a verdade sobre fato juridicamente
                relevante: Pena - reclusão, de 1 (um) a 5 (cinco) anos, e multa, se o documento é público, reclusão
                de 1 (um) a 3 (três) anos. e multa, se o documento é particular."
            </div>
        </div>
    </div> <!-- container -->
</body>

</html>