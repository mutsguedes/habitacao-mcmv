<?php

namespace app\modules\api\models;

use Yii;
use app\modules\api\models\Agenda;
use app\modules\api\models\GerStateQuery;
use app\modules\api\models\AgendaDateDisable;

/**
 * This is the model class for table "ger_state".
 *
 * @property int $id_num_sta Id tabela ger_stete:
 * @property string $nm_des_sta Descrição:
 *
 * @property Agenda[] $agendas
 * @property AgendaDateDisable[] $agendaDateDisables
 */
class GerState extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ger_state';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nm_des_sta'], 'required'],
            [['nm_des_sta'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_num_sta' => 'Id tabela ger_stete:',
            'nm_des_sta' => 'Descrição:',
        ];
    }

    /**
     * Gets query for [[Agendas]].
     *
     * @return \yii\db\ActiveQuery|AgendaQuery
     */
    public function getAgendas()
    {
        return $this->hasMany(Agenda::class, ['id_num_sta' => 'id_num_sta']);
    }

    /**
     * Gets query for [[AgendaDateDisables]].
     *
     * @return \yii\db\ActiveQuery|AgendaDateDisableQuery
     */
    public function getAgendaDateDisables()
    {
        return $this->hasMany(AgendaDateDisable::class, ['id_num_sta' => 'id_num_sta']);
    }

    /**
     * {@inheritdoc}
     * @return GerStateQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new GerStateQuery(get_called_class());
    }
}
