<?php


use kartik\tabs\TabsX;
use yii\base\Exception;
use kartik\helpers\Html;
use kartik\form\ActiveForm;
use app\modules\res\models\Responsavel;

/* @var $this View */
/* @var $form ActiveForm */

/* @var $modelTS TecnicoSocial */

/* @var $modelTSE TecsocEnfermidade */

/* @var $dataProviderF ActiveDataProvider */

/* @var $idRes  */
?>
<?php
$form = ActiveForm::begin([
    'id' => 'tecsoc',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'options' => [
        'validateOnSubmit' => true,
        'class' => 'form'
    ],
]);
$res = Responsavel::findOne($idRes);
?>
<div class="tecnicoSocial-form espacorow">
    <div class="card-header">
        <h4 style="color: red; text-align: left">Família
            <?=
            ' - ' . Html::label(
                $res->nm_nom_res,
                null,
                ['style' => 'color:blue']
            );
            ?></h4>

    </div>
    <div class="card-body">
        <?php
        $items = [
            [
                'label' => '<i class = "fas fa-address-card"></i> Dados',
                'content' => $this->render('_form-pestecsocfam', [
                    'modelTS' => $modelTS,
                    'form' => $form,
                    'idRes' => $idRes,
                ])
            ],
            [
                'label' => '<i class = "fas fa-map-marker-alt"></i> Mapeamento',
                'content' => $this->render('_form-pestecsocmap', [
                    'modelTS' => $modelTS,
                    'form' => $form,
                ])
            ],
            [
                'label' => '<i class = "fas fa-procedures"></i> Enfermidades',
                'content' => $this->render('_form-ts-enf-fam', [
                    'modelTSE' => $modelTSE,
                    'form' => $form,
                    'idRes' => $idRes,
                ])
            ],
            [
                'label' => '<i class = "fas fa-home"></i> Habitação',
                'content' => $this->render('_form-hab', [
                    'modelTS' => $modelTS,
                    'form' => $form,
                ])
            ],
        ];
        try {

            echo TabsX::widget([
                'items' => $items,
                'position' => TabsX::POS_ABOVE,
                'bordered' => true,
                'encodeLabels' => false,
                'pluginEvents' => []
            ]);
        } catch (Exception $e) {
            echo $e->getMessage();
            Yii::$app->session->setFlash($e->getTraceAsString());
        }
        ?>
    </div>
    <div class="card-footer d-flex flex-wrap justify-content-end" style="margin-top: 10px;">
        <p>
            <?php
            if ($modelTS->isNewRecord) {
                echo Html::submitButton(
                    "<span class='fas fa-comment-medical' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>",
                    [
                        'id' => 'btn_salvar',
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'data-toggle' => 'tooltip',
                        'title' => 'Criar pesquisa',
                        'data-confirm' => 'Pesquisa criar',
                        'value' => 'criar',
                        'name' => 'btn',
                    ]
                );
            } else {
                echo Html::submitButton(
                    "<span class='fas fas fa-comment-medical' aria-hidden='true'></span><span>&nbsp;&nbsp;Salvar</span>",
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
            }
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

            echo '&nbsp;&nbsp;&nbsp;';
            echo '&nbsp;&nbsp;&nbsp;';
            $urlIndex = Yii::$app->urlManager->createUrl(['/res/responsaveis/index']);
            echo Html::button("<span class='fas fa-angle-double-left' aria-hidden='true'></span><span>&nbsp;&nbsp;Voltar</span>", [
                'class' => 'btn btn-sm btn-outline-warning mr-sm-2',
                'onclick' => "window.location.href = '" . $urlIndex . "';",
                'data-toggle' => 'tooltip',
                'title' => 'Voltar lista responsáveis',
            ])
            ?>
        </p>
    </div> <!-- card footer -->
</div>
<?php ActiveForm::end(); ?>
<?php
/* Guarda o tab final */
$script = <<< JS
$('a[data-toggle="tab"]').click(function (e) {
    e.preventDefault();
    $(this).tab('show');
});

$('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
    var id = $(e.target).attr("href");
    localStorage.setItem('selectedTab', id)
});

var selectedTab = localStorage.getItem('selectedTab');

if (selectedTab != null) {
    $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
}
JS;
if ($res->bo_tec_soc) {
    $script = <<< JS
        $("#pesFam>a").removeClass('disabled');            
    JS;
}
$this->registerJs($script);
?>