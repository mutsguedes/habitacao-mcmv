<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\auxiliar\models\GerTecsocHabSerEsgotoQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_hab_ser_esgoto}}".
 *
 * @property int $id_ser_esg Id tabela habEsgotos:
 * @property string $nm_ser_esg Serviço:
 *
 * @property TecnicoSocial[] $tecnicoSocials
 */
class GerTecsocHabSerEsgoto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_hab_ser_esgoto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_ser_esg'], 'required'],
            [['nm_ser_esg'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ser_esg' => 'Id tabela habEsgotos:',
            'nm_ser_esg' => 'Serviço:',
        ];
    }

    /**
     * Gets query for [[TecnicoSocials]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_ser_esg' => 'id_ser_esg']);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocHabSerEsgotoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocHabSerEsgotoQuery(get_called_class());
    }
}
