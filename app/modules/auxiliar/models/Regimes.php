<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\RegimesQuery;
use app\modules\fun\models\Funcionarios;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%regimes}}".
 *
 * @property integer $id_num_reg
 * @property string $nm_des_reg
 *
 * @property Funcionarios[] $funcionarios
 */
class Regimes extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%regimes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nm_des_reg'], 'required'],
            [['nm_des_reg'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_num_reg' => 'Id da tabela Regime.',
            'nm_des_reg' => 'Descrição do regime do funcionário.',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getFuncionarios() {
        return $this->hasMany(Funcionarios::class, ['id_num_reg' => 'id_num_reg']);
    }

    /**
     * @inheritdoc
     * @return RegimesQuery the active query used by this AR class.
     */
    public static function find() {
        return new RegimesQuery(get_called_class());
    }

}
