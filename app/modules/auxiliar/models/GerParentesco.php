<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\auxiliar\models\GerParentescoQuery;

/**
 * This is the model class for table "{{%ger_parentesco}}".
 *
 * @property int $id_num_par Id da tabela GerParentesco.
 * @property string $nm_nom_par Nome do parentesco do funcionário.
 *
 * @property Dependente[] $dependente
 */
class GerParentesco extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_parentesco}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_par'], 'required'],
            [['nm_nom_par'], 'string', 'max' => 20],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_par' => 'Id da tabela GerParentesco.',
            'nm_nom_par' => 'Nome do parentesco do funcionário.',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::class, ['id_num_par' => 'id_num_par']);
    }

    /**
     * {@inheritdoc}
     * @return GerParentescoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerParentescoQuery(get_called_class());
    }
}
