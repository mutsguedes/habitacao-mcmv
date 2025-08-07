<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\GerTesocBeneficioSocQuery;
use yii\db\ActiveRecord;


/**
 * This is the model class for table "{{%ger_tesoc_beneficio_soc}}".
 *
 * @property int $id_num_ben Id tabela beneficios:
 * @property string $nm_nom_ben Benifícios:
 */
class GerTesocBeneficioSoc extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tesoc_beneficio_soc}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_ben'], 'required'],
            [['nm_nom_ben'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_ben' => 'Id tabela beneficios:',
            'nm_nom_ben' => 'Benifícios:',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GerTesocBeneficioSocQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTesocBeneficioSocQuery(get_called_class());
    }
}
