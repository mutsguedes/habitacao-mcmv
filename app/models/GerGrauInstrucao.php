<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "ger_grau_instrucao".
 *
 * @property int $id_gra_ins Id da tabela graInstrucao..
 * @property string $nm_gra_ins Grau instrução:
 *
 * @property Dependente[] $dependentes
 * @property Responsavel[] $responsavels
 */
class GerGrauInstrucao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ger_grau_instrucao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_gra_ins'], 'required'],
            [['nm_gra_ins'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_gra_ins' => 'Id da tabela graInstrucao..',
            'nm_gra_ins' => 'Grau instrução:',
        ];
    }

    /**
     * Gets query for [[Dependentes]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::class, ['id_gra_ins' => 'id_gra_ins']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::class, ['id_gra_ins' => 'id_gra_ins']);
    }

    /**
     * {@inheritdoc}
     * @return GerGrauInstrucaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerGrauInstrucaoQuery(get_called_class());
    }
}
