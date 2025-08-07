<?php

use app\components\MarArtHelpers;

//

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
    <div class="container-fluid" style="font-family: verdana,geneva; font-size: 12px; padding: 0px 0px 0px 0px;">
        <img style="float: left; margin-top: 5px" src="img/brasao-itaboraiNovo.png" border="0" width="35" height="35">
        <img style="float: right; margin-top: 5px" src="img/minhacasa4.jpeg" border="0" width="35" height="35">
        <div class="row" style="text-align: center;  padding: 0px 5px 30px 5px">
            <p style="font-size: x-large; margin: 0;"><strong>Prefeitura Municipal de Itaboraí</strong></p>
            <p style="font-size: large; margin: 0;"><strong>Secretaria Municipal de Habitação e Serviços Sociais</strong></p>
            <p style="font-size: x-large; margin: 0;">Programa Minha Casa Minha Vida</p>
        </div>
        <div class="row" style="border-style: solid; border-width: 1px; text-align: left;  padding: 5px 5px 5px 5px">
            <div class="row">
                <div style="float: left;  width: 60%; text-align: left;">
                    <strong>EMPREENDIMENTO:&nbsp;</strong> Viver Melhor Itaboraí &nbsp;&nbsp;<strong> Nr. APF.:&nbsp;</strong> 0455130-98
                </div>
                <div style="float: left;  width: 15%; text-align: left;">
                    <strong>MUNICÍPIO:&nbsp;</strong> Itaboraí
                </div>
                <div style="float: left;  width: 15%; text-align: left;">
                    <strong>UF:&nbsp;</strong> RJ
                </div>
            </div>
            <div class="row" style="padding: 10px 0px 0px 0px;">
                <div style="float: left;  width: 60%; text-align: left;">
                    <strong>CHEFE DE FAMÍLIA NO CADÚNICO:</strong> <?= $modelR->nm_nom_res ?>
                </div>
                <div style="float: left;  width: 15%; text-align: left;">
                    <strong>CPF:</strong> <?=
                                            MarArtHelpers::mascaraString('###.###.###-##', $modelR->nu_num_cpf);
                                            ?>
                </div>
                <div style="float: left;  width: 15%; text-align: left;">
                    <strong>NIS:</strong> <?=
                                            MarArtHelpers::mascaraString('###.####.###-#', $modelR->nu_num_nis);
                                            ?>
                </div>
            </div>
            <div class="row" style="padding: 10px 0px 0px 0px;">
                <div style="float: left;  width: 35%; text-align: left;">
                    <?php
                    if (($modelR->id_est_civ == 2) or ($modelR->id_est_civ == 4)
                        or ($modelR->id_est_civ == 5) or ($modelR->id_est_civ == 6)
                        or ($modelR->id_est_civ == 8)
                    ) {
                    ?>
                        <input type="checkbox" name="bo_sol_viu_div" checked="checked">
                    <?php } else { ?>
                        <input type="checkbox" name="bo_sol_viu_div">
                        <?php } ?>&nbsp;Solteiro(a)/Viúvo(a)/Divorciado(a)/Sep. Judicial
                </div>
                <div style="float: left;  width: 20%; text-align: left;">
                    <?php if ($modelR->id_est_civ == 3) { ?>
                        <input type="checkbox" name="bo_sol_cas" checked="checked">
                    <?php } else { ?>
                        <input type="checkbox" name="bo_sol_cas">
                        <?php } ?>&nbsp;Casado(a)
                </div>
                <div style="float: left;  width: 20%; text-align: left;">
                    <?php if ($modelR->id_est_civ == 7) { ?>
                        <input type="checkbox" name="bo_sol_uni_est" checked="checked">
                    <?php } else { ?>
                        <input type="checkbox" name="bo_sol_uni_est">
                        <?php } ?>&nbsp;União Estável
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xs-12" style="font-size: 10px; text-align: justify; padding: 5px 0px 5px 7px;">
                Obs.: As cópias devem estar legíveis, com carimbo de confere com original,
                com assinatura e carimbo do Raica da prefeitura e firmas conferem em caso
                de assinatura dos candidatos e testemunhas.
            </div>
        </div>
        <div id="td1" class="box-cop-doc-cab">
            <strong>Solteiro(a)/Viúvo(a)/Divorciado(a)/Sep. Judicial</strong>
        </div>
        <div id="td1" class="box-cop-doc-cab">
            <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Casado(a)</strong>
        </div>
        <div id="td1" class="box-cop-doc-cab">
            <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;União Estável</strong>
        </div>
        <div id="td1" class="box-cop-doc" style="font-size: 10px">
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_ide">&nbsp;RG ou CNH válida Responsável Familiar.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_cpf">&nbsp;CPF Responsável Familiar.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_neg">&nbsp;Declaração Negativa de União Estável.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_nas">&nbsp;Certidão de Nascimento (se solteiro).
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_ave_div">&nbsp;Certidão de Casamento averbação divórcio (se divorciado(a)).
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_ave_des">&nbsp;Certidão de Casamento averbação separação judicial. (desqu.)
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_cer_cas">&nbsp;Certidão de Casamento e Certidão de Óbito(se viúvo(a)).
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_ave_viu">&nbsp;Certidão de Casamento averbação do atestado de Óbito(se viúvo(a)).
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_dec_ben_">&nbsp;Declaração de Beneficiário MCMV.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Algum componente familiar possui deficiência?<br>
                <input type="checkbox" name="bo_def_sim">&nbsp;Sim
                <input type="checkbox" name="bo_def_nao">&nbsp;Não
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Se Sim, apresentou atestado médico para portador
                de deficiência com CID? (obrigatório Se tiver portador na família).<br>
                <input type="checkbox" name="bo_cop_ate_cid">&nbsp;Sim
                <input type="checkbox" name="bo_cop_ate_cid_n">&nbsp;Não
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Responsável familiar e Cônjuge são alfabetizados?<br>
                <input type="checkbox" name="bo_ins_sim">&nbsp;Sim
                <input type="checkbox" name="bo_ins_nao">&nbsp;Não
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Se não, apresentou Procuração pública* ou a
                declaração de assinatura “em rogo” (obrigatório analfabeto).<br>
                <input type="checkbox" name="bo_cop_pro_ror">&nbsp;Sim
                <input type="checkbox" name="bo_cop_pro_ror_n">&nbsp;Não
            </div>
            <div class="row" style="font-size: 10px; text-align: justify; padding: 63px 5px 0px 5px">
                *Enviar cópia do RG e CPF do Procurador
            </div>
        </div><!-- td1 -->
        <div id="int1" class="int-box">
        </div>
        <div id="td2" class="box-cop-doc" style="font-size: 11px">
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_ide">&nbsp;RG ou CNH válida Responsável Familiar.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_cpf">&nbsp;CPF Responsável Familiar.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_ide">&nbsp;RG ou CNH válida Cônjuge.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_cpf">&nbsp;CPF Cônjuge.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_cer_cas">&nbsp;Certidão de Casamento.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_dec_ben_">&nbsp;Declaração de Beneficiário MCMV.
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Algum componente familiar possui deficiência?<br>
                <input type="checkbox" name="bo_def_sim">&nbsp;Sim
                <input type="checkbox" name="bo_def_nao">&nbsp;Não
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Se Sim, apresentou atestado médico para portador
                de deficiência com CID? (obrigatório Se tiver portador na família).<br>
                <input type="checkbox" name="bo_cop_ate_cid">&nbsp;Sim
                <input type="checkbox" name="bo_cop_ate_cid">&nbsp;Não
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Responsável familiar e Cônjuge são alfabetizados?<br>
                <input type="checkbox" name="bo_ins_sim">&nbsp;Sim
                <input type="checkbox" name="bo_ins_nao">&nbsp;Não
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Se não, apresentou Procuração pública* ou a
                declaração de assinatura “em rogo” (obrigatório analfabeto).<br>
                <input type="checkbox" name="bo_cop_pro_ror">&nbsp;Sim
                <input type="checkbox" name="bo_cop_pro_ror">&nbsp;Não
            </div>
            <div class="row" style="font-size: 10px; text-align: justify; padding: 110px 5px 0px 5px">
                *Enviar cópia do RG e CPF do Procurador
            </div>
        </div> <!-- td2 -->
        <div id="int1" class="int-box">
        </div>
        <div id="td3" class="box-cop-doc" style="font-size: 10px">
            <div class="row" style="text-align: left; padding: 10px 5px 0px 5px">
                &nbsp;RG ou CNH válida.<br>
                <input type="checkbox" name="bo_ide_nao">&nbsp;Responsável Familiar&nbsp;&nbsp;
                <input type="checkbox" name="bo_ide_nao">&nbsp;Companheiro(a)
            </div>
            <div class="row" style="text-align: left; padding: 10px 5px 0px 5px">
                &nbsp;CPF.<br>
                <input type="checkbox" name="bo_cpf_nao">&nbsp;Responsável Familiar&nbsp;&nbsp;
                <input type="checkbox" name="bo_cpf_nao">&nbsp;Companheiro(a)
            </div>
            <div class="row" style="text-align: left; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_neg">&nbsp;Declaração Positiva ou Contrato de União Estável.
            </div>
            <div class="row" style="text-align: left; padding: 10px 5px 0px 5px">
                &nbsp;Certidão de Nascimento.<br>
                <input type="checkbox" name="bo_nas_nao">&nbsp;Responsável Familiar&nbsp;&nbsp;
                <input type="checkbox" name="bo_nas_nao">&nbsp;Companheiro(a)
            </div>
            <div class="row" style="text-align: left; padding: 10px 5px 0px 5px">
                &nbsp;Certidão de Casamento averbação divórcio (se divorciado(a)).<br>
                <input type="checkbox" name="bo_div_nao">&nbsp;Responsável Familiar&nbsp;&nbsp;
                <input type="checkbox" name="bo_div_nao">&nbsp;Companheiro(a)
            </div>
            <div class="row" style="text-align: left; padding: 10px 5px 0px 5px">
                &nbsp;Certidão de Casamento averbação desquite (se desquitado(a)).<br>
                <input type="checkbox" name="bo_des_nao">&nbsp;Responsável Familiar&nbsp;&nbsp;
                <input type="checkbox" name="bo_des_nao">&nbsp;Companheiro(a)
            </div>
            <div class="row" style="text-align: left; padding: 10px 5px 0px 5px">
                &nbsp;Certidão de Casamento averbação do atestado de Óbito(se viúvo(a)).<br>
                <input type="checkbox" name="bo_des_nao">&nbsp;Responsável Familiar&nbsp;&nbsp;
                <input type="checkbox" name="bo_des_nao">&nbsp;Companheiro(a)
            </div>
            <div class="row" style="text-align: left; padding: 10px 5px 0px 5px">
                <input type="checkbox" name="bo_cop_dec_ben">&nbsp;Declaração de Beneficiário MCMV.
            </div>
            <div class="row" style="text-align: left; padding: 10px 5px 0px 5px">
                Algum componente familiar possui deficiência?<br>
                <input type="checkbox" name="bo_def_sim">&nbsp;Sim
                <input type="checkbox" name="bo_def_nao">&nbsp;Não
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Se Sim, apresentou atestado médico para portador
                de deficiência com CID? (obrigatório Se tiver portador na família).<br>
                <input type="checkbox" name="bo_cop_ate_cid">&nbsp;Sim
                <input type="checkbox" name="bo_cop_ate_cid_n">&nbsp;Não
                &nbsp;
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Responsável familiar e Cônjuge são alfabetizados?<br>
                <input type="checkbox" name="bo_ins_sim">&nbsp;Sim
                <input type="checkbox" name="bo_ins_nao">&nbsp;Não
            </div>
            <div class="row" style="text-align: justify; padding: 10px 5px 0px 5px">
                Se não, apresentou Procuração pública* ou a
                declaração de assinatura “em rogo” (obrigatório analfabeto).<br>
                <input type="checkbox" name="bo_cop_pro_ror">&nbsp;Sim
                <input type="checkbox" name="bo_cop_pro_ror_n">&nbsp;Não
            </div>
            <div class="row" style="text-align: left; padding: 5px 5px 0px 5px">
                *Enviar cópia do RG e CPF do Procurador
            </div>
        </div> <!-- td3 -->
    </div> <!-- contairner-fluid -->
</body>

</html>