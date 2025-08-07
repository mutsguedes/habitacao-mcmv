<?php


use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\base\Exception;
use yii\bootstrap5\Html;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\components\MarArtHelpers;
use app\modules\email\models\EmailAssunto;

/* @var $this View */

/* @var $searchModel EmailsSearch */
/* @var $dataProvider ActiveDataProvider */

/* @var $modelE Emails */
?>
<div class="card">
    <h3 class="card-header">Lista de informações solicitadas</h3>
    <div class="card-body">
        <?php
        $gridColumns = [
            [
                'class' => '\kartik\grid\DataColumn',
                'width' => '200px',
                'attribute' => 'nu_num_seq',
                'label' => 'Protocolo:',
                'value' => function ($modelE) {
                    return Html::a(
                        $modelE->nu_num_seq . '/' . MarArtHelpers::mascaraString('##.##.####', $modelE->nu_num_num),
                        Url::to(['/emares/email-respostas/view-historico', 'idEma' => $modelE->id_num_ema])
                    );
                },
                'contentOptions' => ['style' => 'width:200px; white-space: normal;'],
                'format' => 'raw',
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'contentOptions' => ['style' => 'width:250px; white-space: normal;'],
                'hAlign' => 'center',
                'attribute' => 'assunto',
                'label' => 'Assunto:',
                'value' => 'emaAss.nm_ema_ass',
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => ArrayHelper::map(EmailAssunto::find()->orderBy('nm_ema_ass')->asArray()->all(), 'nm_ema_ass', 'nm_ema_ass'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true, /* 'minimumInputLength' => 3, */]
                ],
                'filterInputOptions' => ['placeholder' => 'Sel. assunto'],
                'format' => 'raw',
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'contentOptions' => ['style' => 'width:150px; white-space: normal;'],
                'attribute' => 'dt_tim_cri',
                'format' => ['date']
            ],
            [
                'class' => 'yii\grid\DataColumn',
                'contentOptions' => ['style' => 'width:150px; white-space: normal;'],
                'attribute' => 'dt_ema_man',
                'format' => ['raw'],
                'value' => function ($modelE) {
                    if (in_array($modelE->id_ema_sit, [4, 5])) {
                        return '';
                    } else {
                        $date = date_create($modelE->dt_ema_man);
                        return date_format($date, 'd/m/Y');
                    }
                }
            ],
            [
                'class' => '\kartik\grid\DataColumn',
                'contentOptions' => ['style' => 'width:300px; white-space: normal;'],
                'hAlign' => 'center',
                'attribute' => 'emasit',
                'label' => 'Situação:',
                'value' => 'emaSit.nm_ema_sit',
            ],
        ];
        Pjax::begin(['id' => 'pjax-ema']);
        try {
            echo GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
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
                    'maxButtonCount' => 10, // Set maximum number of page buttons that can be displayed
                ],
                'rowOptions' => function ($model, $index, $widget, $grid) {
                    return ['size' => 'sm', 'style' => 'overflow-x: scroll;'];
                },
                'resizableColumns' => false,
                'responsive' => true,
                'filterSelector' => 'select[name="per-page"]',
                'pjax' => false,
                'striped' => true,
                'hover' => true,
                'condensed' => true,
                'responsiveWrap' => true,
                'toolbar' => [
                    ['content' =>
                    Html::a('<i class="fas fa-mail-bulk"></i>', ['/email/emails/create-email'], [
                        'type' => 'button',
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'title' => 'Criar contato email',
                    ]) . '&nbsp;&nbsp;&nbsp;' .
                        Html::a('<i class="fas fa-redo-alt"></i>', ['/email/emails/index'], [
                            'type' => 'button',
                            'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                            'title' => 'Redefinir gride',
                        ]),],
                ],
                'panel' => [
                    'heading' => '<span><i class="far fa-envelope-open"></i>&nbsp;&nbsp;Emails</span>',
                    'type' => 'primary',
                    // 'footer' => false
                ],
            ]);
        } catch (Exception $e) {
            Yii::$app->session->setFlash('error', $e->getMessage());
        }
        Pjax::end();
        ?>
    </div><!-- Card body -->
    <div class="card-footer d-flex justify-content-md-end" style="margin-top: 10px;">
        <?php
        $urlE = Yii::$app->urlManager->createUrl(['/site/index']);
        echo Html::button(
            "<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>",
            [
                'id' => 'btn_voltar',
                'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                'onclick' => "window.location.href = '" . $urlE . "';",
                'title' => 'Voltar página inicial',
                'value' => 'voltar',
                'name' => 'btn_voltar'
            ]
        );
        ?>
    </div> <!-- Card footer -->
</div><!-- Card -->