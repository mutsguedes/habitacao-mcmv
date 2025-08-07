<?php


use yii\widgets\Pjax;
use yii\base\Exception;
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\components\MarArtHelpers;
use app\modules\auxiliar\models\Cargos;
use app\modules\fun\models\Funcionarios;
use app\modules\auxiliar\models\CargaHorarias;

/* @var $this View */
/* @var $searchModel FuncionariosSearch */
/* @var $dataProvider ActiveDataProvider */

/* @var $modelF Funcionarios */
/* @var $form ActiveForm */

$this->title = 'Funcionários';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="funcionarios-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]);  
    ?>
    <?php
    $gridColumns = [
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nm_nom_fun',
            'value' => function ($modelF) {
                return $modelF->nm_nom_fun;
            },
            'contentOptions' => [
                'style' => 'font-size: 100%;'
            ],
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Funcionarios::find()
                ->orderBy('nm_nom_fun')->asArray()
                ->all(), 'nm_nom_fun', 'nm_nom_fun'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione funcionário'],
            'format' => 'raw',
            'width' => '970px',
        ],
        /*  [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'cargo',
            'label' => 'Cargo:',
            'value' => function ($modelF) {
                return $modelF->numCar->nm_des_car;
            },
            'width' => '350px',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(Cargos::find()
                            ->orderBy('nm_des_car')->asArray()
                            ->all(), 'nm_des_car', 'nm_des_car'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione cargo'],
            'format' => 'raw',
        ], */
        /* [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'cargahora',
            'label' => 'C.H.:',
            'value' => function ($modelF) {
                return $modelF->numHor->nu_car_hor;
            },
            'width' => '50px',
            'filterType' => GridView::FILTER_SELECT2,
            'filter' => ArrayHelper::map(CargaHorarias::find()
                            ->orderBy('nu_car_hor')->asArray()
                            ->all(), 'nu_car_hor', 'nu_car_hor'),
            'filterWidgetOptions' => [
                'pluginOptions' => ['allowClear' => true, 'minimumInputLength' => 3,]
            ],
            'filterInputOptions' => ['placeholder' => 'Selecione C.H.'],
            'format' => 'raw',
        ], */
        [
            'class' => '\kartik\grid\DataColumn',
            'attribute' => 'nu_num_tel',
            'label' => 'Telefone:',
            'value' => function ($modelF) {
                return (strlen($modelF->nu_num_tel) == 11) ?
                    MarArtHelpers::mascaraString('(##) ####-#####', $modelF->nu_num_tel) :
                    MarArtHelpers::mascaraString('(##) ####-####', $modelF->nu_num_tel);
            },
            'width' => '150px',
        ],
        [
            'class' => '\kartik\grid\ActionColumn',
            //'header' => '<p class = "text-center">Ação</p>',
            //'header' => '<i class = "text-center">Ação</i>',
            'template' => '{view} {update} {delete}',
            'buttons' => [
                'view' => function ($url, $modelF) {
                    return Html::a('', $url, [
                        //'style' => 'color:#03A9F4',
                        'class' => 'btncolorview glyphicon glyphicon-eye-open', /* 'id' => 'modalButton', */
                        'title' => 'Exibir Funcionário',
                    ]);
                },
                'update' => function ($url, $modelF) {
                    $url = Yii::$app->urlManager->createUrl([
                        'fun/funcionarios/update',
                        'id' => $modelF->id_num_fun
                    ]);
                    return Html::a('', $url, [
                        'class' => 'btncolorupdate glyphicon glyphicon-pencil', /* 'id' => 'modalButton', */
                        'title' => 'Editar Funcionário',
                    ]);
                },
                'delete' => function ($url, $modelF) {
                    return Html::a('', $url, [
                        //'style' => 'color:#E34724',
                        'class' => 'btncolordelete glyphicon glyphicon-trash',
                        'title' => 'Deletar funcionário',
                        'data-confirm' => 'Funcionário deletar',
                        'data-method' => 'POST'
                    ]);
                },
            ]
        ],
    ];
    Pjax::begin(['id' => 'pjax-gridview']);
    try {
        echo GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'pager' => [
                'options' => ['class' => 'pagination pagination-sm'], // set clas name used in ui list of pagination
                'prevPageLabel' => 'Anterior', // Set the label for the "previous" page button
                'nextPageLabel' => 'Próximo', // Set the label for the "next" page button
                'firstPageLabel' => 'Primeiro', // Set the label for the "first" page button
                'lastPageLabel' => 'Último', // Set the label for the "last" page button
                'nextPageCssClass' => 'next', // Set CSS class for the "next" page button
                'prevPageCssClass' => 'prev', // Set CSS class for the "previous" page button
                'firstPageCssClass' => 'first', // Set CSS class for the "first" page button
                'lastPageCssClass' => 'last', // Set CSS class for the "last" page button
                'maxButtonCount' => 20, // Set maximum number of page buttons that can be displayed
            ],
            'pjax' => true,
            'striped' => true,
            'hover' => true,
            'condensed' => true,
            //'showFooter' => false,
            'filterSelector' => 'select[name="per-page"]',
            'toolbar' => [
                [
                    'content' =>
                    Html::a('<i class="fa fa-plus"></i>', ['create'], [
                        'type' => 'button',
                        'class' => 'btn-success btn-sm',
                        'title' => 'Criar Funcionário',
                    ]) . '&nbsp;&nbsp;&nbsp;' .
                        Html::a('<i class="fa fa-refresh"></i>', [''], [
                            'type' => 'button',
                            // 'data-pjax' => 0,
                            'class' => 'btn-info btn-sm',
                            'title' => 'Redefinir gride',
                        ]),
                ],
            ],
            'panel' => [
                'heading' => '<h3 class="panel-title"><i class="gaers"></i>&nbsp;&nbsp;Funcionários</h3>',
                'type' => 'primary',
                //'footer' => false
            ],
        ]);
    } catch (Exception $e) {
    }
    Pjax::end();
    ?>
</div>