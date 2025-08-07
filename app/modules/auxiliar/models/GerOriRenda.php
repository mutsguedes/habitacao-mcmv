<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerOriRendaQuery;

/**
 * This is the model class for table "{{%ger_ori_renda}}".
 *
 * @property int $id_ori_ren Origem:
 * @property string $nm_ori_ren
 *
 * @property Dependente[] $dependente
 * @property Responsavel[] $responsavels
 */
class GerOriRenda extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_ori_renda}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_ori_ren'], 'required'],
            [['nm_ori_ren'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_ori_ren' => 'Origem:',
            'nm_ori_ren' => 'Nm Ori Ren',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::className(), ['id_ori_ren' => 'id_ori_ren']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_ori_ren' => 'id_ori_ren']);
    }

    /**
     * {@inheritdoc}
     * @return GerOriRendaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerOriRendaQuery(get_called_class());
    }
}
