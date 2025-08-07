<?php

use yii\helpers\Html;

?>

<body style="background-color: #f4f4f4; margin: 0 !important; padding: 0 !important;">
    <!-- HIDDEN PREHEADER TEXT -->
    <div style="display: none; font-size: 1px; color: #fefefe; line-height: 1px; font-family: 'Lato', Helvetica, Arial, sans-serif; 
         max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        Estamos muito felizes em tê-lo aqui! Sempre conte conosco. </div>
    <table border="0" cellpadding="0" cellspacing="0" width="100%">
        <!-- LOGO -->
        <tr>
            <td bgcolor="#FFA73B" align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td align="center" valign="top" style="padding: 40px 10px 40px 10px;"> </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#FFA73B" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="center" valign="top" style="padding: 40px 20px 20px 20px; 
                            border-radius: 4px 4px 0px 0px; color: #111111; font-family: 'Lato', Helvetica, Arial, sans-serif; 
                            font-size: 48px; font-weight: 400; letter-spacing: 4px; line-height: 48px;">
                            <h1 style="font-size: 48px; font-weight: 400; margin: 2px;">Bem Vindo!</h1>
                            <img src="<?= $message->embed($imageFileName); ?>" width="125" height="120" style="display: block; border: 0px;" />
                        </td>
                    </tr>
                </table>
            </td>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="text-align:justify; text-justify: inter-word;
                            padding: 0px 30px 40px 30px; color: #666666; 
                            font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Olá Sr(a) <b><?= Html::encode($res['nm_nom_cid']) ?></b>,
                                a sua conta para acessar a página da SMHSS, foi realizado com sucesso na data de
                                <b><?= Html::encode($res['dataEmail']) ?></b>.<br>
                                Click no botão abaixo para acessar a página da SMHSS.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td bgcolor="#ffffff" align="center" style="padding: 0px 30px 60px 30px;">
                                        <table border="0" cellspacing="0" cellpadding="0">
                                            <tr>
                                                <td align="center" style="border-radius: 3px;" bgcolor="#FFA73B">
                                                    <a href=<?= Yii::$app->params['BASE_URL'] ?> target="_blank" style="font-size: 20px; 
                                                       font-family: Helvetica, Arial, sans-serif; color: #ffffff; 
                                                       text-decoration: none; color: #ffffff; text-decoration: none; 
                                                       padding: 15px 25px; border-radius: 2px; border: 1px solid #FFA73B; 
                                                       display: inline-block;">SMHSS</a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="text-align:justify; text-justify: inter-word;
                            padding: 0px 30px 0px 30px; color: #666666; 
                            font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Se isso não funcionar, copie e cole o seguinte link no seu navegador:</p>
                        </td>
                    </tr> <!-- COPY -->
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="text-align:justify; text-justify: inter-word;
                            padding: 20px 30px 20px 30px; color: #666666; 
                            font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;"><a href=<?= Yii::$app->params['BASE_URL'] ?> target="_blank" style="color: #FFA73B;"><?= Yii::$app->params['BASE_URL'] ?></a></p>
                        </td>
                    </tr>
                    <tr>
                        <td bgcolor="#ffffff" align="left" style="text-align:justify; text-justify: inter-word;
                            padding: 0px 30px 40px 30px; border-radius: 0px 0px 4px 4px; 
                            color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <p style="margin: 0;">Atenciosamente,<br>Equipe SMHSS</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td bgcolor="#f4f4f4" align="center" style="padding: 0px 10px 0px 10px;">
                <table border="0" cellpadding="0" cellspacing="0" width="100%" style="max-width: 600px;">
                    <tr>
                        <td bgcolor="#FFECD1" align="center" style="padding: 30px 30px 30px 30px; border-radius: 4px 4px 4px 4px; 
                            color: #666666; font-family: 'Lato', Helvetica, Arial, sans-serif; font-size: 18px; font-weight: 400; line-height: 25px;">
                            <h2 style="font-size: 20px; font-weight: 400; color: #d9534f; margin: 0;">
                                Esta é uma mensagem automática, por favor, não responda.</h2><br>
                            <span>&copy; SMHSS - Sec. de Habitação e Serviços Sociais <?= date('Y') ?></span>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>