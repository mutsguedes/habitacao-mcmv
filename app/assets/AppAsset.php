<?php

/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{

    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $baseUrlaApi = '@web';
    /* public $scss = [
        'css/sweetalert2/bootstrap-4.scss',
    ]; */
    public $css = [
        //'css/materialize/materialize.min.css',
        'css/fullcalendar/main.css',
        'css/marartcalendar.css',
        'css/fontawesome/all.min.css',
        'css/sweetalert2/sweetalert2.min.css',
        'css/sweetalert2/bootstrap-4.css',
        'css/pageerro.css',
        'css/main.css',
        'css/site-perfil-contact.css'
        //'css/modal-avatar.css',
    ];
    public $js = [
        'js/bootstrap-datepicker.js',
        //'js/materialize/materialize.min.js',
        // 'js/imask/imask.js',
        'js/mask/jquery.mask.js',
        'js/fullcalendar/main.js',
        'js/fullcalendar/locales-all.js',
        //'js/fullcalendar/theme-chooser.js',
        //'js/fullcalendar/daygrid/main.min.js',
        //'js/fullcalendar/interaction/main.min.js',
        'js/jquery/jquery.email-autocomplete.js',
        'js/yiima.validation.js',
        'js/fontawesome/all.min.js',
        //'js/sweetalert2/sweetalert2.all.min.js',
        'js/sweetalert2/sweetalert2.js',
        //'js/bootstrap-dialog.min.js',
        //'js/confirmMarArt.js',
        'js/button-click.js',
        'js/mararttimeout.js',
        (YII_ENV_DEV) ?
            'js/main.js' :
            'js/main-pro.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset',
        'yii\bootstrap5\BootstrapPluginAsset'
    ];
}
