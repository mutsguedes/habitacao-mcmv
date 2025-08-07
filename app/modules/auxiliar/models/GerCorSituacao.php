<?php

namespace app\modules\auxiliar\models;

use Yii;
use app\modules\auxiliar\models\GerCorSituacaoQuery;
use app\modules\cliente\models\Mcmvws;
use app\modules\res\models\Responsavel;

/**
 * This is the model class for table "{{%ger_cor_situacao}}".
 *
 * @property int $id_cor_sit Id da tabela corSituacoes.
 * @property string $nm_cor_sit Cor:
 * @property string $nm_cor_tra Cor Ingles:
 * @property string $nm_des_sit Desc. Situação
 * @property string $nm_sit_des Descrição:
 *
 * @property Mcmvw[] $mcmvws
 * @property Responsavel[] $responsavels
 */
class GerCorSituacao extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%ger_cor_situacao}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_cor_sit', 'nm_cor_tra', 'nm_des_sit', 'nm_sit_des'], 'required'],
            [['nm_cor_sit', 'nm_cor_tra'], 'string', 'max' => 15],
            [['nm_des_sit'], 'string', 'max' => 100],
            [['nm_sit_des'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_cor_sit' => 'Id da tabela corSituacoes.',
            'nm_cor_sit' => 'Cor:',
            'nm_cor_tra' => 'Cor Ingles:',
            'nm_des_sit' => 'Desc. Situação',
            'nm_sit_des' => 'Descrição:',
        ];
    }

    /**
     * Gets query for [[Mcmvws]].
     *
     * @return \yii\db\ActiveQuery|McmvwQuery
     */
    public function getMcmvws()
    {
        return $this->hasMany(Mcmvws::class, ['id_cor_sit' => 'id_cor_sit']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return \yii\db\ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels()
    {
        return $this->hasMany(Responsavel::class, ['id_cor_sit' => 'id_cor_sit']);
    }

    /**
     * {@inheritdoc}
     * @return GerCorSituacaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerCorSituacaoQuery(get_called_class());
    }
}
