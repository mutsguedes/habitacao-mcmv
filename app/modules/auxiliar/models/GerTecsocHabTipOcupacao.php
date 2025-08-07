<?php

namespace app\modules\auxiliar\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\tecsoc\models\TecnicoSocialQuery;
use app\modules\auxiliar\models\GerTecsocHabTipOcupacaoQuery;

/**
 * This is the model class for table "{{%ger_tecsoc_hab_tip_ocupacao}}".
 *
 * @property int $id_tip_ocu Id da tabela habTipOcupacao
 * @property string $nm_tip_ocu Tipo Ocupação:
 *
 * @property TecnicoSocial[] $tecnicoSocials
 */
class GerTecsocHabTipOcupacao extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tecsoc_hab_tip_ocupacao}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_tip_ocu'], 'required'],
            [['nm_tip_ocu'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tip_ocu' => 'Id da tabela habTipOcupacao',
            'nm_tip_ocu' => 'Tipo Ocupação:',
        ];
    }

    /**
     * Gets query for [[TecnicoSocials]].
     *
     * @return ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_tip_ocu' => 'id_tip_ocu']);
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocHabTipOcupacaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTecsocHabTipOcupacaoQuery(get_called_class());
    }
}
