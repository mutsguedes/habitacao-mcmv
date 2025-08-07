<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\auxiliar\models\GerTipoRendaQuery;

/**
 * This is the model class for table "{{%ger_tipo_renda}}".
 *
 * @property int $id_tip_ren Id tabela tipoRendas:
 * @property string $nm_tip_ren Tipo:
 *
 * @property Dependente[] $dependente
 * @property Responsavel[] $responsavels
 * @property TecnicoSocial[] $tecnicoSocials
 * @property TecnicoSocial[] $tecnicoSocials0
 */
class GerTipoRenda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tipo_renda}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_tip_ren'], 'required'],
            [['nm_tip_ren'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_tip_ren' => 'Id tabela tipoRendas:',
            'nm_tip_ren' => 'Tipo:',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::className(), ['id_tip_ren' => 'id_tip_ren']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_tip_ren' => 'id_tip_ren']);
    }

    /**
     * Gets query for [[TecnicoSocials]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_tip_ren_res' => 'id_tip_ren']);
    }

    /**
     * Gets query for [[TecnicoSocials0]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials0()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_tip_ren_dep' => 'id_tip_ren']);
    }

    /**
     * {@inheritdoc}
     * @return GerTipoRendaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTipoRendaQuery(get_called_class());
    }
}
