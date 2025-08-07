<?php

namespace app\components\validador;

use yii\web\AssetBundle;

/**
 * This asset bundle provides the javascript files for moment.js.
 *
 * @author Anushan Easwaramoorthy <EAnushan@hotmail.com>
 *
 * @since 2.0
 */
class MomentAsset extends AssetBundle {

    public $sourcePath = '@bower/moment';
    public $js = [
        '/app/web/js/moment.js',
    ];

}
