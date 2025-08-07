<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\components\MarArtHelpers;
use app\modules\auxiliar\models\GerServico;
use app\modules\auxiliar\models\GerEndereco;
use app\modules\auxiliar\models\GerEntidadeQuery;

/**
 * This is the model class for table "ger_entidade".
 *
 * @property int $id_num_ent Id da tabela ger_entidade:
 * @property string $id_tip_ent T. entidade:
 * @property string $nm_nom_ent Nome:
 * @property string $nm_lab_ent N. label:
 * @property string $nm_ent_ent N. icon:
 * @property string $nm_tit_ent N titular:
 * @property string $nm_url_ent Url:
 * @property string $nm_url_ser Url serviço:
 *
 * @property GerEndereco $address
 * @property GerServico $services[]
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
            [['id_tip_ent', 'nm_nom_ent', 'nm_lab_ent', 'nm_ico_ent', 'nm_tit_ent', 'nm_url_ent', 'nm_url_ser'], 'required'],
            [['id_tip_ent'], 'string', 'max' => 15],
            [['nm_nom_ent'], 'string', 'max' => 80],
            [['nm_lab_ent'], 'string', 'max' => 40],
            [['nm_ico_ent'], 'string', 'max' => 25],
            [['nm_tit_ent'], 'string', 'max' => 80],
            [['nm_url_ent'], 'string', 'max' => 60],
            [['nm_url_ser'], 'string', 'max' => 60],
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
            'nm_lab_ent' => 'N. label:',
            'nm_ico_ent' => 'N. icon:',
            'nm_tit_ent' => 'N. titular:',
            'nm_url_ent' => 'Url:',
            'nm_url_ser' => 'Url serviço:',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            /* 'id_num_ent', */
            'id_tip_ent',
            'nm_nom_ent',
            'nm_lab_ent',
            'nm_ico_ent',
            'nm_tit_ent',
            'nm_url_ent',
            'nm_url_ser',
            'arr_ent_end' => function ($model) {
                return  [$model->address];
            },
            'arr_ent_ser' => function ($model) {
                return  $model->services;
            },
        ];
    }

    /**
     * Gets query for [[Address]].
     *
     * @return \yii\db\ActiveQuery|GerEnderecoQuery
     */
    public function getAddress()
    {
        return $this->hasOne(GerEndereco::class, ['id_tip_ent' => 'id_tip_ent']);
    }

    /**
     * Gets query for [[Services]].
     *
     * @return \yii\db\ActiveQuery|GerServicoQuery
     */
    public function getServices()
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
