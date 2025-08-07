<?php

namespace app\modules\tecsoc\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\tecsoc\models\TecnicoSocial;

/**
 * TecnicoSocialSearch represents the model behind the search form of `app\modules\tecsoc\models\TecnicoSocial`.
 */
class TecnicoSocialSearch extends TecnicoSocial
{

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [[
                'id_tec_soc', 'bo_reg_exc', 'id_num_res', 'bo_ins_pac', 'bo_car_ass_res',
                'bo_car_ass_dep', 'id_mun_tra_res', 'id_mun_tra_dep', 'id_tip_ren_res',
                'id_tip_ren_dep', 'bo_ati_dep', 'bo_ati_res', 'bo_pag_inss_res',
                'bo_pag_inss_dep', 'bo_aut_res', 'bo_aut_dep', 'id_ser_agu', 'id_ser_ele',
                'id_ser_esg', 'id_ser_lix', 'id_tip_ocu', 'id_num_cri', 'id_num_mod'
            ], 'integer'],
            [[
                'id_num_aco', 'id_num_ben', 'id_num_equ', 'nm_ocu_out', 'id_num_zoo',
                'id_num_ati', 'id_num_cur', 'id_ati_fis', 'nm_nom_obs', 'dt_tim_cri',
                'dt_tim_mod'
            ], 'safe'],
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
        $query = TecnicoSocial::find();

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
            'id_tec_soc' => $this->id_tec_soc,
            'bo_reg_exc' => $this->bo_reg_exc,
            'id_num_res' => $this->id_num_res,
            'bo_ins_pac' => $this->bo_ins_pac,
            'bo_car_ass_res' => $this->bo_car_ass_res,
            'bo_car_ass_dep' => $this->bo_car_ass_dep,
            'id_mun_tra_res' => $this->id_mun_tra_res,
            'id_mun_tra_dep' => $this->id_mun_tra_dep,
            'id_tip_ren_res' => $this->id_tip_ren_res,
            'id_tip_ren_dep' => $this->id_tip_ren_dep,
            'bo_ati_dep' => $this->bo_ati_dep,
            'bo_ati_res' => $this->bo_ati_res,
            'bo_pag_inss_res' => $this->bo_pag_inss_res,
            'bo_pag_inss_dep' => $this->bo_pag_inss_dep,
            'bo_aut_res' => $this->bo_aut_res,
            'bo_aut_dep' => $this->bo_aut_dep,
            'id_ser_agu' => $this->id_ser_agu,
            'id_ser_ele' => $this->id_ser_ele,
            'id_ser_esg' => $this->id_ser_esg,
            'id_ser_lix' => $this->id_ser_lix,
            'id_tip_ocu' => $this->id_tip_ocu,
            'id_num_cri' => $this->id_num_cri,
            'dt_tim_cri' => $this->dt_tim_cri,
            'id_num_mod' => $this->id_num_mod,
            'dt_tim_mod' => $this->dt_tim_mod,
        ]);

        $query->andFilterWhere(['like', 'id_num_aco', $this->id_num_aco])
            ->andFilterWhere(['like', 'id_num_ben', $this->id_num_ben])
            ->andFilterWhere(['like', 'id_num_equ', $this->id_num_equ])
            ->andFilterWhere(['like', 'nm_ocu_out', $this->nm_ocu_out])
            ->andFilterWhere(['like', 'id_num_zoo', $this->id_num_zoo])
            ->andFilterWhere(['like', 'id_num_ati', $this->id_num_ati])
            ->andFilterWhere(['like', 'id_num_cur', $this->id_num_cur])
            ->andFilterWhere(['like', 'id_ati_fis', $this->id_ati_fis])
            ->andFilterWhere(['like', 'nm_nom_obs', $this->nm_nom_obs]);

        return $dataProvider;
    }
}
