<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\GerTecsocAtividadeFisQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_atividade_fis}}".
 *
 * @property int $id_ati_fis Id tabela atividadesFis:
 * @property string $nm_ati_fis Nome:
 */
class GerTecsocAtividadeFis extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_atividade_fis}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_ati_fis'], 'required'],
            [['nm_ati_fis'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ati_fis' => 'Id tabela atividadesFis:',
            'nm_ati_fis' => 'Nome:',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocAtividadeFisQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocAtividadeFisQuery(get_called_class());
    }
}
