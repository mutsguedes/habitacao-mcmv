<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\GerTabUniCidQuery;

/**
 * This is the model class for table "{{%ger_tab_uni_cid}}".
 *
 * @property int $id_num_cid Id da Tabela CID.
 * @property string $nu_num_cid Número do CID.
 * @property string $nm_des_cid Descrição do CID.
 */
class GerTabUniCid extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tab_uni_cid}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_num_cid', 'nu_num_cid', 'nm_des_cid'], 'required'],
            [['id_num_cid'], 'default', 'value' => null],
            [['id_num_cid'], 'integer'],
            [['nu_num_cid'], 'string', 'max' => 4],
            [['nm_des_cid'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_cid' => 'Id da Tabela CID.',
            'nu_num_cid' => 'Número do CID.',
            'nm_des_cid' => 'Descrição do CID.',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GerTabUniCidQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTabUniCidQuery(get_called_class());
    }
}
