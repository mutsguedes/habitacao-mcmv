<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\dep\models\Dependente;
use app\modules\res\models\Responsavel;
use app\modules\auxiliar\models\GerNacionalidadeQuery;

/**
 * This is the model class for table "{{%ger_nacionalidade}}".
 *
 * @property int $id_num_nac Id da tabela nacionalidades.
 * @property string $nm_nom_pai Nome país:
 * @property string $nm_nom_nac Nacionalidade:
 * @property string|null $outro
 *
 * @property Dependente[] $dependente
 * @property Responsavel[] $responsavels
 */
class GerNacionalidade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_nacionalidade}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_nom_pai', 'nm_nom_nac'], 'required'],
            [['nm_nom_pai'], 'string', 'max' => 25],
            [['nm_nom_nac'], 'string', 'max' => 16],
            [['outro'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_nac' => 'Id da tabela nacionalidades.',
            'nm_nom_pai' => 'Nome país:',
            'nm_nom_nac' => 'Nacionalidade:',
            'outro' => 'Outro',
        ];
    }

    /**
     * Gets query for [[Dependente]].
     *
     * @return \yii\db\ActiveQuery|DependenteQuery
     */
    public function getDependentes()
    {
        return $this->hasMany(Dependente::className(), ['id_num_nac' => 'id_num_nac']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_num_nac' => 'id_num_nac']);
    }

    /**
     * {@inheritdoc}
     * @return GerNacionalidadeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerNacionalidadeQuery(get_called_class());
    }
}
