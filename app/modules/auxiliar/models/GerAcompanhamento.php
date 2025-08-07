<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\GerAcompanhamentoQuery;

/**
 * This is the model class for table "{{%ger_acompanhamento}}".
 *
 * @property int $id_num_aco Id tabela acompanhamentos:
 * @property string $nm_nom_aco Acompanhamento:
 */
class GerAcompanhamento extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_acompanhamento}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_aco'], 'required'],
            [['nm_nom_aco'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_aco' => 'Id tabela acompanhamentos:',
            'nm_nom_aco' => 'Acompanhamento:',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GerAcompanhamentoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerAcompanhamentoQuery(get_called_class());
    }
}
