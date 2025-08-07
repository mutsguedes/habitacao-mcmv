<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerEtniaQuery;

/**
 * This is the model class for table "{{%ger_etnia}}".
 *
 * @property int $id_num_etn Id da tabela GerEtnia:
 * @property string $nm_nom_etn Nome da etinia:
 *
 * @property Dependente[] $dependente
 * @property Responsavel[] $responsavel
 */
class GerEtnia extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_etnia}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_etn'], 'required'],
            [['nm_nom_etn'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_etn' => 'Id da tabela GerEtnia:',
            'nm_nom_etn' => 'Nome da etinia:',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::className(), ['id_num_etn' => 'id_num_etn']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_num_etn' => 'id_num_etn']);
    }

    /**
     * {@inheritdoc}
     * @return GerEtniaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerEtniaQuery(get_called_class());
    }
}
