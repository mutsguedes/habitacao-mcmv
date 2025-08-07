<?php

namespace app\modules\auxiliar\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use app\modules\cliente\models\Mcmvws;
use app\modules\res\models\Responsavel;
use app\modules\cliente\models\McmvwsQuery;
use app\modules\res\models\ResponsavelQuery;
use app\modules\auxiliar\models\GerProjetoQuery;

/**
 * This is the model class for table "{{%ger_projeto}}".
 *
 * @property int $id_num_proj Id da tabela projetos:
 * @property string $nm_sig_proj Sigla:
 * @property string $nm_nom_proj Nome:
 *
 * @property Mcmvws[] $mcmvws
 * @property Responsavel[] $responsavels
 */
class GerProjeto extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_projeto}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_sig_proj', 'nm_nom_proj'], 'required'],
            [['nm_sig_proj'], 'string', 'max' => 8],
            [['nm_nom_proj'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_proj' => 'Id da tabela projetos:',
            'nm_sig_proj' => 'Sigla:',
            'nm_nom_proj' => 'Nome:',
        ];
    }

    /**
     * Gets query for [[Mcmvws]].
     *
     * @return ActiveQuery|McmvwsQuery
     */
    public function getMcmvws()
    {
        return $this->hasMany(Mcmvws::className(), ['id_num_proj' => 'id_num_proj']);
    }

    /**
     * Gets query for [[Responsavel]].
     *
     * @return ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::className(), ['id_num_proj' => 'id_num_proj']);
    }

    /**
     * {@inheritdoc}
     * @return GerProjetoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerProjetoQuery(get_called_class());
    }
}
