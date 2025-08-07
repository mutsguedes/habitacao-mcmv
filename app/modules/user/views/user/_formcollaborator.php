<?php

use Yii;
use yii\web\View;
use yii\helpers\ArrayHelper;
use yii\bootstrap5\ActiveForm;
use app\components\MarArtHelpers;
use app\modules\auxiliar\models\GerTabUniCbo;

/* @var $this View */
/* @var $form ActiveForm */
/* @var $modelU User */
?>
<?php
$this->registerJs("$('#request-modal').modal('show');", View::POS_READY);
?>
<div class="position-absolute top-50 start-50 translate-middle">
    <div class="spinner-border text-info" style="width: 10rem; height: 10rem;" role="status">
        <span class="visually-hidden">Loading...</span>
    </div>
    <div style="margin-top: 30px;">
        <strong class="text-info" style="font-size: xx-large;">Loading...</strong>
    </div>
</div>

</div>
<div class="modal fade" id="request-modal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header" style="margin-bottom: 10px">
                <div class="container">
                    <div class=" row d-flex justify-content-end">
                        <button onClick='window.history.back(-1);' type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div> <!-- row -->
                    <div class="row d-flex justify-content-center">
                        <div class="roundedcirclecabicon">
                            <span class="fas fa-user-circle fa-4x">
                        </div>
                    </div><!-- row -->
                    <div class="row d-flex justify-content-center" style="padding-top: 5px">
                        <div class="col-auto">
                            <h3>
                                Nossa Equipe de <span> Colaboradores</span>
                            </h3>
                        </div> <!-- col -->
                    </div> <!-- row -->
                </div> <!-- container -->
            </div> <!-- modal-header -->
            <div class="container">
                <div class="row">
                    <!-- Single Advisor-->
                    <?php
                    foreach ($modelU as $row) {
                        $mod = GerTabUniCbo::findOne(['id_num_cbo' => $row['id_num_cbo']])->nm_des_cbo;
                        if (!empty($row['bi_arq_ava'])) {
                            //$avalar = base64_encode(stream_get_contents(Yii::$app->user->identity->bi_arq_ava));
                            $avalar = base64_encode($row['bi_arq_ava']);
                        } else {
                            $avalar = "";
                        } ?>
                        <div class="col-12 col-lg-4 col-lg-4">
                            <div class="single_advisor_profile wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                                <!-- Team Thumb-->
                                <div class="advisor_thumb">
                                    <?php
                                    if (!empty($avalar)) { ?>
                                        <img class="roundedcircleperimgperfil" src="data:image/jpeg;base64, <?= $avalar ?> " alt="" width="120" height="120">
                                    <?php } else { ?>
                                        <img class="roundedcircleperimgperfil" src="/img/defaultAvatar.png" alt="" width="120" height="120">
                                    <?php } ?>
                                    <!-- Social Info-->
                                    <div class="social-info">
                                        <a href="#" title="<?= $row['email'] ?>">
                                            <i class="fa-solid fa-at"></i>
                                        </a>
                                        <a href="#" title="<?= MarArtHelpers::mascaraString(MarArtHelpers::mascTel($row['nu_num_tel']), $row['nu_num_tel']) ?>">
                                            <i class="fa-solid fa-square-phone"></i>
                                        </a>
                                        <a href="#" title="<?= MarArtHelpers::titleCase($mod) ?>">
                                            <i class=" fa-solid fa-user-tie"></i>
                                        </a>
                                        <!-- <a href="#">
                                            <i class="fab fa-facebook"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                        <a href="#">
                                            <i class="fab fa-linkedin"></i>
                                        </a> -->
                                    </div>
                                </div>
                                <!-- Team Details-->
                                <div class="single_advisor_details_info">
                                    <h6><?= $row['name'] ?></h6>
                                    <p class="designation"><?= MarArtHelpers::mascaraString(MarArtHelpers::masMat($row['nu_num_mat']), $row['nu_num_mat']) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <!-- Single Advisor-->
                </div>
            </div>
        </div>
    </div> <!-- Modal content -->
</div> <!-- modal-dialog -->
</div> <!-- modal -->