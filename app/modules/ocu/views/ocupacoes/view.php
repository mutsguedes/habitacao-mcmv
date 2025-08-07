<?php


use yii\base\Exception;
use yii\bootstrap5\Html;
use kartik\detail\DetailView;

/* @var $this View */
/* @var $modelO Ocupacoes */

$this->title = $modelO->numRes->nm_nom_res;
$this->params['breadcrumbs'][] = ['label' => 'Ocupações', 'url' => ['/ocu/ocupacoes/index']];
$this->params['breadcrumbs'][] = ucwords(strtolower($this->title));
?>
<div class="ocupacoes-view">
    <?php
    $attributes = [
        [
            'group' => true,
            'label' => 'Ocupaçoẽs',
            'rowOptions' => [
                'class' => 'info',
                'style' => 'font-weight:bold;font-size:16px;color:green'
            ]
        ],
        [
            'columns' => [
                [
                    'attribute' => 'id_num_res',
                    'value' => $modelO->numRes->nm_nom_res,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 5%'],
                    //  'valueColOptions' => ['style' => 'width:30%'],
                    'displayOnly' => true
                ],
                [
                    'attribute' => 'id_num_apa',
                    'value' => $modelO->numApa->nu_num_qua,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 5%'],
                    'displayOnly' => true
                ],
                [
                    'attribute' => 'nu_num_lot',
                    'value' => $modelO->numApa->nu_num_lot,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 5%'],
                    'displayOnly' => true
                ],
                [
                    'attribute' => 'nu_num_blo',
                    'value' => $modelO->numApa->nu_num_blo,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 5%'],
                    'displayOnly' => true
                ],
                [
                    'attribute' => 'nu_num_apa',
                    'value' => $modelO->numApa->nu_num_apa,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 5%'],
                    'displayOnly' => true
                ],
            ],
        ],
        [
            'columns' => [
                [
                    'attribute' => 'nm_nom_obs',
                    'value' => $modelO->nm_nom_obs,
                    'format' => 'raw',
                    'labelColOptions' => ['style' => 'width: 5%'],
                    'displayOnly' => true,
                ],
            ],
        ],
    ];
    // View file rendering the widget
    try {
        echo DetailView::widget([
            'model' => $modelO,
            'attributes' => $attributes,
            'mode' => 'view',
            //'bordered' => $bordered,
            'striped' => true,
            'condensed' => true,
            'responsive' => true,
            // 'hover' => $hover,
            //  'hAlign' => $hAlign,
            //  'vAlign' => $vAlign,
            //  'fadeDelay' => $fadeDelay,
        ]);
    } catch (Exception $e) {
        Yii::$app->session->setFlash('error', $e->getMessage());
    }
    ?>
    <p>
    <div class="form-group">
        <?=
        Html::Button('Editar', [
            'id' => 'btn_editar',
            'class' => 'btn-primary btn-mini',
            'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl(['/ocu/ocupacoes/update', 'idOcu' => $modelO->id_num_ocu, 'isDel' => false]) . "';",
            'data-toggle' => 'tooltip',
            'title' => 'Editar responsável',
            'value' => 'editar',
            'name' => 'btn'
        ])
        ?>
        <?=
        Html::Button('Deletar', [
            'id' => 'btn_deletar',
            'class' => 'btn-danger btn-mini',
            'onclick' => "window.location.href = '" . Yii::$app->urlManager->createUrl(['/ocu/ocupacoes/delete-fake', 'idOcu' => $modelO->id_num_ocu]) . "';",
            'data-toggle' => 'tooltip',
            'title' => 'Deletar responsável',
            'value' => 'deletar',
            'name' => 'btn'
        ])
        ?>
        <?php
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        $urlOcu = Yii::$app->urlManager->createUrl([
            '/ocu/ocupacoes/index-ocupacao',
            'idOcu' => $modelO->id_num_ocu
        ]);
        echo Html::button('Voltar Ocupações', [
            'class' => 'btn-warning btn-mini',
            'onclick' => "window.location.href = '" . $urlOcu . "';",
            'data-toggle' => 'tooltip',
            'title' => 'Voltar Ocupações',
        ]);
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        $urlIndex = Yii::$app->urlManager->createUrl(['/ocu/ocupacoes/index']);
        echo Html::button('Voltar', [
            'class' => 'btn-primary btn-mini',
            'onclick' => "window.location.href = '" . $urlIndex . "';",
            'data-toggle' => 'tooltip',
            'title' => 'Voltar lista ocupações',
        ])
        ?>
    </div>
</div>