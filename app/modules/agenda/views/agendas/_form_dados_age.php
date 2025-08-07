<?php


use yii\web\View;
use yii\helpers\Url;
use kartik\helpers\Html;
use yii\bootstrap5\Button;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\widgets\MaskedInput;
use kartik\widgets\ActiveForm;
use app\components\MarArtHelpers;
use kartik\datecontrol\DateControl;
use app\modules\auxiliar\models\GerState;
use app\modules\auxiliar\models\GerAssunto;

/* @var $this */
/* @var $modelA */
?>

<?php
$this->registerJs(
    "$('#age-modal').modal('show');",
    View::POS_READY
);
?>

<?php
$form = ActiveForm::begin([
    'id' => 'age',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'options' => [
        'class' => 'form',
    ],
    'method' => "POST",
]);
//$modelA->dt_age_dat = date('d-m-Y', strtotime($dt));
?>
<div class="modal fade" id="age-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content">
            <input type="hidden" id="idAge" value="<?php echo $modelA->dt_age_dat; ?>">
            <div class="modal-header">
                <div class="container">
                    <div class="row d-flex justify-content-end">
                        <button onClick='window.history.back(-1);' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <div class="roundedcirclecabicon">
                            <span class="fas fa-calendar-alt fa-4x"></span>
                        </div>
                    </div><!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h4 class="text-center">
                                <?php
                                if ($modelA->isNewRecord) {
                                    echo 'Criar Agenda';
                                } else {
                                    echo 'Editar Agenda';
                                }
                                ?>
                                <br>
                                <?=
                                'Agenda' . ' do dia ' . date('d-m-Y', strtotime($modelA->dt_age_dat)) . ' para às ' .  $modelA->ti_age_hor;
                                ?>
                            </h4>
                        </div> <!-- col -->
                    </div> <!-- row -->
                    <div class="d-flex justify-content-center">
                        <?php
                        if (!$modelA->isNewRecord) {
                            echo Html::a(
                                '<i class="fas fas fa-edit"></i>',
                                ['/agenda/agendas/pre-update', 'idAge' => $modelA->id_num_age],
                                [
                                    'type' => 'button',
                                    'class' => 'btn-primary btn-sm',
                                    'title' => 'Editar data/hora',
                                    // 'options' => ['style' => ' margin-right:1000px;'],
                                ]
                            );
                        }
                        ?>
                    </div> <!-- d-flex -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="modal-body">
                <div class="border border-warning" style="padding: 10px;">
                    <div class="row">
                        <div class="col-sm-4">
                            <?=
                            $form->field($modelA, 'nu_num_cpf')
                                ->widget(MaskedInput::class, [
                                    'id' => 'nu_num_cpf', 'mask' => '999.999.999-99',
                                    'clientOptions' => ['removeMaskOnSubmit' => true]
                                ])
                                ->textInput([
                                    'maxlength' => true,
                                    'class' => 'form-control form-control-sm',
                                ])
                            ?>
                        </div><!-- data cpf -->
                        <div class="col-sm-8">
                            <?=
                            $form->field($modelA, 'nm_nom_cid')
                                ->textInput([
                                    'maxlength' => true,
                                    'class' => 'form-control form-control-sm',
                                    'style' => ['text-transform' => 'uppercase']
                                ])
                            ?>
                        </div> <!-- data nome -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <?=
                            $form->field($modelA, 'nu_num_nis')
                                ->widget(MaskedInput::class, [
                                    'id' => 'nu_num_nis', 'mask' => '999.99999.99-9',
                                    'clientOptions' => ['removeMaskOnSubmit' => true]
                                ])
                                ->textInput([
                                    'maxlength' => true,
                                    'class' => 'form-control form-control-sm',
                                ])
                            ?>
                        </div> <!-- data nis -->
                        <div class="col-sm-6">
                            <?=
                            $form->field($modelA, 'id_num_ass')->widget(Select2::class, [
                                'size' => Select2::SMALL,
                                'theme' => Select2::THEME_KRAJEE_BS5,
                                'options' => [
                                    'prompt' => '-- Sel. assunto --',
                                ],
                                'pluginOptions' => [
                                    'class' => 'form-horizontal',
                                    'language' => 'pt-BR',
                                    'allowClear' => true,
                                ],
                                'data' => ArrayHelper::map(GerAssunto::find()->orderBy('id_num_ass')
                                    ->asArray()->all(), 'id_num_ass', 'nm_nom_ass'),
                            ])
                            ?>
                        </div> <!-- data assunto -->
                    </div> <!-- row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <?=
                            $form->field($modelA, 'nu_num_tel')
                                ->widget(MaskedInput::class, [
                                    'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
                                    'clientOptions' => ['removeMaskOnSubmit' => true,]
                                ])
                                ->textInput([
                                    'class' => 'form-control form-control-sm',
                                    'style' => ['text-transform' => 'uppercase',]
                                ])
                            ?>
                        </div> <!-- data telefone -->
                        <div class="col-sm-6">
                            <?=
                            $form->field($modelA, 'nu_num_tel_1')
                                ->widget(MaskedInput::class, [
                                    'mask' => ['(99) 9999-9999', '(99) 99999-9999'],
                                    'clientOptions' => ['removeMaskOnSubmit' => true,]
                                ])
                                ->textInput([
                                    'class' => 'form-control form-control-sm',
                                    'style' => ['text-transform' => 'uppercase',]
                                ])
                            ?>
                        </div> <!-- data telefone1 -->
                    </div><!-- row -->
                    <div class="row">
                        <div class="col-sm-6">
                            <?php
                            if (!$modelA->isNewRecord) {
                                echo $form->field($modelA, 'id_num_sta')
                                    ->widget(Select2::class, [
                                        'size' => Select2::SMALL,
                                        'theme' => Select2::THEME_KRAJEE_BS5,
                                        'options' => [
                                            'prompt' => '-- Sel. status --',
                                        ],
                                        'pluginOptions' => [
                                            'class' => 'form-horizontal',
                                            'language' => 'pt-BR',
                                            'allowClear' => true,
                                        ],
                                        'data' => ArrayHelper::map(GerState::find()->orderBy('id_num_sta')
                                            ->asArray()->all(), 'id_num_sta', 'nm_des_sta'),
                                    ]);
                            };
                            ?>
                        </div> <!-- data status -->
                    </div><!-- row -->
                    <div class="row">
                        <div class="col-sm-12">
                            <?=
                            $form->field($modelA, 'nm_nom_obs')
                                ->textarea(['maxlength' => true, 'style' => ['text-transform' => 'uppercase']])
                            ?>
                        </div> <!-- data obs -->
                    </div><!-- row -->
                </div> <!-- border -->
            </div> <!-- modal-body -->
            <div class="modal-footer d-flex justify-content-md-end">
                <?php
                if ($modelA->isNewRecord) {
                    echo Button::widget([
                        'label' => "<span class='fas fa-calendar-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>",
                        'encodeLabel' => false,
                        'options' => [
                            'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                            'href' => Url::to(["/age/agendas/create"])
                        ],
                    ]);
                } else {
                    echo Button::widget([
                        'label' => "<span class='fas fa-calendar-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>",
                        'encodeLabel' => false,
                        'options' => [
                            'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                            'href' => Url::to(["/age/agendas/update"])
                        ],
                    ]);
                    echo '&nbsp;&nbsp;&nbsp;';
                    echo '&nbsp;&nbsp;&nbsp;';
                    echo '&nbsp;&nbsp;&nbsp;';
                    echo '&nbsp;&nbsp;&nbsp;';
                    echo '&nbsp;&nbsp;&nbsp;';
                    echo '&nbsp;&nbsp;&nbsp;';
                    $urlAge = Yii::$app->urlManager->createUrl([
                        '/agenda/agendas/index-cidadao',
                        'cpfCid' => $modelA->nu_num_cpf
                    ]);
                    echo Html::button("<span class='fas fa-angle-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar Agenda</span>", [
                        'class' => 'btn btn-sm btn-outline-info mr-sm-2',
                        'onclick' => "window.location.href = '" . $urlAge . "';",
                        'data-toggle' => 'tooltip',
                        'title' => 'Voltar agenda',
                    ]);
                }
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlIndex = Yii::$app->urlManager->createUrl(['/agenda/agendas/index']);
                echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
                    'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                    'onclick' => "window.location.href = '" . $urlIndex . "';",
                    //'onclick' => "window.history.back(-1);",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar lista agendas',
                ])
                ?>
            </div> <!-- modal-footer -->
        </div> <!-- Modal content -->
    </div> <!-- modal-dialog -->
</div> <!-- modal -->
<?php ActiveForm::end(); ?>