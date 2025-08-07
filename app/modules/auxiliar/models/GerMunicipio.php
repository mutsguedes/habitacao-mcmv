<?php

namespace app\modules\auxiliar\models;

use app\modules\auxiliar\models\GerMunicipioQuery;
use app\modules\dep\models\Dependente;
use app\modules\dep\models\DependenteQuery;
use app\modules\res\models\Responsavel;
use app\modules\res\models\ResponsavelQuery;
use app\modules\tecsoc\models\TecnicoSocial;
use app\modules\tecsoc\models\TecnicoSocialQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "{{%ger_municipio}}".
 *
 * @property int $id_num_mun Id da tabela municipios.
 * @property string|null $nm_nom_est Estado:
 * @property string|null $nu_cod_ibe Cód. IBGE:
 * @property string|null $nm_nom_mun Município:
 *
 * @property Dependente[] $dependentes
 * @property Responsavel[] $responsavels
 * @property Responsavel[] $responsavels0
 * @property TecnicoSocial[] $tecnicoSocials
 * @property TecnicoSocial[] $tecnicoSocials0
 */
class GerMunicipio extends ActiveRecord {

    /**
     * {@inheritdoc}
     */
    public static function tableName() {
        return '{{%ger_municipio}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules() {
        return [
            [['nm_nom_est'], 'string', 'max' => 2],
            [['nu_cod_ibe'], 'string', 'max' => 15],
            [['nm_nom_mun'], 'string', 'max' => 33],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels() {
        return [
            'id_num_mun' => 'Id da tabela municipios.',
            'nm_nom_est' => 'Estado:',
            'nu_cod_ibe' => 'Cód. IBGE:',
            'nm_nom_mun' => 'Município:',
        ];
    }

    /**
     * Gets query for [[Dependentes]].
     *
     * @return ActiveQuery|DependenteQuery
     */
    public function getDependentes() {
        return $this->hasMany(Dependente::className(), ['id_tra_mun' => 'id_num_mun']);
    }

    /**
     * Gets query for [[Responsavels]].
     *
     * @return ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels() {
        return $this->hasMany(Responsavel::className(), ['id_ant_mun' => 'id_num_mun']);
    }

    /**
     * Gets query for [[Responsavels0]].
     *
     * @return ActiveQuery|ResponsavelQuery
     */
    public function getResponsavels0() {
        return $this->hasMany(Responsavel::className(), ['id_mun_tra' => 'id_num_mun']);
    }

    /**
     * Gets query for [[TecnicoSocials]].
     *
     * @return ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials() {
        return $this->hasMany(TecnicoSocial::className(), ['id_mun_tra_dep' => 'id_num_mun']);
    }

    /**
     * Gets query for [[TecnicoSocials0]].
     *
     * @return ActiveQuery|TecnicoSocialQuery
     */
    public function getTecnicoSocials0() {
        return $this->hasMany(TecnicoSocial::className(), ['id_mun_tra_res' => 'id_num_mun']);
    }

    /**
     * {@inheritdoc}
     * @return GerMunicipioQuery the active query used by this AR class.
     */
    public static function find() {
        return new GerMunicipioQuery(get_called_class());
    }

}
