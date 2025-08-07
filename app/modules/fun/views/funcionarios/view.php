<?php


use yii\base\Exception;
use yii\bootstrap5\Html;
use kartik\detail\DetailView;
use app\components\MarArtHelpers;

/* @var $this View */
/* @var $modelF Funcionarios */

$this->title = $modelF->nm_nom_fun;
$this->params['breadcrumbs'][] = ['label' => 'Funcionarios', 'url' => ['index']];
$this->params['breadcrumbs'][] = ucwords(strtolower($this->title));
?>
<div class="funcionarios-view">
    <?php
    $attributes = [
        [
            'group' => true,
            'label' => 'Funcionário',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'font-weight:bold;font-size:16px;color:green'
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'nm_nom_fun',
                    'value' => $modelF->nm_nom_fun,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 5%'],
                    //  'valueColOptions' => ['style' => 'width:30%'],
                    'displayOnly' => true
                ],
                [
                    'attribute' => 'nu_cpf_fun',
                    //'label' => 'CPF',
                    'value' => MarArtHelpers::mascaraString('###.###.###-##', $modelF->nu_cpf_fun),
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 5%'],
                    // 'valueColOptions' => ['style' => 'width:10%']
                ],
                [
                    'attribute' => 'nu_ide_fun',
                    //'label' => 'CPF',
                    'value' => MarArtHelpers::mascaraString('##.###.###-#', $modelF->nu_ide_fun),
                    'format' => 'raw',
                    'displayOnly' => true,
                    'labelColOptions' => ['style' => 'width: 5%'],
                    // 'valueColOptions' => ['style' => 'width:10%']
                ],
                [
                    'attribute' => 'dt_nas_fun',
                    'label' => 'Data Nascimento:',
                    'format' => 'date',
                    'dateFormat' => 'php:d F, Y',
                    'labelColOptions' => ['style' => 'width: 12%'],
                    //'valueColOptions' => ['style' => 'width:15%'],
                    'displayOnly' => true
                ],
            ],
        ],
        [
            'group' => true,
            'label' => 'Filiação',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'font-weight:bold;font-size:16px;color:green'
            ]
            //'groupOptions'=>['class'=>'text-center']
        ],
        [
            'columns' => [
                [
                    'attribute' => 'nm_nom_mae',
                    //   'label' => 'Nome da Mãe',
                    'value' => $modelF->nm_nom_mae,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
                [
                    'attribute' => 'nm_nom_pai',
                    //  'label' => 'Nome do Pai',
                    'value' => $modelF->nm_nom_pai,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
            ],
        ],
        [
            'group' => true,
            'label' => 'Endereço',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'font-weight:bold;font-size:16px;color:green'
            ]
            //'groupOptions'=>['class'=>'text-center']
        ],
        [
            'columns' => [
                [
                    // 'attribute' => 'numEnd->nu_num_cep',
                    'label' => 'CEP:',
                    'value' => MarArtHelpers::mascaraString('##.###-###', $modelF->nu_num_cep),
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
                [
                    //  'attribute' => 'numEnd->nm_nom_log',
                    'label' => 'Logradouro:',
                    'value' => $modelF->nm_nom_log,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
                [
                    //    'attribute' => 'numEnd->nu_cas_pac',
                    'label' => 'Número:',
                    'value' => $modelF->nu_num_cas,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
                [
                    //  'attribute' => 'numEnd->nm_com_pac',
                    'label' => 'Complemento:',
                    'value' => $modelF->nm_nom_com,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
            ],
        ],
        [
            'columns' => [
                [
                    // 'attribute' => 'numEnd:nm_nom_bai',
                    'label' => 'Bairro:',
                    'value' => $modelF->nm_nom_bai,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
                [
                    //'attribute' => 'numEnd->nm_nom_mun',
                    'label' => 'Município:',
                    'value' => $modelF->nm_nom_mun,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
                [
                    //'attribute' => 'numEnd->nm_nom_est',
                    'label' => 'GerEstado:',
                    'value' => $modelF->nm_nom_est,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 5%'],
                ],
            ],
        ],
        [
            'group' => true,
            'label' => 'Contato',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'font-weight:bold;font-size:16px;color:green'
            ]
            //'groupOptions'=>['class'=>'text-center']
        ],
        [
            'columns' => [
                [
                    //  'attribute' => 'numEnd->nu_num_tel',
                    'label' => 'Telefone:',
                    'value' => (strlen($modelF->nu_num_tel) == 11) ?
                        MarArtHelpers::mascaraString('(##) #####-####', $modelF->nu_num_tel) :
                        MarArtHelpers::mascaraString('(##) ####-####', $modelF->nu_num_tel),
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
                [
                    //'attribute' => 'numEnd->nu_num_tel_1',
                    'label' => 'Telefone Contato:',
                    'value' => (strlen($modelF->nu_num_tel_1) == 11) ?
                        MarArtHelpers::mascaraString('(##) #####-####', $modelF->nu_num_tel_1) :
                        MarArtHelpers::mascaraString('(##) ####-####', $modelF->nu_num_tel_1),
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 15%'],
                ],
                [
                    'attribute' => 'nm_nom_ema',
                    //  'label' => 'e-mail',
                    'value' => $modelF->nm_nom_ema,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 10%'],
                ],
            ],
        ],
    ];
    // View file rendering the widget
    try {
        echo DetailView::widget([
            'model' => $modelF,
            'attributes' => $attributes,
            'mode' => 'view',
            //'bordered' => $bordered,
            'striped' => true,
            'condensed' => true,
            //'responsive' => true,
            // 'hover' => $hover,
            //  'hAlign' => $hAlign,
            //  'vAlign' => $vAlign,
            //  'fadeDelay' => $fadeDelay,
        ]);
    } catch (Exception $e) {
    }
    ?>
    <p>
    <div class="form-group">
        <?=
        Html::Button(
            'Editar',
            [
                'id' => 'btn_editar',
                'class' => 'btn-primary btn-mini',
                'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl(['fun/funcionarios/update', 'id' => $modelF->id_num_fun, 'isDel' => false]) . "';",
                'data-toggle' => 'tooltip',
                'title' => 'Editar funcionário',
                'value' => 'editar',
                'name' => 'btn'
            ]
        )
        ?>
        <?=
        Html::Button('Deletar', [
            'class' => 'btn-danger btn-mini', 'id' => $modelF->id_num_fun,
            'title' => 'Deletar funcionário',
            'data-confirm' => 'Funcionário deletar',
            'data-method' => 'POST'
        ])
        ?>
        <?php
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        ?>
        <?=
        Html::Button(
            'Cancelar',
            [
                'id' => 'btn_cancelar',
                'class' => 'btn-warning btn-mini',
                'onclick' => 'history.go(-1);',
                'title' => 'Cancelar',
                'value' => 'cancelar',
                'name' => 'btn'
            ]
        );
        ?>
    </div>
    </p>
</div>