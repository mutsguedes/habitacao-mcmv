<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerEstadoCivilQuery;

/**
 * This is the model class for table "{{%ger_estado_civil}}".
 *
 * @property int $id_est_civ Id da tabela GerEstado Civil.
 * @property string $nm_est_civ Nome do estado civil.
 *
 * @property Dependente[] $dependente
 * @property Responsavel[] $responsavel
 */
class GerEstadoCivil extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_estado_civil}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_est_civ'], 'required'],
            [['nm_est_civ'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_est_civ' => 'Id da tabela GerEstado Civil.',
            'nm_est_civ' => 'Nome do estado civil.',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::className(), ['id_est_civ' => 'id_est_civ']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_est_civ' => 'id_est_civ']);
    }

    /**
     * {@inheritdoc}
     * @return GerEstadoCivilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerEstadoCivilQuery(get_called_class());
    }
}
