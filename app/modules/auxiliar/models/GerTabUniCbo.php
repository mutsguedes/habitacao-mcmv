<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerTabUniCboQuery;

/**
 * This is the model class for table "{{%ger_tab_uni_cbo}}".
 *
 * @property int $id_num_cbo Id da tabela CBO.
 * @property string $nu_num_cbo Número do CBO.
 * @property string $nm_des_cbo Descrição do CBO.
 *
 * @property Dependente[] $dependente
 * @property Responsavel[] $responsavels
 */
class GerTabUniCbo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_tab_uni_cbo}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nu_num_cbo', 'nm_des_cbo'], 'required'],
            [['nu_num_cbo'], 'string', 'max' => 6],
            [['nm_des_cbo'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_cbo' => 'Id da tabela CBO.',
            'nu_num_cbo' => 'Número do CBO.',
            'nm_des_cbo' => 'Descrição do CBO.',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::className(), ['id_num_cbo' => 'id_num_cbo']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_num_cbo' => 'id_num_cbo']);
    }

    /**
     * {@inheritdoc}
     * @return GerTabUniCboQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerTabUniCboQuery(get_called_class());
    }
}
