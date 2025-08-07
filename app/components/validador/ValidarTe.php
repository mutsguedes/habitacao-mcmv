<?php

namespace app\components\validador;

use app\assets\AppAsset;
use Yii;
use yii\helpers\Json;
use yii\validators\Validator;

class ValidarTe extends Validator {

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
        $te = sprintf('%012s', preg_replace('{\D}', '', $value));
        $uf = intval(substr($te, 8, 2));
        if ((strlen($te) != 12) || ($uf < 1) || ($uf > 28)) {
            $valid = false;
        }
        foreach (array(7, 8 => 10) as $s => $t) {
            for ($d = 0, $p = 2, $c = $t; $c >= $s; $c--, $p++) {
                $d += $te[$c] * $p;
            }
            if ($te[($s) ? 11 : 10] != ((($d %= 11) < 2) ? (($uf < 3) ? 1 - $d : 0) : 11 - $d)) {
                $valid = false;
            }
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
        return 'yiima.validation.te(value, messages, ' . Json::encode($options) . ');';
    }

}
