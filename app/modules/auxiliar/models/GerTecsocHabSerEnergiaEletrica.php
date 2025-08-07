<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\auxiliar\models\GerTecsocHabSerEnergiaEletricaQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_hab_ser_energia_eletrica}}".
 *
 * @property int $id_ser_ele Id tabela habEnergiaEletricas:
 * @property string $nm_ser_ele Serviço:
 *
 * @property TecnicoSocial[] $tecnicoSocials
 */
class GerTecsocHabSerEnergiaEletrica extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_hab_ser_energia_eletrica}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_ser_ele'], 'required'],
            [['nm_ser_ele'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ser_ele' => 'Id tabela habEnergiaEletricas:',
            'nm_ser_ele' => 'Serviço:',
        ];
    }

    /**
     * Gets query for [[TecnicoSocials]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_ser_ele' => 'id_ser_ele']);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocHabSerEnergiaEletricaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocHabSerEnergiaEletricaQuery(get_called_class());
    }
}
