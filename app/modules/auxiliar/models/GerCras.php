<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\auxiliar\models\GerEndereco;
use app\modules\auxiliar\models\GerCrasQuery;

/**
 * This is the model class for table "ger_cras".
 *
 * @property int $id_cra_ita Id da tabela Cras.
 * @property string $id_tip_pes T. pessoa:
 * @property string $id_tip_ent T. Entidade:
 * @property string $nm_nom_cra Nome CRAS:
 * @property string $nm_nom_bai Nome Bairro:
 * @property string $nm_nom_loc Localidade:
 *
 * @property GerEntidade $tipEnt
 */
class GerCras extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ger_cras';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_cra_ita', 'id_tip_ent', 'nm_nom_cra', 'nm_nom_bai', 'nm_nom_loc'], 'required'],
            [['id_cra_ita'], 'integer'],
            [['id_tip_pes'], 'string', 'max' => 1],
            [['id_tip_ent'], 'string', 'max' => 15],
            [['nm_nom_cra'], 'string', 'max' => 30],
            [['nm_nom_bai', 'nm_nom_loc'], 'string', 'max' => 80],
            [['id_cra_ita'], 'unique'],
            [['id_tip_ent'], 'exist', 'skipOnError' => true, 'targetClass' => GerEntidade::class, 'targetAttribute' => ['id_tip_ent' => 'id_tip_ent']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            //'id_cra_ita',
            //'id_tip_pes',
            'id_tip_ent',
            'nm_nom_cra',
            'nm_nom_bai',
            'nm_nom_loc',
            /* 'id_num_end' => function (GerCras $model) {
                return  $model->tipEnt->id_num_end;
            },
            'id_tip_pes' => function (GerCras $model) {
                return  $model->tipEnt->id_tip_pes;
            },
            'id_tip_ent' => function (GerCras $model) {
                return  $model->tipEnt->id_tip_ent;
            },
            'nu_num_cep' => function (GerCras $model) {
                return  $model->tipEnt->nu_num_cep;
            },
            'nm_nom_log' => function (GerCras $model) {
                return  $model->tipEnt->nm_nom_log;
            },
            'nu_num_cas' => function (GerCras $model) {
                return  $model->tipEnt->nu_num_cas;
            },
            'nm_nom_com' => function (GerCras $model) {
                return  $model->tipEnt->nm_nom_com;
            },
            'nm_nom_bai' => function (GerCras $model) {
                return  $model->tipEnt->nm_nom_bai;
            },
            'nm_nom_mun' => function (GerCras $model) {
                return  $model->tipEnt->nm_nom_mun;
            },
            'nm_nom_est' => function (GerCras $model) {
                return  $model->tipEnt->nm_nom_est;
            },
            'nu_num_tel' => function (GerCras $model) {
                return (strlen($model->tipEnt->nu_num_tel) == 11) ?
                MarArtHelpers::mascaraString('(##) #####-####', $model->tipEnt->nu_num_tel) :
                MarArtHelpers::mascaraString('(##) ####-####', $model->tipEnt->nu_num_tel);
            },
            'nu_num_tel_1' => function (GerCras $model) {
                return (strlen($model->tipEnt->nu_num_tel_1) == 11) ?
                    MarArtHelpers::mascaraString('(##) #####-####', $model->tipEnt->nu_num_tel_1) :
                    MarArtHelpers::mascaraString('(##) ####-####', $model->tipEnt->nu_num_tel_1);
            },
            'nm_nom_obs' => function (GerCras $model) {
                return  $model->tipEnt->nm_nom_obs;
            }, */
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cra_ita' => 'Id da tabela Cras.',
            'id_tip_pes' => 'T. pessoa:',
            'id_tip_ent' => 'T. Entidade:',
            'nm_nom_cra' => 'Nome CRAS:',
            'nm_nom_bai' => 'Nome Bairro:',
            'nm_nom_loc' => 'Localidade:',
        ];
    }

    /**
     * Gets query for [[TipEnt]].
     *
     * @return \yii\db\ActiveQuery|GerEntidadeQuery
     */
    public function getTipEnt()
    {
        return $this->hasOne(GerEntidade::class, ['id_tip_ent' => 'id_tip_ent']);
    }

    /**
     * {@inheritdoc}
     * @return GerCrasQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerCrasQuery(get_called_class());
    }
}
