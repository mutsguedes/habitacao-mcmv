<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\FuncoesQuery;
use app\modules\fun\models\Funcionarios;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%funcoes}}".
 *
 * @property integer $id_num_fuc
 * @property string $nm_des_fuc
 *
 * @property Funcionarios[] $funcionarios
 */
class Funcoes extends ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return '{{%funcoes}}';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['nm_des_fuc'], 'required'],
            [['nm_des_fuc'], 'string', 'max' => 50],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id_num_fuc' => 'Id da tabela Funcionário.',
            'nm_des_fuc' => 'Descrição do função do funcionário..',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getFuncionarios() {
        return $this->hasMany(Funcionarios::class, ['id_num_fuc' => 'id_num_fuc']);
    }

    /**
     * @inheritdoc
     * @return FuncoesQuery the active query used by this AR class.
     */
    public static function find() {
        return new FuncoesQuery(get_called_class());
    }

}
