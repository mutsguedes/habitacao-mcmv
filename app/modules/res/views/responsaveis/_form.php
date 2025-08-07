<?php


use Yii;
use kartik\tabs\TabsX;
use yii\base\Exception;
use kartik\helpers\Html;
use kartik\form\ActiveForm;


/* @var $this View */
/* @var $modeR Responsavel */
/* @var $form ActiveForm */
?>

<div class="responsaveis-form espacorow">
    <?php
    $form = ActiveForm::begin([
        'id' => 'responsavel-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'options' => [
            'validateOnSubmit' => true,
            'class' => 'form'
        ],
    ]);
    ?>
    <?php
    if ($modelR->isNewRecord) {
        $idres = 0;
    } else {
        $idres = $modelR->id_num_res;
    }
    $items = [
        [
            'label' => '<i class="fa fa-user-tie"></i> Responsavel',
            'content' => $this->render('_form-dadosres', ["modelR" => $modelR, 'idRes' => $idres, 'form' => $form]),
            'active' => true,
        ],
        [
            'label' => '<i class="fa fa-wheelchair"></i> Adquação',
            'linkOptions' => ['class' => !$modelR->bo_mem_def ? 'disabled' : ''],
            'headerOptions' => ['id' => 'ade'],
            'content' => $this->render('_form-dadosadquacaores', ["modelR" => $modelR, 'idRes' => $idres, 'form' => $form]),
        ],
        [
            'label' => '<i class="fa fas fa-mail-bulk"></i> Endereço',
            'content' => $this->render('_form-dadosendereco', ["modelR" => $modelR, 'idRes' => $idres, 'form' => $form]),
        ],
    ];

    try {
        echo TabsX::widget([
            'items' => $items,
            'position' => TabsX::POS_ABOVE,
            'bordered' => true,
            'encodeLabels' => false
        ]);
    } catch (Exception $e) {
    }
    ?>
    <div class="card-footer d-flex justify-content-md-end" style="margin-top: 10px;">
        <?php
        if ($modelR->isNewRecord) {
            echo Html::submitButton("<span class='fas fa-user-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>", [
                'id' => 'btn_create',
                'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                'data' => [
                    'title' => 'Criar responsável',
                    'confirm' => 'Responsável ' . $modelR->nm_nom_res . ' ADICIONADO com sussesso',
                    'module' => 'Responsável',
                    'value' => Yii::$app->controller->action->id,
                    'name' => 'b_create',
                ],
            ]);
        } else {
            echo Html::submitButton("<span class='fas fa-user-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>", [
                'id' => 'btn_update',
                'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                'data' => [
                    'title' => 'Editar responsável',
                    'confirm' => 'Responsável ' . $modelR->nm_nom_res . ' EDITADO com sussesso',
                    'module' => 'Responsável',
                    'value' => Yii::$app->controller->action->id,
                    'name' => 'b_updade',
                ],
            ]);
            echo '&nbsp;&nbsp;&nbsp;';
            echo '&nbsp;&nbsp;&nbsp;';
            echo '&nbsp;&nbsp;&nbsp;';
            echo '&nbsp;&nbsp;&nbsp;';
            echo '&nbsp;&nbsp;&nbsp;';
            echo '&nbsp;&nbsp;&nbsp;';
            $urlRes = Yii::$app->urlManager->createUrl([
                '/res/responsaveis/index-responsavel',
                'idRes' => $modelR->id_num_res
            ]);
            echo Html::button("<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Responsável</span>", [
                'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                'onclick' => "window.location.href = '" . $urlRes . "';",
                'data-toggle' => 'tooltip',
                'title' => 'Voltar responsável',
            ]);
        }
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        $urlIndex = Yii::$app->urlManager->createUrl(['/res/responsaveis/index']);
        echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
            'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
            //'onclick' => "window.location.href = '" . $urlIndex . "';",
            'onclick' => "window.history.back(-1);",
            'data-toggle' => 'tooltip',
            'title' => 'Voltar lista responsáveis',
        ])
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>