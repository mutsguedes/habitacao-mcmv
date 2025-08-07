<?php

namespace app\modules\auxiliar\models;

use Yii;

/**
 * This is the model class for table "ger_action_servico".
 *
 * @property int $id_act_ser Id da tabela id_act_ser:
 * @property string $id_tip_ent Tipo serviço:
 * @property string $id_tip_ser Tipo serviço:
 * @property string|null $nm_lab_act N. action:
 * @property string|null $nm_des_ser Des. action:
 * @property string|null $nm_url_act Url:
 *
 * @property GerServico[] $gerServicos
 */
class GerActionServicoS extends \yii\db\ActiveRecord
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
            [['id_tip_ent', 'id_tip_ser'], 'required'],
            [['id_tip_ent', 'id_tip_ser'], 'string', 'max' => 15],
            [['nm_lab_act'], 'string', 'max' => 40],
            [['nm_des_ser'], 'string', 'max' => 80],
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
            'id_tip_ent' => 'Tipo serviço:',
            'id_tip_ser' => 'Tipo serviço:',
            'nm_lab_act' => 'N. action:',
            'nm_des_ser' => 'Des. action:',
            'nm_url_act' => 'Url:',
        ];
    }

    /**
     * Gets query for [[GerServicos]].
     *
     * @return \yii\db\ActiveQuery|GerEntidadeQuery
     */
    public function getGerServicos()
    {
        return $this->hasMany(GerServico::className(), ['id_tip_ser' => 'id_tip_ser']);
    }

    /**
     * {@inheritdoc}
     * @return GerServicoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerServicoQuery(get_called_class());
    }
}
