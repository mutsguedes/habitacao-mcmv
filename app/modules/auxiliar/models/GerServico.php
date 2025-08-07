<?php

namespace app\modules\auxiliar\models;

use Yii;

/**
 * This is the model class for table "ger_servico".
 *
 * @property int $id_ent_ser Id da tabela ger_servico:
 * @property string $id_tip_ent Entidate:
 * @property string $id_tip_ser Tipo serviço:
 * @property string $nm_lab_ser N. label:
 * @property string $nm_ent_ser N. icon:
 * @property string $nm_des_ser Des. serviço:
 * @property string $nm_url_ser Url:
 *
 * @property GerEntidade $entity
 * @property GerActionServico[] $actions
 */
class GerServico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ger_servico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tip_ent', 'id_tip_ser', 'nm_lab_ser', 'nm_ico_ser', 'nm_des_ser', 'nm_url_ser'], 'required'],
            [['id_tip_ent', 'id_tip_ser'], 'string', 'max' => 15],
            [['nm_lab_ser'], 'string', 'max' => 40],
            [['nm_ico_ser'], 'string', 'max' => 25],
            [['nm_des_ser'], 'string', 'max' => 80],
            [['nm_url_ser'], 'string', 'max' => 60],
            [['id_tip_ser'], 'exist', 'skipOnError' => true, 'targetClass' => GerActionServico::class, 'targetAttribute' => ['id_tip_ser' => 'id_tip_ser']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ent_ser' => 'Id da tabela ger_servico:',
            'id_tip_ent' => 'Entidate:',
            'id_tip_ser' => 'Tipo serviço:',
            'nm_lab_ser' => 'N. label:',
            'nm_ico_ser' => 'N. icon:',
            'nm_des_ser' => 'Des. serviço:',
            'nm_url_ser' => 'Url:',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id_tip_ent',
            'id_tip_ser',
            'nm_lab_ser',
            'nm_ico_ser',
            'nm_url_ser',
            'arr_ser_act' => function ($model) {
                return  $model->actions;
            },

        ];
    }

    /**
     * Gets query for [[Entyti]].
     *
     * @return \yii\db\ActiveQuery|GerEntidadeQuery
     */
    public function getEntity()
    {
        return $this->hasOne(GerEntidade::class, ['id_tip_ent' => 'id_tip_ent']);
    }

    /**
     * Gets query for [[Actions]].
     *
     * @return \yii\db\ActiveQuery|GerActionServicoQuery
     */
    public function getActions()
    {
        return $this->hasMany(GerActionServico::class, ['id_tip_ser' => 'id_tip_ser']);
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
