<?php

use miloschuman\highcharts\Highcharts;
use app\modules\res\models\Responsavel;

$lang = [
    'months' => ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    'shortMonths' => ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    'weekdays' => ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
    'loading' => ['Atualizando o gráfico...aguarde'],
    'contextButtonTitle' => 'Exportar gráfico',
    'decimalPoint' => ',',
    'thousandsSep' => '.',
    'downloadJPEG' => 'Baixar imagem JPEG',
    'downloadPDF' => 'Baixar arquivo PDF',
    'downloadPNG' => 'Baixar imagem PNG',
    'downloadSVG' => 'Baixar vetor SVG',
    'printChart' => 'Imprimir gráfico',
    'rangeSelectorFrom' => 'De',
    'rangeSelectorTo' => 'Para',
    'rangeSelectorZoom' => 'Zoom',
    'resetZoom' => 'Limpar Zoom',
    'resetZoomTitle' => 'Voltar Zoom para nível 1:1',
]
?>
<!--Escolaridade -->
<div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row d-flex justify-content-end">
                <button onClick='window.history.back(-1);' type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div> <!-- row -->
            <div class="row d-flex justify-content-center">
                <div class="roundedcirclecabicon">
                    <span class="fas fa-user-graduate fa-4x"></span>
                </div>
            </div> <!-- row -->
            <div class="row d-flex justify-content-center" style="padding-top: 5px">
                <div class="col-auto">
                    <h4>Grau de Instrução</h4>
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- card-header -->
    <div class="card-body">
        <div class="border border-warning" style="padding: 10px">
            <?=
            Highcharts::widget([
                'id' => 'escChar',
                'scripts' => [
                    'highcharts-3d',
                    'modules/exporting',
                    //   'themes/sand-signika',
                ],
                'options' => [
                    'lang' => $lang,
                    'credits' => ['enabled' => false],
                    'chart' => [
                        'type' => 'pie',
                        'options3d' => [
                            'enabled' => true,
                            'alpha' => 55, //adjust for tilt
                            'beta' => 0, // adjust for turn
                        ],
                        'height' => 650,
                    ],
                    'plotOptions' => [ // it is important here is code for change depth and use pie as donut
                        'pie' => [
                            'allowPointSelect' => true,
                            'cursor' => 'pointer',
                            'innerSize' => 100,
                            'depth' => 45,
                            'enabled' => true,
                            'showInLegend' => true,
                            'dataLabels' => [
                                'format' => '{point.y:1f}', // one decimal
                                'style' => [
                                    'fontSize' => '14px',
                                    'fontFamily' => 'Verdana, sans-serif'
                                ]
                            ]
                        ],
                    ],
                    'title' => [
                        //'text' => 'Contents of Highsoft\'s weekly fruit delivery'
                        'text' => 'Total de ' . Responsavel::find()
                            ->andWhere('id_cor_sit = 2')
                            ->count()
                            . ' Responsáveis '
                    ],
                    /* 'subtitle' => [
                  'text' => '3D donut in Highcharts'
                  ], */
                    'series' => [
                        [
                            'type' => 'pie',
                            'name' => ' ',
                            //'name' => 'Grau de instrução',
                            //  'data' => [[1],[2],[3],[4],[5],[6],[7],[8],[9],[10],[11]],
                        ],
                    ],
                ]
            ]);
            ?>
        </div> <!-- card-body -->
    </div> <!-- card-body-->
</div> <!-- card -->
<?php
$script = <<< JS
$.ajax({
        url:"get-escolaridade",
        type: "POST",
        data:$(this).serialize(),
        dataType: "json",
        success: function(data) { 
        var echart = $('#escChar').highcharts();
        echart.series[0].setData([['NI', parseInt(data['ninformado'],10)], 
            ['Analfabeto(a)',  parseInt(data['analfabeto(a)'],10)], 
            ['1º Grau I.', parseInt(data['pincompleto'],10)], 
            ['1º Grau C.', parseInt(data['pcompleto'],10)], 
            ['2º Grau I.', parseInt(data['sincompleto'],10)], 
            ['2º Grau C.', parseInt(data['scompleto'],10)], 
            ['3º Grau I.',  parseInt(data['tincompleto'],10)], 
            ['3º Grau C.', parseInt(data['tcompleto'],10)], 
            ['Mestrado C.', parseInt(data['mcompleto'],10)],
            ['Doutorado C.', parseInt(data['dcompleto'],10)]],true);
        console.log(data);
        console.log(echart.series[0].data[0].options);
        //$("#totDef").text(data['total'].length);
        }
    });
JS;
$this->registerJs($script);
?>