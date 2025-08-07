<?php

namespace app\modules\dep\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\dep\models\Dependente;

/**
 * Dependentes1Search represents the model behind the search form of `app\modules\dep\models\Dependente`.
 */
class Dependentes1Search extends Dependente
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_num_dep', 'id_num_res', 'bo_reg_exc', 'id_num_par', 'id_num_nat', 'id_num_nac', 'id_gra_ins', 'id_est_civ', 'id_num_gen', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren', 'id_tip_ren', 'bo_pag_inss', 'bo_dep_ati', 'bo_car_ass', 'id_num_cbo', 'bo_mem_def', 'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int', 'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul', 'id_num_cri', 'id_num_mod'], 'integer'],
            [['nm_ide_pes', 'nm_nom_dep', 'dt_nas_dep', 'nu_num_cpf', 'nu_num_ide', 'nm_nom_obs', 'nm_des_cid', 'nu_cod_cid', 'dt_tim_cri', 'dt_tim_mod'], 'safe'],
            [['nu_ren_dep'], 'number'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Dependente::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id_num_dep' => $this->id_num_dep,
            'id_num_res' => $this->id_num_res,
            'bo_reg_exc' => $this->bo_reg_exc,
            'id_num_par' => $this->id_num_par,
            'dt_nas_dep' => $this->dt_nas_dep,
            'id_num_nat' => $this->id_num_nat,
            'id_num_nac' => $this->id_num_nac,
            'id_gra_ins' => $this->id_gra_ins,
            'id_est_civ' => $this->id_est_civ,
            'id_num_gen' => $this->id_num_gen,
            'id_num_etn' => $this->id_num_etn,
            'id_nat_ocu' => $this->id_nat_ocu,
            'id_ori_ren' => $this->id_ori_ren,
            'id_tip_ren' => $this->id_tip_ren,
            'bo_pag_inss' => $this->bo_pag_inss,
            'bo_dep_ati' => $this->bo_dep_ati,
            'bo_car_ass' => $this->bo_car_ass,
            'id_num_cbo' => $this->id_num_cbo,
            'nu_ren_dep' => $this->nu_ren_dep,
            'bo_mem_def' => $this->bo_mem_def,
            'bo_ade_fis' => $this->bo_ade_fis,
            'bo_ade_vis' => $this->bo_ade_vis,
            'bo_ade_int' => $this->bo_ade_int,
            'bo_ade_aud' => $this->bo_ade_aud,
            'bo_ade_nan' => $this->bo_ade_nan,
            'bo_ade_mul' => $this->bo_ade_mul,
            'id_num_cri' => $this->id_num_cri,
            'dt_tim_cri' => $this->dt_tim_cri,
            'id_num_mod' => $this->id_num_mod,
            'dt_tim_mod' => $this->dt_tim_mod,
        ]);

        $query->andFilterWhere(['like', 'nm_ide_pes', $this->nm_ide_pes])
            ->andFilterWhere(['like', 'nm_nom_dep', $this->nm_nom_dep])
            ->andFilterWhere(['like', 'nu_num_cpf', $this->nu_num_cpf])
            ->andFilterWhere(['like', 'nu_num_ide', $this->nu_num_ide])
            ->andFilterWhere(['like', 'nm_nom_obs', $this->nm_nom_obs])
            ->andFilterWhere(['like', 'nm_des_cid', $this->nm_des_cid])
            ->andFilterWhere(['like', 'nu_cod_cid', $this->nu_cod_cid]);

        return $dataProvider;
    }
}
