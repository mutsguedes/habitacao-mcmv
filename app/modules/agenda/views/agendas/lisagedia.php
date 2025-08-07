<?php

use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelA Agendas */
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
                <td width="25%" height="100%" style="text-align: center; font-size: 18px"><strong>Lista de Presença</strong></td>
                <td width="58%" height="100%" style="text-align: center; font-size: 18px"><strong>Sec. Mun. de Habitação e Serviços Sociais</strong></td>
                <td width="23%" height="100%" style="text-align: center; font-size: 16px"><strong>Agenda de<br>Inscrição</strong></td>
                <td width="7%" height="100%" style="text-align: center"><img src="img/brasao-itaboraiNovo.png" border="0" width="35"></td>
                <td width="7%" height="100%" style="text-align: center"><img src="img/habitacaoLogo.png" border="0" width="35"></td>
            </tr>
        </table>
    </htmlpageheader>
    <htmlpagefooter name="myFooter" style="display:none">
        <table width="100%">
            <tr>
                <td width="33%">
                    <?php
                    echo 'Total de Agenda(s) - ' . count($modelA);
                    ?></td>
                <td width="33%" align="center">{PAGENO}/{nbpg}</td>
                <td width="33%" style="text-align: right;">{DATE d-m-Y}</td>
            </tr>
        </table>
    </htmlpagefooter>
    <sethtmlpageheader name="myHeader" value="on" show-this-page="1" />
    <sethtmlpagefooter name="myFooter" value="on" />
    <?php
    $qtlin = 1;
    $qtlintot = 1;
    ?>
    <?php
    if (count($modelA) != 0) {
        ?>
        <htmlpagecontent name="myContent">
            <div style="text-align: center; font-size: 18px; padding: 30px 5px 30px 5px;">
                <?= 'Itaboraí, ' . strftime('%A, %d de %B de %Y', strtotime(date("Y-m-d"))) . '.'; ?>
            </div>
            <table width="100%">
                <thead>
                    <tr>
                        <th>Nº</th>
                        <th>Hora</th>
                        <th style="text-align: center; font-size: 14px;">Nome</th>
                        <th style="text-align: center;">Assinatura</th>
                    </tr>
                </thead>
                <?php
                foreach ($modelA as $row) {
                    ?>
                    <tr>
                        <td width="3%" height="50px" style="font-size: 12px">
                            <?=
                            $qtlin; ?>
                        </td>
                        <td width="5%" height="50px" style="font-size: 12px">
                            <?=
                            $row['ti_age_hor']; ?>
                        </td>
                        <td width="12%" height="50px" style="text-align: center; font-size: 12px;">
                            <?=
                            (strlen($row['nu_num_cpf']) == 0) ?
                                'NÃO INFORMADO' :
                                MarArtHelpers::mascaraString('###.###.###-##', $row['nu_num_cpf'])
                            ?>
                        </td>
                        <td width="35%" height="50px" style="font-size: 12px">
                            <?=
                            $row['nm_nom_cid']; ?>
                        </td>
                        <td width="50%" height="50px" style="font-size: 12px">
                            <?php ?>
                        </td>

                    </tr>
                <?php
                    $qtlin++;
                    $qtlintot++;
                } ?>
            </table>
        </htmlpagecontent>
    <?php
    } else {
        ?>
        <htmlpagecontent name="myContent">

            <body>
                <div class="col-12" style="text-align: center; padding: 60%">'
                    <h1>Não existe agenda para o dia de hoje !!!</h1>
            </body>
        </htmlpagecontent>
    <?php
    }
    ?>
</body>

</html>