<?php


use yii\web\View;
use yii\helpers\Url;
use yii\bootstrap5\Html;
use kartik\widgets\Select2;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\Apartamento;

$select2Options = [
    'multiple' => false,
    'placeholder' => '-- Selecione Locação --',
    'theme' => 'krajee',
    'width' => '100%',
];

/* @var $this View */
/* @var $modelO Ocupacoes */
/* @var $form ActiveForm */
?>
<?php
$this->registerJs(
    "$('#ocupacao-modal').modal('show');",
    View::POS_READY
);
?>
<?php
$form = ActiveForm::begin([
    'id' => 'ocupacao-form',
]);
?>
<div class="modal fade" id="ocupacao-modal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button onClick='window.history.back(-1);' type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span><span class="sr-only">Fechar</span>
                </button>
                <h4 class="modal-title">Criar - Ocupações</h4>
            </div> <!-- Modal Header -->
            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?=
                        $form->field($modelO, 'id_num_res')->widget(Select2::class, [
                            'options' => [
                                'prompt' => '-- Sel. responsável --',
                            ],
                            'pluginOptions' => [
                                'class' => 'form-horizontal',
                                'language' => 'pt-BR',
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                            ],
                            'data' => ArrayHelper::map(Responsavel::find()->orderBy('nm_nom_res')
                                ->asArray()->all(), 'id_num_res', 'nm_nom_res'),
                        ])
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-4">
                        <?=
                        $form->field($modelO, 'id_num_apa')->widget(Select2::class, [
                            'options' => [
                                'id' => 'quadra',
                                'placeholder' => '-- Selecione a quadra --',
                            ],
                            'pluginOptions' => [
                                'class' => 'form-horizontal',
                                'language' => 'pt-BR',
                                'allowClear' => true,
                                //   'minimumInputLength' => 3,
                            ],
                            'data' => ArrayHelper::map(Apartamento::find()->orderBy('nu_num_qua')
                                ->asArray()->all(), 'id_num_apa', 'nu_num_qua'),
                            'pluginEvents' => [
                                'select2:select' => 'function(e) { enabledUnidades(); }',
                            ],
                        ])->label('Quadra:');
                        ?>
                        <?php ob_start(); // output buffer the javascript to register later    
                        ?>
                        <script>
                            function enabledUnidades() {
                                var uni = $('#lote');
                                uni.select2('enable');
                            }
                        </script>
                        <?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean()), View::POS_END); ?>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <?=
                        $form->field($modelO, 'id_num_apa')->widget(Select2::class, [
                            'disabled' => true,
                            'hideSearch' => true,
                            'options' => [
                                'id' => 'lote',
                                'placeholder' => '-- Selecione a lote --',
                            ],
                            'pluginOptions' => [
                                'class' => 'form-horizontal',
                                'language' => 'pt-BR',
                                'allowClear' => true,
                                //   'minimumInputLength' => 3,
                            ],
                            'data' => ArrayHelper::map(Apartamento::find()->orderBy('nu_num_lot')
                                ->asArray()->all(), 'id_num_apa', 'nu_num_lot'),
                            'pluginEvents' => [
                                'select2:select' => 'function(e) { populateClientCode(e.params.data.id); }',
                            ],
                        ])->label('Lote:');
                        ?>
                        <?php ob_start(); // output buffer the javascript to register later    
                        ?>
                        <script>
                            function populateClientCode(idUn) {
                                var url = '<?= Url::to(['ocupacoes/populate-client-code', 'nuNumQua' => '-idT-', 'nuNumLot' => '-idU-']) ?>';
                                var qua = $('#quadra').val();
                                var loc = $('#ocupacoes-id_num_apa');
                                loc.find('option').remove().end();
                                var urlT = url.replace('-idT-', qua);
                                var urlTU = urlT.replace('-idU-', idUn);
                                $.ajax({
                                    url: urlTU,
                                    type: 'post',
                                    success: function(data) {
                                        loc.select2('enable');
                                        loc.select2({
                                            data: data.results,
                                            width: '100%',
                                            tags: "true",
                                            allowClear: true,
                                            theme: 'krajee',
                                            placeholder: '-- Selecione Locação --'
                                        });
                                        loc.val(data.selected).trigger('change');
                                    },
                                    error: function(erro) {
                                        alert(erro);
                                    }
                                    //swal("Error CEP", "CEP não encontrado.", "error");
                                });
                            }
                        </script>
                        <?php $this->registerJs(str_replace(['<script>', '</script>'], '', ob_get_clean()), View::POS_END); ?>
                    </div>
                    <div class="col-xs-12 col-md-4">
                        <?=
                        $form->field($modelO, 'id_num_ocu')->widget(Select2::class, [
                            'disabled' => true,
                            'options' => [
                                'prompt' => '-- Selecione Locação --',
                            ],
                            'pluginOptions' => [
                                'class' => 'form-horizontal',
                                'language' => 'pt-BR',
                                'allowClear' => true,
                            ],
                        ])->label('Locações');
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xs-12 col-md-12">
                        <?=
                        $form->field($modelO, 'nm_nom_obs')
                            ->textarea(['maxlength' => true, 'style' => ['text-transform' => 'uppercase']])
                        ?>
                    </div>
                </div>
            </div><!-- Modal body -->
            <div class="modal-footer">
                <?php
                if ($modelO->isNewRecord) {
                    echo Html::submitButton('Salvar', [
                        'id' => 'btn_salvar',
                        'class' => 'btn-success btn-mini',
                        'data-toggle' => 'tooltip',
                        'title' => 'Criar ocupação',
                        'data-confirm' => 'Ocupação criar',
                        'value' => 'criar',
                        'name' => 'btn',
                    ]);
                } else {
                    echo Html::submitButton('Salvar', [
                        'id' => 'btn_salvar',
                        'class' => 'btn-success btn-mini',
                        'data-toggle' => 'tooltip',
                        'title' => 'Editar ocupação',
                        'data-confirm' => 'Ocupação editar',
                        'value' => 'editar',
                        'name' => 'btn'
                    ]);
                }
                echo '&nbsp;&nbsp;&nbsp;';
                echo '&nbsp;&nbsp;&nbsp;';
                $urlIndex = Yii::$app->urlManager->createUrl(['']);
                echo Html::button('Cancelar', [
                    'class' => 'btn-warning btn-mini',
                    'onclick' => "window.location.href = '" . $urlIndex . "';
                        ",
                    'data-toggle' => 'tooltip',
                    'title' => 'Voltar página inicial',
                ])
                ?>
            </div>
            </p>
        </div> <!-- Modal footer -->
    </div> <!-- Modal content -->
</div> <!-- Modal dialog -->
</div> <!-- Modal dialog -->
<?php ActiveForm::end(); ?>
<?php
if (!$modelR->isNewRecord) {
    $script = <<< JS
    $('#responsaveis-nu_ren_res-disp').ready(function() { 
        var tempo;
        var data_tx = $(this).val(); 
            var form_data = { 
                idRes: $modelR->id_num_res , 
            };
    });
JS;
    $this->registerJs($script);
}
?>