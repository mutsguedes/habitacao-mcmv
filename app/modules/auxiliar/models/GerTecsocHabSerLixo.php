<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\auxiliar\models\GerTecsocHabSerLixoQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_hab_ser_lixo}}".
 *
 * @property int $id_ser_lix Id tabela habLixos:
 * @property string $nm_ser_lix Serviço:
 *
 * @property TecnicoSocial[] $tecnicoSocials
 */
class GerTecsocHabSerLixo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_hab_ser_lixo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_ser_lix'], 'required'],
            [['nm_ser_lix'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ser_lix' => 'Id tabela habLixos:',
            'nm_ser_lix' => 'Serviço:',
        ];
    }

    /**
     * Gets query for [[TecnicoSocials]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_ser_lix' => 'id_ser_lix']);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocHabSerLixoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocHabSerLixoQuery(get_called_class());
    }
}
