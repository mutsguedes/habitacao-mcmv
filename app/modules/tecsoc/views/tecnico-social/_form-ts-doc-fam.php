<?php



use kartik\helpers\Html;
use kartik\form\ActiveForm;
use kartik\widgets\SwitchInput;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;

/* @var $this View */
/* @var $form ActiveForm */

/* @var $modelTSD TecsocDocumento */

/* @var $idRes */
/* @var $idPes */
/* @var $idTip */
?>
<?php
$form = ActiveForm::begin([
    'id' => 'doc-ser',
    'enableClientValidation' => true,
    'options' => array(
        'class' => 'form',
    ),
]);
?>
<div class="card-header">
    <div class="row d-flex justify-content-center">
        <div class="roundedcirclecabicon">
            <span class="far fa-id-card fa-4x"></span>
        </div>
    </div><!-- row -->
    <div class="row d-flex justify-content-center" style="padding-top: 5px">
        <?php
        //                    if (Yii::$app->request->getQueryParam('idTip') == 'R') {
        if ($idTip == 'R') {
            $pes = Responsavel::findOne(['id_num_res' => $idPes]);;
        ?>
            <h4 align="middle">Documento(s) do(a) Responsável<br>
                <?php
                echo Html::label($pes->nm_nom_res, null, ['style' => 'color:red']);
                ?>
            </h4>
        <?php
        } else {
            //                        $idDep = Yii::$app->request->getQueryParam('idPes');
            $pes = Dependente::findOne(['id_num_dep' => $idPes]);
        ?>
            <h4 align="middle">Documento(s) do(a) Dependente<br>
            <?php
            echo Html::label($pes->nm_nom_dep, null, ['style' => 'color:red']);
        }
            ?>
            </h4>
    </div>
</div> <!-- card-header -->
<div class="card-body">
    <h5 class="card-title" style="color: blue; text-align: left;">Documentos</h5>
    <div class="row">
        <div id="bo_cop_cpf" class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSD, 'bo_reg_ger')->widget(SwitchInput::class, [
                'id' => 'bo_reg_ger',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ]
            ])
            ?>
        </div>
        <div id="bo_cop_ide" class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSD, 'bo_car_tra')->widget(SwitchInput::class, [
                'id' => 'bo_reg_ger',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ]
            ])
            ?>
        </div>

        <div id="bo_cop_ave_div" class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSD, 'bo_cad_cpf')->widget(SwitchInput::class, [
                'type' => SwitchInput::CHECKBOX,
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>

        <div id="bo_cop_ave_des" class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSD, 'bol_cer_nas')->widget(SwitchInput::class, [
                'type' => SwitchInput::CHECKBOX,
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div id="bo_cop_ave_des" class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSD, 'bo_cer_cas')->widget(SwitchInput::class, [
                'type' => SwitchInput::CHECKBOX,
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div id="bo_cop_sep_jud" class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSD, 'bo_tit_ele')->widget(SwitchInput::class, [
                'type' => SwitchInput::CHECKBOX,
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
        <div id="bo_cop_obi" class="col-xs-12 col-sm-2">
            <?=
            $form->field($modelTSD, 'bo_ine_nis')->widget(SwitchInput::class, [
                'type' => SwitchInput::CHECKBOX,
                'pluginOptions' => [
                    'size' => 'mini',
                    'onText' => 'Sim',
                    'offText' => 'Não',
                    'onColor' => 'success',
                    'offColor' => 'danger'
                ],
            ])
            ?>
        </div>
    </div>
</div> <!-- card-body -->
<div class="card-footer d-flex justify-content-md-end">
    <?php
    if ($modelTSD->isNewRecord) {
        echo Html::submitButton(
            "<span class='fas fa-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>",
            [
                'id' => 'btn_salvar',
                'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                'data-toggle' => 'tooltip',
                'title' => 'Criar pesquisa',
                'data-confirm' => 'Pesquisa criar',
                'value' => 'ok',
                'name' => 'btn',
            ]
        );
    } else {
        echo Html::submitButton(
            "<span class='fas fa-check' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>",
            [
                'id' => 'btn_salvar',
                'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                'data-toggle' => 'tooltip',
                'title' => 'Editar pesquisa',
                'data-confirm' => 'Pesquisa editar',
                'value' => 'editar',
                'name' => 'btn'
            ]
        );
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        echo '&nbsp;&nbsp;&nbsp;';
        $urlRes = Yii::$app->urlManager->createUrl([
            '/res/responsaveis/index-responsavel',
            'idRes' => $idRes,
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
    $urlPes = Yii::$app->urlManager->createUrl([
        '/dep/dependentes/lista-dependentes-resp',
        'idRes' => $idRes,
    ]);
    echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
        'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
        'onclick' => "window.location.href = '" . $urlPes . "';",
        'data-toggle' => 'tooltip',
        'title' => 'Voltar lista pessoa(s)',
    ]);
    ?>
</div> <!-- card-footer -->
<?php ActiveForm::end(); ?>