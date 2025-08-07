<?php

namespace app\modules\auxiliar\models;

use Yii;

/**
 * This is the model class for table "ger_action_servico".
 *
 * @property int $id_act_ser Id da tabela id_act_ser:
 * @property string $id_tip_ser Tipo serviço:
 * @property string|null $nm_lab_act N. action:
 * @property string|null $nm_ico_act N. icon:
 * @property string|null $nm_des_act Des. action:
 * @property string|null $nm_url_act Url:
 *
 * @property GerServico[] $gerActions
 */
class GerActionServico extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ger_action_servico';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_tip_ser'], 'required'],
            [['id_tip_ser'], 'string', 'max' => 15],
            [['nm_lab_act'], 'string', 'max' => 40],
            [['nm_ico_act'], 'string', 'max' => 25],
            [['nm_des_act'], 'string', 'max' => 80],
            [['nm_url_act'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_act_ser' => 'Id da tabela id_act_ser:',
            'id_tip_ser' => 'Tipo serviço:',
            'nm_lab_act' => 'N. action:',
            'nm_ico_act' => 'N. icon:',
            'nm_des_act' => 'Des. action:',
            'nm_url_act' => 'Url:',
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function fields()
    {
        return [
            'id_tip_ser',
            'nm_lab_act',
            'nm_ico_act',
            'nm_des_act',
            'nm_url_act',
        ];
    }

    /**
     * Gets query for [[GerActions]].
     *
     * @return \yii\db\ActiveQuery|GerEntidadeQuery
     */
    public function getGerActions()
    {
        return $this->hasMany(GerServico::class, ['id_tip_ser' => 'id_tip_ser']);
    }

    /**
     * {@inheritdoc}
     * @return GerActionServicoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerActionServicoQuery(get_called_class());
    }
}
