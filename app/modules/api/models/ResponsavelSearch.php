<?php

namespace app\modules\api\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\api\models\Responsavel;

/**
 * ResponsaveisSearch represents the model behind the search form of `app\modules\res\models\Responsavel`.
 */
class ResponsavelSearch extends Responsavel
{

    /**
     * {@inheritdoc}
     */
    public $projeto, $corsituacao, $estcivil;

    public function rules()
    {
        return [
            [[
                'bo_reg_exc', 'bo_tec_soc', 'id_num_proj', 'id_cor_sit', 'id_num_gen', 'id_est_civ',
                'id_gra_ins', 'id_num_nat', 'id_num_nac', 'id_num_etn', 'id_nat_ocu', 'id_ori_ren',
                'bo_car_ass', 'bo_pag_inss', 'bo_con_est', 'id_tip_ren', 'bo_res_ati',
                'bo_cal_urg', 'id_num_cbo', 'bo_mem_def', 'bo_ade_fis', 'bo_ade_vis', 'bo_ade_int',
                'bo_ade_aud', 'bo_ade_nan', 'bo_ade_mul', 'id_num_cri', 'id_num_mod',
            ], 'integer'],
            [[
                'dt_sor_res', 'dt_nas_res', 'dt_tim_cri', 'dt_tim_mod',
                'nm_ide_pes', 'nu_num_seq', 'nu_num_ins', 'nu_num_cas', 'nu_num_ins', 'nm_nom_res',
                'nm_nom_ema', 'nu_num_cep', 'nm_nom_log', 'nu_num_cas', 'nm_nom_mun', 'nu_cod_cid',
                'nm_nom_com', 'nm_nom_bai', 'nm_nom_est', 'nu_num_cpf', 'id_con_ocu', 'nm_nom_est',
                'nu_num_ide', 'nm_nom_obs', 'nm_des_cid', 'nu_cod_cid',
                'projeto', 'corsituacao', 'estcivil'
            ], 'safe'],
            [['nu_ren_res', 'nu_ren_fam'], 'number'],
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
        $query = Responsavel::find();
        $query->andFilterWhere(['bo_reg_exc' => 0]);
        if (Yii::$app->session->get('sistema') === 'MCMV') {
            $query->andFilterWhere(['like', 'id_num_proj', 2]);
        } else if (Yii::$app->session->get('sistema') === 'PAC') {
            $query->andFilterWhere(['like', 'id_num_proj', 3]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);


        $dataProvider->setSort(['defaultOrder' => ['nm_nom_res' => SORT_ASC]]);


        $dataProvider->sort->attributes['projeto'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['ger_projeto.nm_nom_proj' => SORT_ASC],
            'desc' => ['ger_projeto.nm_nom_proj' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['corsituacao'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['ger_cor_situacao.nm_des_sit' => SORT_ASC],
            'desc' => ['ger_cor_situacao.nm_des_sit' => SORT_DESC],
        ];
        $dataProvider->sort->attributes['estcivil'] = [
            // The tables are the ones our relation are configured to
            // in my case they are prefixed with "tbl_"
            'asc' => ['ger_estado_civil.nm_est_civ' => SORT_ASC],
            'desc' => ['ger_estado_civil.nm_est_civ' => SORT_DESC],
        ];

        $query->joinWith(['corSit', 'estCiv',], 'RIGHT JOIN');
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions

        $query->andFilterWhere([
            'id_num_res' => $this->id_num_res,
            'bo_reg_exc' => $this->bo_reg_exc,
            'bo_tec_soc' => $this->bo_tec_soc,
            //'id_num_proj' => $this->id_num_proj,
            //'id_cor_sit' => $this->id_cor_sit,
            'dt_sor_res' => $this->dt_sor_res,
            'dt_nas_res' => $this->dt_nas_res,
            'id_num_gen' => $this->id_num_gen,
            //'id_est_civ' => $this->id_est_civ,
            'id_gra_ins' => $this->id_gra_ins,
            'id_num_nat' => $this->id_num_nat,
            'id_num_nac' => $this->id_num_nac,
            'id_num_etn' => $this->id_num_etn,
            'id_nat_ocu' => $this->id_nat_ocu,
            'id_ori_ren' => $this->id_ori_ren,
            'bo_car_ass' => $this->bo_car_ass,
            'bo_pag_inss' => $this->bo_pag_inss,
            'bo_con_est' => $this->bo_con_est,
            'id_tip_ren' => $this->id_tip_ren,
            'bo_res_ati' => $this->bo_res_ati,
            'bo_cal_urg' => $this->bo_cal_urg,
            'id_num_cbo' => $this->id_num_cbo,
            'nu_ren_res' => $this->nu_ren_res,
            'nu_ren_fam' => $this->nu_ren_fam,
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

        $query->andFilterWhere(['like', 'ger_projeto.nm_nom_proj', $this->projeto])
            ->andFilterWhere(['like', 'ger_cor_situacao.nm_des_sit', $this->corsituacao])
            ->andFilterWhere(['like', 'ger_estado_civil.nm_est_civ', $this->estcivil])
            ->andFilterWhere(['like', 'nm_ide_pes', $this->nm_ide_pes])
            ->andFilterWhere(['like', 'nu_num_seq', $this->nu_num_seq])
            ->andFilterWhere(['like', 'nu_num_ins', $this->nu_num_ins])
            ->andFilterWhere(['like', 'id_con_ocu', $this->id_con_ocu])
            ->andFilterWhere(['like', 'nm_nom_res', $this->nm_nom_res])
            ->andFilterWhere(['like', 'nu_num_cep', $this->nu_num_cep])
            ->andFilterWhere(['like', 'nm_nom_log', $this->nm_nom_log])
            ->andFilterWhere(['like', 'nu_num_cas', $this->nu_num_cas])
            ->andFilterWhere(['like', 'nm_nom_com', $this->nm_nom_com])
            ->andFilterWhere(['like', 'nm_nom_bai', $this->nm_nom_bai])
            ->andFilterWhere(['like', 'nm_nom_mun', $this->nm_nom_mun])
            ->andFilterWhere(['like', 'nm_nom_est', $this->nm_nom_est])
            ->andFilterWhere(['like', 'nu_num_tel', $this->nu_num_tel])
            ->andFilterWhere(['like', 'nu_num_tel_1', $this->nu_num_tel_1])
            ->andFilterWhere(['like', 'nm_nom_ema', $this->nm_nom_ema])
            ->andFilterWhere(['like', 'nu_num_ide', $this->nu_num_ide])
            ->andFilterWhere(['like', 'nu_num_cpf', $this->nu_num_cpf])
            ->andFilterWhere(['like', 'nu_num_nis', $this->nu_num_nis])
            ->andFilterWhere(['like', 'nm_nom_pro', $this->nm_nom_pro])
            ->andFilterWhere(['like', 'nm_des_cid', $this->nm_des_cid])
            ->andFilterWhere(['like', 'nu_cod_cid', $this->nu_cod_cid])
            ->andFilterWhere(['like', 'nm_nom_obs', $this->nm_nom_obs]);

        return $dataProvider;
    }
}
