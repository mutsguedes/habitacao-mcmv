<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\auxiliar\models\GerTecsocBeneficioSocQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_beneficio_soc}}".
 *
 * @property int $id_num_ben Id tabela beneficios:
 * @property string $nm_nom_ben Benifícios:
 *
 * @property TecnicoSocial[] $tecnicoSocials
 */
class GerTecsocBeneficioSoc extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_beneficio_soc}}';
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
     * Gets query for [[TecnicoSocials]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_num_ben' => 'id_num_ben']);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocBeneficioSocQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocBeneficioSocQuery(get_called_class());
    }
}
