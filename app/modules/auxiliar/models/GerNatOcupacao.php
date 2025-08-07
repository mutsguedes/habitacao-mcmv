<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerNatOcupacaoQuery;

/**
 * This is the model class for table "{{%ger_nat_ocupacao}}".
 *
 * @property int $id_nat_ocu Id da tabela natOcupacoes:
 * @property string $nm_nat_ocu Nome:
 *
 * @property Dependente[] $dependente
 * @property Responsavel[] $responsavels
 */
class GerNatOcupacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_nat_ocupacao}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nat_ocu'], 'required'],
            [['nm_nat_ocu'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_nat_ocu' => 'Id da tabela natOcupacoes:',
            'nm_nat_ocu' => 'Nome:',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::className(), ['id_nat_ocu' => 'id_nat_ocu']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_nat_ocu' => 'id_nat_ocu']);
    }

    /**
     * {@inheritdoc}
     * @return GerNatOcupacaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerNatOcupacaoQuery(get_called_class());
    }
}
