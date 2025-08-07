<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\Carousel;
use yii\bootstrap5\ActiveForm;




/* @var $this View */

$this->title = 'MarArt - Habitação Pública - Início';
?>
<div class="form">
    <?php
    echo Carousel::widget([
        'items' => [
            [
                // required, slide content (HTML), such as an image tag
                'content' => '<img class = "img-fluid img-thumbnail" src="/img/novaInscricao.jpeg"/>',
                // optional, the caption (HTML) of the slide
                'caption' => '<h4>Novas Inscrições</h4><p>Secretaria realiza novas inscrições.</p>',
                // optional the HTML attributes of the slide container
                'options' => [
                    'interval' => '600',
                    'class' => 'bg-warning',
                    'style' => 'padding-top: 35px'
                ]
            ],
            [
                // required, slide content (HTML), such as an image tag
                'content' => '<img class = "img-fluid img-thumbnail" src="/img/novaSede.jpg"/>',
                // optional, the caption (HTML) of the slide
                'caption' => '<h4>Nova Sede</h4><p>A SMHSS está de sede nova.</p>',
                // optional the HTML attributes of the slide container
                'options' => [
                    'interval' => '600',
                    'class' => 'bg-warning',
                    'style' => 'padding-top: 35px'
                ]
            ],
            //        [
            //            // required, slide content (HTML), such as an image tag
            //            'content' => '<img class = "img-fluid img-thumbnail" src="/img/ultimoSorteio.jpg"/>',
            //            // optional, the caption (HTML) of the slide
            //            'caption' => '<h4>Último Sorteio</h4><p>Último sorteio realizado pela PMI</p>',
            //            // optional the HTML attributes of the slide container
            //            'options' => [
            //                'interval' => '600',
            //                'class' => 'bg-warning',
            //                'style' => 'padding-top: 35px'
            //            ]
            //        ],
            [
                // required, slide content (HTML), such as an image tag
                'content' => '<img class = "img-fluid img-thumbnail" src="/img/legaFundiaria.png"/>',
                // optional, the caption (HTML) of the slide
                'caption' => '<h4>Legalização Fundiária</h4><p>Projeto de legalizaçao fundiária em Engenho Velho</p>',
                // optional the HTML attributes of the slide container
                'options' => [
                    'interval' => '600',
                    'class' => 'bg-warning',
                    'style' => 'padding-top: 35px'
                ]
            ],
        ],
    ]);
    ?>
    <?php
    $form = ActiveForm::begin([
        'id' => 'choice-form',
        'action' => ['site/get-system'],
        'method' => "get",
    ]);
    ?>
    <div class="d-flex justify-content-around">
        <div class="p-3">
            <?php
            $urle = Yii::$app->urlManager->createUrl(['/cli/clientes/consulta']);
            echo Html::a(
                "<span class='fas fa-search fa-2x'></span><p>Consultar</p>",
                $urle,
                [
                    'class' => "btn btn-primary btn-circle btn-xl",
                    'name' => "btn",
                    'value' => "btn_consultar",
                    'type' => "submit",
                    'data-toggle' => 'tooltip',
                    'id' => "btn_consulta",
                    'title' => 'Consultar cidadão.',
                ]
            )
            ?>
        </div>
        <div class="p-3">
            <?php
            $urle = Yii::$app->urlManager->createUrl(['/site/index']);
            echo Html::a(
                "<span class='fas fa-search-location fa-2x'></span><p>CRAS</p>",
                '',
                [
                    'class' => "btn btn-info btn-circle btn-xl text-white",
                    'name' => "btn",
                    'value' => "btn_consultar_cras",
                    'data-toggle' => 'tooltip',
                    'data-dismiss' => 'modal',
                    'id' => "snwNavLinkCras",
                    'onclick' => "snwNavLinkCras(event);",
                    'title' => 'Consultar CRAS.',
                ]
            )
            ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>