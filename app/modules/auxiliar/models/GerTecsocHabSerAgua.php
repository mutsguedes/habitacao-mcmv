<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\auxiliar\models\GerTecsocHabSerAguaQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_hab_ser_agua}}".
 *
 * @property int $id_ser_agu Id tabela habAguas:
 * @property string $nm_ser_agu Serviço:
 *
 * @property TecnicoSocial[] $tecnicoSocials
 */
class GerTecsocHabSerAgua extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_hab_ser_agua}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_ser_agu'], 'required'],
            [['nm_ser_agu'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ser_agu' => 'Id tabela habAguas:',
            'nm_ser_agu' => 'Serviço:',
        ];
    }

    /**
     * Gets query for [[TecnicoSocials]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_ser_agu' => 'id_ser_agu']);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocHabSerAguaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocHabSerAguaQuery(get_called_class());
    }
}
