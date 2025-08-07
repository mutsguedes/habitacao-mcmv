<?php

namespace app\components\validador;

use app\assets\AppAsset;
use Yii;
use yii\helpers\Json;
use yii\validators\Validator;

class ValidarCnpj extends Validator {

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
        $cnpj = preg_replace('/[^0-9]/', '', (string) $value);
        // Valida tamanho
        if (strlen($cnpj) != 14)
            $valid = false;
        if ($valid) {
            // Valida primeiro dígito verificador
            for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
                $soma += $cnpj[$i] * $j;
                $j = ($j == 2) ? 9 : $j - 1;
            }
            $resto = $soma % 11;
            if ($cnpj[12] != ($resto < 2 ? $valid = false : 11 - $resto))
            //$valid = false;
            // Valida segundo dígito verificado$valid = false;r
                for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
                    $soma += $cnpj[$i] * $j;
                    $j = ($j == 2) ? 9 : $j - 1;
                }
            $resto = $soma % 11;
            $resto < 2 ? $valid = false : $valid = true;
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
        return 'yiima.validation.cpf(value, messages, ' . Json::encode($options) . ');';
    }

}
