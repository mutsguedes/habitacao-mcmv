<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;
?>

<?php
$form = ActiveForm::begin([
    'id' => 'login-form-nav',
    'action' => ['/site/login-nav'],
    'method' => "post",
]);
?>
<li class="dropdown-item" style="padding: 0px 0px 0px 0px;">
    <div class="card text-center">
        <div class="card-header" style="padding: 5px 0px 5px 0px; min-width: 20rem">
            <img src="/img/privacy2.png" class="roundedcirclecabimg" alt=" Conectar">
        </div>
        <div class="card-body justify-content-center" style="padding: 0px;">
            <div class="input-group input-group-sm" style="padding: 5px">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="system"><i class="fas fa-keyboard"></i></span>
                </div>
                <select class="form-control mr-sm-2" id="systemlog" name="systemlog" required placeholder="Sistema" aria-label="Sistema" aria-describedby="system">
                    <option value="">-- Sel. sistema --</option>
                    <option value="2">MCMV</option>
                    <option value="3">PPC</option>
                    <option value="5">PHPMI</option>
                </select>
            </div>
            <div class="input-group input-group-sm" style="padding: 5px">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="user"><i class="fas fa-user"></i></span>
                </div>
                <input type="text" class="form-control mr-sm-2" id="userlog" name="userlog" required placeholder="Usuário" aria-label="Usuário" aria-describedby="user">
            </div>
            <div class="input-group input-group-sm" style="padding: 5px">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="secret"><i class="fas fa-user-secret"></i></span>
                </div>
                <input type="password" class="form-control mr-sm-2" id="password" name="password" required placeholder="Senha" aria-label="Senha" aria-describedby="secret">
            </div>
            <div class="text-center" style="padding: 10px 10px 15px 10px">
                <?=
                Html::resetButton(
                    "<span class='fas fa-times' aria-hidden='true'></span><span>&nbsp;&nbsp;Cancelar</span>",
                    [
                        'class' => 'btn btn-sm btn-outline-secondary mr-sm-2',
                        'name' => 'btn',
                        'id' => 'btn_cancelar_nav',
                        'value' => 'cancelar',
                        'title' => 'Cancelar',
                    ]
                )
                ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?= '&nbsp;&nbsp;&nbsp;'; ?>
                <?=
                Html::submitButton(
                    '<span class="fas fa-check" aria-hidden="true"></span><span>&nbsp;&nbsp;Conectar</span>',
                    [
                        'class' => 'btn btn-sm btn-outline-success mr-sm-2',
                        'name' => 'btn',
                        'id' => 'btn_conectar',
                        'value' => 'conectar',
                        'title' => 'Conectar',

                    ]
                )
                ?>
            </div>
        </div>
        <div class="card-footer" style="padding: 5px 0px 0px 0px;">
            <p style="font-size: 10px"> Esqueceu sua senha, você pode <?= Html::a('redefinir-la', ['/user/user/request-password-reset']) ?>.</p>
        </div>
    </div>
</li>
<?php ActiveForm::end(); ?>