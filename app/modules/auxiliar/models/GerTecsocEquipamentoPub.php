<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\GerTecsocEquipamentoPubQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_equipamento_pub}}".
 *
 * @property int $id_num_equ Id tabela equipamentosPub
 * @property string $nm_nom_equ Nome:
 */
class GerTecsocEquipamentoPub extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_equipamento_pub}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_equ'], 'required'],
            [['nm_nom_equ'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_equ' => 'Id tabela equipamentosPub',
            'nm_nom_equ' => 'Nome:',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocEquipamentoPubQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocEquipamentoPubQuery(get_called_class());
    }
}
