<?php

namespace app\modules\auxiliar\models;

use Yii;

/**
 * This is the model class for table "ger_entidade".
 *
 * @property int $id_num_ent Id da tabela ger_entidade:
 * @property string $id_tip_ent T. entidade:
 * @property string $nm_nom_ent Nome:
 *
 * @property GerCras[] $gerCras
 * @property GerEndereco $entEnd
 * @property GerServico[] $entSer
 */
class GerEntidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ger_entidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tip_ent', 'nm_nom_ent'], 'required'],
            [['id_tip_ent'], 'string', 'max' => 15],
            [['nm_nom_ent'], 'string', 'max' => 80],
            [['id_tip_ent'], 'exist', 'skipOnError' => true, 'targetClass' => GerEndereco::class, 'targetAttribute' => ['id_tip_ent' => 'id_tip_ent']],
            [['id_tip_ent'], 'exist', 'skipOnError' => true, 'targetClass' => GerServico::class, 'targetAttribute' => ['id_tip_ent' => 'id_tip_ent']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_ent' => 'Id da tabela ger_entidade:',
            'id_tip_ent' => 'T. entidade:',
            'nm_nom_ent' => 'Nome:',
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
            'nm_nom_ent',
            'arr_ent_end' => function ($model) {
                return  [$model->entEnd];
            },
            'arr_ent_ser' => function ($model) {
                return  $model->entSer;
            },
           /*  'id_tip_pes' => function (GerCras $model) {
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
     * Gets query for [[GerCras]].
     *
     * @return \yii\db\ActiveQuery|GerCrasQuery
     */
    public function getGerCras()
    {
        return $this->hasMany(GerCras::class, ['id_tip_ent' => 'id_tip_ent']);
    }

    /**
     * Gets query for [[EntEnd]].
     *
     * @return \yii\db\ActiveQuery|GerEnderecoQuery
     */
    public function getEntEnd()
    {
        return $this->hasOne(GerEndereco::class, ['id_tip_ent' => 'id_tip_ent']);
    }

    /**
     * Gets query for [[EntSer]].
     *
     * @return \yii\db\ActiveQuery|GerServicoQuery
     */
    public function getEntSer()
    {
        return $this->hasMany(GerServico::class, ['id_tip_ent' => 'id_tip_ent']);
    }

    /**
     * {@inheritdoc}
     * @return GerEntidadeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerEntidadeQuery(get_called_class());
    }
}
