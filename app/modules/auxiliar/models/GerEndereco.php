<?php

namespace app\modules\auxiliar\models;

use Yii;

/**
 * This is the model class for table "ger_endereco".
 *
 * @property int $id_num_end Id da tabela endereco.:
 * @property int $id_num_ent Entidade:
 * @property string $id_tip_pes T. pessoa:
 * @property string $id_tip_ent T. Entidade:
 * @property float|null $nu_num_lat Latitude:
 * @property float|null $nu_num_lon Longitude:
 * @property string|null $nu_num_cep CEP.:
 * @property string|null $nm_nom_log Logradouro:
 * @property string|null $nu_num_cas Nº.:
 * @property string|null $nm_nom_com Complemento:
 * @property string|null $nm_nom_bai Bairro:
 * @property string|null $nm_nom_mun Município:
 * @property string|null $nm_nom_est UF.:
 * @property string|null $nu_num_tel Telefone:
 * @property string|null $nu_num_tel_1 Telefone:
 * @property string|null $nm_nom_ema Email:
 * @property string|null $nm_nom_obs Obs:
 *
 * @property GerEntidade[] $gerEntidades
 */
class GerEndereco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ger_endereco';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_num_ent', 'id_tip_pes', 'id_tip_ent',  'nm_nom_ema'], 'required'],
            [['id_num_ent'], 'integer'],
            [['nu_num_lat', 'nu_num_lon'], 'number'],
            [['id_tip_pes'], 'string', 'max' => 1],
            [['id_tip_ent'], 'string', 'max' => 15],
            [['nu_num_cep'], 'string', 'max' => 8],
            [['nm_nom_log'], 'string', 'max' => 80],
            [['nu_num_cas'], 'string', 'max' => 5],
            [['nm_nom_com', 'nm_nom_mun'], 'string', 'max' => 50],
            [['nm_nom_bai'], 'string', 'max' => 40],
            [['nm_nom_est'], 'string', 'max' => 2],
            [['nu_num_tel', 'nu_num_tel_1'], 'string', 'max' => 11],
            [['nm_nom_ema'], 'string', 'max' => 60],
            [['nm_nom_obs'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            "nu_num_lat",
            "nu_num_lon",
            "nu_num_cep",
            "nm_nom_log",
            "nu_num_cas",
            "nm_nom_com",
            "nm_nom_bai",
            "nm_nom_mun",
            "nm_nom_est",
            "nu_num_tel",
            "nu_num_tel_1",
            "nm_nom_ema",
            "nm_nom_obs",
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_end' => 'Id da tabela endereco.:',
            'id_num_ent' => 'Entidade:',
            'id_tip_pes' => 'T. pessoa:',
            'id_tip_ent' => 'T. Entidade:',
            'nu_num_lat' => 'Latitude:',
            'nu_num_lon' => 'Longitude:',
            'nu_num_cep' => 'CEP.:',
            'nm_nom_log' => 'Logradouro:',
            'nu_num_cas' => 'Nº.:',
            'nm_nom_com' => 'Complemento:',
            'nm_nom_bai' => 'Bairro:',
            'nm_nom_mun' => 'Município:',
            'nm_nom_est' => 'UF.:',
            'nu_num_tel' => 'Telefone:',
            'nu_num_tel_1' => 'Telefone:',
            'nm_nom_ema' => 'Email:',
            'nm_nom_obs' => 'Obs:',
        ];
    }

    /**
     * Gets query for [[GerEntidades]].
     *
     * @return \yii\db\ActiveQuery|GerEntidadeQuery
     */
    public function getGerEntidades()
    {
        return $this->hasMany(GerEntidade::class, ['id_tip_ent' => 'id_tip_ent']);
    }

    /**
     * {@inheritdoc}
     * @return GerEnderecoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerEnderecoQuery(get_called_class());
    }
}
