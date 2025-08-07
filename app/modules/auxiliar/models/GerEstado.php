<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\auxiliar\models\GerEstadoQuery;

/**
 * This is the model class for table "{{%ger_estado}}".
 *
 * @property int $id_num_est Id da Tabela estados.
 * @property string $nu_cod_ibge Cód. IBGE:
 * @property string $nm_nom_sig UF:
 * @property string $nm_nom_est Nome:
 * @property int $id_num_nat Id da Naturalidade:
 * @property string $nm_nom_nat Naturalidade:
 *
 * @property Dependente[] $dependente
 * @property Dependente[] $dependentes0
 * @property Dependente[] $dependentes1
 * @property Responsavel[] $responsavels
 * @property Responsavel[] $responsavels0
 * @property Responsavel[] $responsavels1
 * @property Responsavel[] $responsavels2
 * @property TecnicoSocial[] $tecnicoSocials
 * @property TecnicoSocial[] $tecnicoSocials0
 * @property TecnicoSocial[] $tecnicoSocials1
 * @property TecnicoSocial[] $tecnicoSocials2
 * @property TecnicoSocial[] $tecnicoSocials3
 */
class GerEstado extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_estado}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nu_cod_ibge', 'nm_nom_sig', 'nm_nom_est', 'id_num_nat', 'nm_nom_nat'], 'required'],
            [['id_num_nat'], 'default', 'value' => null],
            [['id_num_nat'], 'integer'],
            [['nu_cod_ibge'], 'string', 'max' => 4],
            [['nm_nom_sig'], 'string', 'max' => 2],
            [['nm_nom_est'], 'string', 'max' => 30],
            [['nm_nom_nat'], 'string', 'max' => 40],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_est' => 'Id da Tabela estados.',
            'nu_cod_ibge' => 'Cód. IBGE:',
            'nm_nom_sig' => 'UF:',
            'nm_nom_est' => 'Nome:',
            'id_num_nat' => 'Id da Naturalidade:',
            'nm_nom_nat' => 'Naturalidade:',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::className(), ['id_num_nat' => 'id_num_est']);
    }

    /**
     * Gets query for [[Dependentes0]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes0()
    {
        return $this->hasMany(Dependente::className(), ['id_nat_pai' => 'id_num_est']);
    }

    /**
     * Gets query for [[Dependentes1]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes1()
    {
        return $this->hasMany(Dependente::className(), ['id_nat_mae' => 'id_num_est']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_num_nat' => 'id_num_est']);
    }

    /**
     * Gets query for [[Responsavels0]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels0()
    {
        return $this->hasMany(Responsavel::className(), ['id_nat_pai' => 'id_num_est']);
    }

    /**
     * Gets query for [[Responsavels1]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels1()
    {
        return $this->hasMany(Responsavel::className(), ['id_nat_mae' => 'id_num_est']);
    }

    /**
     * Gets query for [[Responsavels2]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels2()
    {
        return $this->hasMany(Responsavel::className(), ['id_ant_est' => 'id_num_est']);
    }

    /**
     * Gets query for [[TecnicoSocials]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_nat_mae_res' => 'id_num_est']);
    }

    /**
     * Gets query for [[TecnicoSocials0]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials0()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_nat_pai_dep' => 'id_num_est']);
    }

    /**
     * Gets query for [[TecnicoSocials1]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials1()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_nat_pai_dep' => 'id_num_est']);
    }

    /**
     * Gets query for [[TecnicoSocials2]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials2()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_nat_mae_dep' => 'id_num_est']);
    }

    /**
     * Gets query for [[TecnicoSocials3]].
     *
     * @return \yii\db\ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials3()
    {
        return $this->hasMany(TecnicoSocial::className(), ['id_ant_est' => 'id_num_est']);
    }

    /**
     * {@inheritdoc}
     * @return GerEstadoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerEstadoQuery(get_called_class());
    }
}
