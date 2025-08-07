<?php

namespace app\modules\auxiliar\models;

use yii\base\Model;

/**
 * ConsultaForm is the model behind the consulta form.
 * 
 */
class ConsultaForm extends Model {

    public $cpfcid;

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['cpfcid'], 'required'],
            [['cpfcid'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'cpfcid' => 'Cpf:',
        ];
    }

}
