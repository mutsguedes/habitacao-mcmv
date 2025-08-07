<?php

namespace app\components\validador;

use app\assets\AppAsset;
use Yii;
use yii\helpers\Json;
use yii\validators\Validator;

class ValidarNis extends Validator {

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', "{attribute} não é válido.");
        }
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value) {
        $valid = true;
        $nis = sprintf('%011s', preg_replace('{\D}', '', $value));
        if ((strlen($nis) != 11) || (intval($nis) == 0)) {
            $valid = false;
        }
        if ($valid) {
            for ($d = 0, $p = 2, $c = 9; $c >= 0; $c--, ($p < 9) ? $p++ : $p = 2) {
                $d += $nis[$c] * $p;
            }
            $valid = $nis[10] == (((10 * $d) % 11) % 10);
        }
        return ($valid) ? [] : [$this->message, []];
    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($object, $attribute, $view) {
        $options = [
            'message' => Yii::$app->getI18n()->format($this->message, [
                'attribute' => $object->getAttributeLabel($attribute),
                    ], Yii::$app->language)
        ];
        if ($this->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }
        AppAsset::register($view);
        return 'yiima.validation.nis(value, messages, ' . Json::encode($options) . ');';
    }

}
