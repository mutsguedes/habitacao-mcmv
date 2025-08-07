<?php

namespace app\modules\end\models;

use app\modules\end\models\EnderecoQuery;

/**
 * This is the model class for table "{{%endereco}}".
 *
 * @property int $id_num_end Id da tabela endereco.:
 * @property string $id_tip_pes T. pessoa:
 * @property string $id_tip_ent T. Entidade:
 * @property string|null $nu_num_cep CEP.:
 * @property string|null $nm_nom_log Logradouro:
 * @property string|null $nu_num_cas Nº.:
 * @property string|null $nm_nom_com Complemento:
 * @property string|null $nm_nom_bai Bairro:
 * @property string|null $nm_nom_mun Município:
 * @property string|null $nm_nom_est UF.:
 * @property string|null $nu_num_tel Telefone:
 * @property string|null $nu_num_tel_1 Telefone:
 * @property string $nm_nom_obs Obs:
 */
class Endereco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%endereco}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tip_pes', 'id_tip_ent', 'nm_nom_obs'], 'required'],
            [['id_tip_pes'], 'string', 'max' => 1],
            [['id_tip_ent'], 'string', 'max' => 15],
            [['nu_num_cep'], 'string', 'max' => 8],
            [['nm_nom_log'], 'string', 'max' => 80],
            [['nu_num_cas'], 'string', 'max' => 5],
            [['nm_nom_com', 'nm_nom_mun'], 'string', 'max' => 50],
            [['nm_nom_bai'], 'string', 'max' => 40],
            [['nm_nom_est'], 'string', 'max' => 2],
            [['nu_num_tel', 'nu_num_tel_1'], 'string', 'max' => 11],
            [['nm_nom_obs'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_end' => 'Id da tabela endereco.:',
            'id_tip_pes' => 'T. pessoa:',
            'id_tip_ent' => 'T. Entidade:',
            'nu_num_cep' => 'CEP.:',
            'nm_nom_log' => 'Logradouro:',
            'nu_num_cas' => 'Nº.:',
            'nm_nom_com' => 'Complemento:',
            'nm_nom_bai' => 'Bairro:',
            'nm_nom_mun' => 'Município:',
            'nm_nom_est' => 'UF.:',
            'nu_num_tel' => 'Telefone:',
            'nu_num_tel_1' => 'Telefone:',
            'nm_nom_obs' => 'Obs:',
        ];
    }

    /**
     * {@inheritdoc}
     * @return EnderecoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new EnderecoQuery(get_called_class());
    }
}
