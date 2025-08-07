<?php

namespace app\components\validador;

use app\assets\AppAsset;
use Yii;
use yii\helpers\Json;
use yii\validators\Validator;

class ValidarCpf extends Validator
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        if ($this->message === null) {
            $this->message = Yii::t('yii', "{attribute} não é válido.");
        }
    }

    /**
     * @inheritdoc
     */
    protected function validateValue($value)
    {
        $valid = true;
        $cpf = preg_replace('/[^0-9]/', '', $value);
        for ($x = 0; $x < 10; $x++) {
            if ($cpf == str_repeat($x, 11)) {
                $valid = false;
            }
        }
        if ($valid) {
            if (strlen($cpf) != 11) {
                $valid = false;
            } else {
                for ($t = 9; $t < 11; $t++) {
                    $d = 0;
                    for ($c = 0; $c < $t; $c++) {
                        $d += $cpf[$c] * (($t + 1) - $c);
                    }
                    $d = ((10 * $d) % 11) % 10;
                    if ($cpf[$c] != $d) {
                        $valid = false;
                        break;
                    }
                }
            }
        }
        return ($valid) ? [] : [$this->message, []];
    }

    /**
     * @inheritdoc
     */
    public function clientValidateAttribute($object, $attribute, $view)
    {
        $options = [
            'message' => Yii::$app->getI18n()->format($this->message, [
                'attribute' => $object->getAttributeLabel($attribute),
            ], Yii::$app->language)
        ];
        if ($this->skipOnEmpty) {
            $options['skipOnEmpty'] = 1;
        }
        AppAsset::register($view);
        return 'yiima.validation.cpf(value, messages, ' . Json::encode($options) . ');';
    }
}
