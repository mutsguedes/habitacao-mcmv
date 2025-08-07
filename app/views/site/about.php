<?php
/* @var $this View */

use yii\helpers\Html;

?>
<div class="card text-center">
    <div class="card-header">
        <h1 class="card-title">Prefeitura de Itaboraí</h1>
        <h2 class="card-subtitle mb-2 text-muted">Secretaria de Municipal de Habitação e Serviços Sociais</h2>
    </div> <!-- card-header -->
    <div class="card-body">
        <?php echo Html::img('@web/img/habitacaoLogo.png', ['class' => 'img-responsive', 'width' => '500px', 'height' => '500px']); ?>
    </div> <!-- card-body -->
    <div class="card-footer">
        <p class="card-text" style="font-size:16px">
            Rua Antônio José de Marins, 256 - Centro, Itaboraí - RJ, 24800-105
            Telefone - (21)2635-4276
        </p>
    </div> <!-- card-footer -->
</div>