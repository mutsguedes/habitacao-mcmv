<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\GerTecsocAtividadeQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%ger_tecsoc_atividade}}".
 *
 * @property int $id_num_ati Id tabela trabRendaAtividades:
 * @property string $nm_nom_ati Atividade:
 */
class GerTecsocAtividade extends ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%ger_tecsoc_atividade}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nm_nom_ati'], 'required'],
            [['nm_nom_ati'], 'string', 'max' => 60],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_num_ati' => 'Id tabela trabRendaAtividades:',
            'nm_nom_ati' => 'Atividade:',
        ];
    }

    /**
     * {@inheritdoc}
     * @return GerTecsocAtividadeQuery the active query used by this AR class.
     */
    public static function find() {
        return new GerTecsocAtividadeQuery(get_called_class());
    }

}
