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
    <htmlpagecontent name="myContent">
        <table width="100%">
            <?php
            foreach ($modelR as $row) {
                $nomCla = '';
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
                        $nomCla = 'Idoso';
                        break;
                    case '2':
                        $nomCla = 'Pri';
                        break;
                    case '3':
                        $nomCla = 'PcD';
                        break;
                    case '4':
                        $nomCla = 'Geral';
                        break;
                } ?>
                <tr style="background: white;">
                    <td width="45%" align="center" style="padding: 15px; font-size: 10px;">
                        <div>
                            <hr style="margin: 1px">
                            <br>
                            <span style="font-size: 15px;">
                                <?php
                                echo nl2br($row['nm_nom_res'] . "\n"); ?>
                            </span>
                            <?php
                            echo nl2br((strlen($row['nu_num_cpf']) == 0) ?
                                'NÃO INFORMADO' :
                                'CPF.: ' . MarArtHelpers::mascaraCpf($row['nu_num_cpf'])); ?>
                        </div><br>
                        <div width="100%">
                            <strong>
                                <p style="font-size: 10px;">
                                    <?=
                                    $nomCla; ?>
                                </p>
                            </strong>
                        </div>
                    </td>
                    <td width="55%" height="183px" style="font-size: 32px; padding-left: 10px; border: dashed;">
                        <strong>
                            <?=
                            $row['nm_nom_res']; ?>
                            <p style="text-align: right;font-size: 20px;">
                                <?=
                                (strlen($row['nu_num_cpf']) == 0) ?
                                    'NÃO INFORMADO' :
                                    'CPF.: ' . MarArtHelpers::mascaraCpf($row['nu_num_cpf'])
                                ?>
                            </p>
                            <p style="text-align: right;font-size: 20px;">
                                <?=
                                $nomCla; ?>
                            </p>
                        </strong>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
    </htmlpagecontent>
</body>

</html>