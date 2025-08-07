<?php

use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelR Responsavel */
?>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="Content-Language" content="pt-br, pt">
</head>

<body>
    <htmlpageheader name="myHeader" style="display:none">
        <table width="100%">
            <tr>
                <td width="28%" height="100%" style="text-align: center; font-size: 18px"><strong>Lista de Presença</strong></td>
                <td width="45%" height="100%" style="text-align: center; font-size: 18px"><strong>Programa Minha Casa Minha Vida</strong></td>
                <td width="33%" height="100%" style="text-align: center; font-size: 16px"><strong>
                        <?php
                        foreach ($modelR as $row) {
                            echo MarArtHelpers::titleCase($row['corSit']->nm_des_sit)
                            .' - '. $row['nm_nom_cla'];
                            break;
                        }
                        ?>
                    </strong></td>
                <td width="7%" height="100%" style="text-align: center"><img src="img/brasao-itaboraiNovo.png" border="0" width="35"></td>
                <td width="7%" height="100%" style="text-align: center"><img src="img/minhacasa4.jpeg" border="0" width="35"></td>
            </tr>
        </table>
    </htmlpageheader>
    <htmlpagefooter name="myFooter" style="display:none">
        <table width="100%">
            <tr>
                <td width="33%">
                    <?php
                    foreach ($modelR as $row) {
                        echo MarArtHelpers::titleCase($row['corSit']->nm_des_sit) . ' - Total - ' . count($modelR);
                        break;
                    }
                    ?></td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right;">{DATE d-m-Y}</td>
            </tr>
        </table>
    </htmlpagefooter>
    <sethtmlpageheader name="myHeader" value="off" show-this-page="1" />
    <sethtmlpagefooter name="myFooter" value="on" />
    <?php
    $qtlin = 1;
    $qtlintot = 1;
    ?>
    <htmlpagecontent name="myContent">
        <table width="100%">
            <thead>
                <tr>
                    <th>Nº</th>
                    <th>Class.</th>
                    <th style="text-align: center; font-size: 14px;">Nome</th>
                    <th style="text-align: center; font-size: 14px;">CPF</th>
                </tr>
            </thead>
            <?php
            foreach ($modelR as $row) {
                ?>
                <tr>
                    <td width="5%" style="font-size: 12px">
                        <?=
                        $qtlintot; ?>
                    </td>
                    <td width="2%" style="text-align: center; font-size: 12px;">
                        <?php
                        $claUrna = 4;
                if ((MarArtHelpers::GetIdade($row['dt_nas_res'])) >= 65) {
                    $claUrna = 1;
                }
                if (($row['bo_cal_urg']) === 1) {
                    $claUrna = 2;
                }
                if (($row['bo_mem_def']) === 1) {
                    $claUrna = 3;
                }
                switch ($claUrna) {
                            case '1':
                                echo 'Idoso';
                                break;
                            case '2':
                                echo 'Pri';
                                break;
                            case '3':
                                echo 'PcD';
                                break;
                            case '4':
                                echo 'Geral';
                                break;
                        } ?>
                    </td>
                    <td width="83%" style="font-size: 12px">
                        <?=
                        $row['nm_nom_res']; ?>
                    </td>
                    <td width="10%" style="text-align: left; font-size: 12px;">
                        <?=
                        (strlen($row['nu_num_cpf']) == 0) ?
                            'NÃO INFORMADO' :
                            MarArtHelpers::mascaraString('###.###.###-##', $row['nu_num_cpf'])
                        ?>
                    </td>
                </tr>
            <?php
                $qtlin++;
                $qtlintot++;
            }
            ?>
        </table>
    </htmlpagecontent>

</body>

</html>