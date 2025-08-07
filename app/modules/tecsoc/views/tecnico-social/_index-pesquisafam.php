<?php


use yii\widgets\Pjax;
use yii\base\Exception;
use kartik\helpers\Html;
use kartik\grid\GridView;
use kartik\form\ActiveForm;

/* @var $this View */
/* @var $form ActiveForm */

/* @var $modelTC TecnicoSocial */
/* @var $dataProviderF ActiveDataProvider */
?>

<div class="indexPesFam-form espacorow">
    <?php
    $form = ActiveForm::begin([
        'id' => 'pesfam',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'options' => [
            'validateOnSubmit' => true,
            'class' => 'form'
        ],
    ]);
    ?>
    <div class="card-header">
        <h4 style="color: red; text-align: left">Família</h4>
    </div>
    <div class="card-body">
        <h5 class="card-title" style="color: blue; text-align: left;">Pesquisa Familiar</h5>
        <?php
        $pessoas = $dataProviderF->getModels();
        $gridColumnsF = [
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'nm_ide_pes',
                'label' => 'Id:',
                'contentOptions' => ['style' => 'width:50px; white-space: normal;',],
                'hAlign' => 'center',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'attribute' => 'nm_nom_pes',
                'label' => 'Nome:',
            ],
            [
                'class' => '\kartik\grid\ActionColumn',
                'options' => ['style' => 'width:10%'],
                'template' => '{docSer}',
                'buttons' => [
                    'docSer' => function ($modelTSFam, $url, $pessoas) {
                        if ($modelTSFam->isNewRecord) {
                            $url = Yii::$app->urlManager->createUrl(
                                [
                                    '/tecsoc/tecnico-social/create-tecsoc-familia',
                                    'idPes' => $pessoas['id_num_pes'],
                                    'idTip' => $pessoas['nm_ide_pes'],
                                ],
                            );
                            $tit = 'Criar pesquisa familia';
                            return Html::a('<i class="far fa-id-card"></i>', $url, [
                                'class' => 'btncolorpesteccri',
                                'title' => $tit,
                            ]);
                        } else {
                            $url = Yii::$app->urlManager->createUrl(
                                [
                                    '/tecsoc/tecnico-social/create-tecsoc-familia',
                                    'idPes' => $pessoas['id_num_pes'],
                                    'idTip' => $pessoas['nm_ide_pes'],
                                ],
                            );
                            $tit = 'Criar pesquisa familia';
                            return Html::a('<i class="far fa-id-card"></i>', $url, [
                                'class' => 'btncolorupdate',
                                'title' => $tit,
                            ]);
                        }
                    },
                ],
            ],
        ];
        Pjax::begin([
            'id' => 'pjax-pes-fam',
        ]);
        try {
            echo GridView::widget([
                'dataProvider' => $dataProviderF,
                'columns' => $gridColumnsF,
                'rowOptions' => function () {
                    return ['size' => 'sm', 'style' => 'overflow-x: scroll;'];
                },
                'pjax' => false,
                'striped' => true,
                'hover' => true,
                'condensed' => true,
                'toolbar' => false,
                'panel' => [
                    'heading' => '<span><i class="fas fa-users"></i>&nbsp;&nbsp;Composição Familia</span>',
                    'type' => 'primary',
                    'footer' => false
                ],
            ]);
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e);
        }
        Pjax::end();
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>