<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerGeneroQuery;

/**
 * This is the model class for table "{{%ger_genero}}".
 *
 * @property int $id_num_gen Id da tabela GerGenero.
 * @property string $nm_nom_gen Nome do genero.
 * @property string $nm_nom_abr Nome abreviado do genero.
 *
 * @property Dependente[] $dependente
 * @property Responsavel[] $responsavel
 */
class GerGenero extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_genero}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_gen', 'nm_nom_abr'], 'required'],
            [['nm_nom_gen'], 'string', 'max' => 15],
            [['nm_nom_abr'], 'string', 'max' => 3],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_gen' => 'Id da tabela GerGenero.',
            'nm_nom_gen' => 'Nome do genero.',
            'nm_nom_abr' => 'Nome abreviado do genero.',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::className(), ['id_num_gen' => 'id_num_gen']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_num_gen' => 'id_num_gen']);
    }

    /**
     * {@inheritdoc}
     * @return GerGeneroQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerGeneroQuery(get_called_class());
    }
}
