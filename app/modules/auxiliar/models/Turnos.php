<?php

namespace app\modules\auxiliar\models;

use app\modules\age\models\Agendas;
use app\modules\auxiliar\models\TurnosQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%turnos}}".
 *
 * @property integer $id_num_tur
 * @property string $nm_nom_tur
 *
 * @property Agendas[] $agendas
 */
class Turnos extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%turnos}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nm_nom_tur'], 'required'],
            [['nm_nom_tur'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_num_tur' => 'id da tabela Turno.',
            'nm_nom_tur' => 'Nome do turno.',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getAgendas() {
        return $this->hasMany(Agendas::class, ['id_num_tur' => 'id_num_tur']);
    }

    /**
     * @inheritdoc
     * @return TurnosQuery the active query used by this AR class.
     */
    public static function find() {
        return new TurnosQuery(get_called_class());
    }

}
