<?php

use yii\bootstrap5\Html;
use app\components\MarArtHelpers;
use app\modules\auxiliar\models\GerTabUniCbo;
?>

<?php
if (!empty(Yii::$app->user->identity->bi_arq_ava)) {
    //$avalar = base64_encode(stream_get_contents(Yii::$app->user->identity->bi_arq_ava));
    $avalar = base64_encode(Yii::$app->user->identity->bi_arq_ava);
}
?>

<li class="dropdown-item" style="padding: 0px 0px 0px 0px;">
    <div class="card text-center" style="width: 250px;">
        <div class=" card-header">
            <a class="row d-flex justify-content-center">
                <?php if (!empty($avalar)) { ?>
                    <img class="roundedcirclecabimg" src="data:image/jpeg;base64,
                        <?= $avalar ?> " alt="Imagem do Usuário">
                <?php } else { ?>
                    <img src="/img/defaultAvatar.png" class="roundedcirclecabicon" alt="Imagem do Usuário">
                <?php } ?>
            </a>
            <p style="padding-top: 3px">
                <?php
                echo (strstr(Yii::$app->user->identity->name . ' ', ' ', true) . strrchr(Yii::$app->user->identity->name, ' '));
                ?>
            </p>
        </div> <!-- card-header -->
        <div class="card-body">
            <?php
            $mod = GerTabUniCbo::findOne(['id_num_cbo' => Yii::$app->user->identity->id_num_cbo])->nm_des_cbo;
            ?>
            <p class="text-wrap">
                <strong>
                    <?=
                    MarArtHelpers::titleCase($mod);
                    ?>
                </strong>
            </p>
            <p>
                <small>Membro desde <?php echo date("d-m-Y", Yii::$app->user->identity->created_at) ?></small>
            </p>
        </div> <!-- card-body -->
        <div class=" card-footer">
            <?php
            $url = Yii::$app->urlManager->createUrl([
                '/user/user/change-password',
                'id' => Yii::$app->user->identity->id
            ]);
            $urlp = Yii::$app->urlManager->createUrl([
                '/user/user/perfil',
                'id' => Yii::$app->user->identity->id
            ]);
            echo Html::a('<i class="fas fa-user fa fa-lg"></i>', $urlp, [
                'data-method' => 'post',
                'type' => 'button',
                'class' => 'btn btn-outline-info btn-sm',
                'title' => 'Perfil',
            ])
                . '&nbsp&nbsp&nbsp;' .
                Html::a('<i class="fas fa-edit fa fa-lg"></i>', $url, [
                    'data-method' => 'post',
                    'type' => 'button',
                    'class' => 'btn btn-outline-success btn-sm',
                    'title' => 'Mudar senha',
                ])
                . '&nbsp&nbsp&nbsp;' .
                Html::a('<i class="fas fa-sign-out-alt fa fa-lg"></i>', ['/site/logout'], [
                    'data-method' => 'post',
                    'type' => 'button',
                    'class' => 'btn btn-outline-danger btn-sm',
                    'title' => 'Sair',
                ]);
            ?>
        </div> <!-- card-footer -->
    </div> <!-- card -->
</li>