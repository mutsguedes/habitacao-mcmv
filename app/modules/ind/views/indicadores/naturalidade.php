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

<!-- Naturalidade -->
<div class="card">
    <div class="card-header">
        <div class="container">
            <div class="row d-flex justify-content-end">
                <button onClick='window.history.back(-1);' type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div> <!-- row -->
            <div class="row d-flex justify-content-center">
                <div class="roundedcirclecabicon">
                    <span class="fas fa-map-marked-alt fa-4x"></span>
                </div>
            </div> <!-- row -->
            <div class="row d-flex justify-content-center" style="padding-top: 5px">
                <div class="col-auto">
                    <h4>Naturalidade</h4>
                </div> <!-- col -->
            </div> <!-- row -->
        </div> <!-- container -->
    </div> <!-- card-header -->
    <div class="card-body">
        <div class="border border-warning" style="padding: 10px">
            <?=
            Highcharts::widget([
                'id' => 'natChar',
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
                        'text' => 'Total de ' . Responsavel::find()
                            ->andWhere('id_cor_sit = 2')
                            ->count()
                            . ' Responsáveis '
                    ],
                    /* 'subtitle' => [
                  'text' => '3D donut in Highcharts'
                 */
                    'series' => [
                        [
                            'type' => 'pie',
                            'name' => ' ',
                            'data' => [],
                        ],
                    ],
                ]
            ]);
            ?>
        </div> <!-- border -->
    </div> <!-- card-body-->
</div> <!-- card -->
<?php
$script = <<< JS
 $.ajax({
        url:"get-naturalidade",
        type: "POST",
        data:$(this).serialize(),
        dataType: "json",
        success: function(data) { 
        var gchart = $('#natChar').highcharts();
        gchart.series[0].setData([['NI', parseInt(data['ninformado'],10)], 
            ['AC', parseInt(data['ac'],10)], 
            ['AL', parseInt(data['al'],10)], 
            ['AM', parseInt(data['am'],10)], 
            ['AP', parseInt(data['ap'],10)], 
            ['BA', parseInt(data['ba'],10)], 
            ['CE', parseInt(data['ce'],10)], 
            ['DF', parseInt(data['df'],10)], 
            ['ES', parseInt(data['es'],10)], 
            ['GO', parseInt(data['go'],10)], 
            ['MA', parseInt(data['ma'],10)], 
            ['MG', parseInt(data['mg'],10)], 
            ['MS', parseInt(data['ms'],10)], 
            ['MT', parseInt(data['mt'],10)], 
            ['PA', parseInt(data['pa'],10)], 
            ['PB', parseInt(data['pb'],10)], 
            ['PE', parseInt(data['pe'],10)], 
            ['PI', parseInt(data['pi'],10)], 
            ['PR', parseInt(data['pr'],10)], 
            ['RJ', parseInt(data['rj'],10)], 
            ['RN', parseInt(data['rn'],10)], 
            ['RO', parseInt(data['ro'],10)],             
            ['RR', parseInt(data['rr'],10)], 
            ['RS', parseInt(data['rs'],10)],        
            ['SC', parseInt(data['sc'],10)]],true);   
        console.log(data);
        console.log(gchart.series[0].data[0].options);
        //$("#totDef").text(data['total'].length);
        }
    });
JS;
$this->registerJs($script);
?>