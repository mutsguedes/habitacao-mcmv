<?php

use kartik\icons\Icon;
use kartik\tabs\TabsX;
use yii\base\Exception;
use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this View */
/* @var $modelF Funcionarios */
/* @var $form ActiveForm */
?>

<div class="funcionarios-form">
    <?php
    $form = ActiveForm::begin([
        'id' => 'funcionario-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'options' => [
            'validateOnSubmit' => true,
            'class' => 'form'
        ],
    ]);
    ?>
    <?php
    Icon::map($this);
    $items = [
        [
            'label' => '<i class="fa fa-user"></i> Funcionário',
            'content' => $this->render('_form-dadosfun', ['modelF' => $modelF, 'form' => $form]),
            //'active'=>true
        ],
        [
            'label' => '<i class="fa fa-address-book"></i> Endereço',
            'id' => 'enderecos',
            'content' => $this->render('_form-dadosendereco', ['modelF' => $modelF, 'form' => $form]),
        ],
        /* [
              'label' => '<i class="fa fa-calendar"></i> Agenda',
              'content' => $this->render('@app/modules/age/views/agendas/_form-age-grid', ['dataProvider' => $dataProviderA, 'idFun' => $idFun]),
              'headerOptions' => $modelF->isNewRecord ? ['class' => 'disabled'] : ['class' => 'enabled'],
              'active' => $isDel ? true : false,
              ], */
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
    <p>
    <div class="form-group">
        <?php
        if ($modelF->isNewRecord) {
            echo Html::submitButton(
                'Salvar',
                [
                    'id' => 'btn_salvar',
                    'class' => 'btn-success btn-mini',
                    'data-toggle' => 'tooltip',
                    'title' => 'Criar funcionário',
                    'data-confirm' => 'Funcionário criar',
                    'value' => 'criar',
                    'name' => 'btn',
                ]
            );
        } else {
            echo Html::submitButton(
                'Salvar',
                [
                    'id' => 'btn_salvar',
                    'class' => 'btn-success btn-mini',
                    'data-toggle' => 'tooltip',
                    'title' => 'Editar funcionário',
                    'data-confirm' => 'Funcionário editar',
                    'value' => 'editar',
                    'name' => 'btn'
                ]
            );
        }
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo Html::Button(
            'Cancelar',
            [
                'id' => 'btn_cancelar',
                'class' => 'btn-warning btn-mini',
                'onclick' => 'history.go(-1);',
                'value' => 'cancelar',
                'name' => 'btn'
            ]
        );
        ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>